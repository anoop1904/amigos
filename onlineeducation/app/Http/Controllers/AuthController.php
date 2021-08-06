<?php
namespace App\Http\Controllers;
// use JWTAuth;
use JWTAuthException;
use Tymon\JWTAuth\Facades\JWTAuth; 
use App\User;
use App\Device_Detail;
use App\OrderDetail;
use App\Category;
use App\Likes;
use App\Comment;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
use Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
include('send_notification.php');

class AuthController extends Controller
{
     public function __construct()
    {
        // $this->middleware('auth.jwt', ['except' => ['login','phoneNumberVerification']]);
    }
    private $api_key = 'APA91bEacXF96n2qYk8IhHbGT4ZUc12uOtBcT6jgorKrdionryG8W1D6q';
    
    public function checkAPIKey($key) 
    {
        if($this->api_key === $key){
          return true;
        }else{
            return false;
        }
    }


    public function createImage($img)
    {
        $image = $img;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'user-'.time().'.'.'png';
        \File::put('public/student/' . $imageName, base64_decode($image));
        return $imageName;
    }

    public function fResponse($message,$payload=[])
    {
        $data=[];
        $data['messageId']=203;
        $data['success']=false;
        $data['message']=$message;
        $data['data']=$payload;
        return $data;
    }
    public function sResponse($message,$payload=[],$messageId=200)
    {
        $data=[];
        $data['messageId']=$messageId;
        $data['success']=true;
        $data['message']=$message;
        $data['data']=$payload;
        return $data;
    }

    public function getCategories(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',

        ]);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
        $categories  = \App\Category::select('id','name','image','banner_image')->where(['IsActive'=>1,'parent_id'=>0])->get();
        foreach ($categories as $key => $category){
            $category->image = URL('public/assets/img/category/'.$category->image);
            if($category->banner_image){
              $category->banner_image = URL('public/assets/img/category/'.$category->banner_image);
            }
            $results[] = $category;
        }
        return response()->json($this->sResponse('Category List',$results));
    }
    public function getCourse(Request $request){
       $validator = Validator::make($request->all(), [
            'start' => 'required',
            'pagelength' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        
         $userId = $this->getUserId();
         $ids=array();
         $userorderlist = \App\Order::select('course_id')->where(['user_id'=>$userId])->where('status','!=',4)->get()->toArray();
         if(count($userorderlist)>0)
         {
            foreach ($userorderlist as $key => $value) {
                $ids[$key]=$value['course_id'];
            }
         }
        // $courselist  = \App\Course::with(['videourl','videourl.videocomment'])->where(['IsActive'=>1])->offset($request->start)->limit($request->pagelength)->get();

         $courselist = \App\Course::with(['videourl','videourl.videocomment'=>function($query) use ($userId){
            $query->where('from_user', $userId);
        }])->where(['IsActive'=>1])->offset($request->start)->limit($request->pagelength)->get();


         $results=array();
         $i=0;
        foreach ($courselist as $key => $course){
           $assignuserId = \App\TeacherCourseMapping::select('user_id')->where(['course_id'=>$course->id])->first();
           if(!empty($assignuserId))
           {
           	if(count($course->videourl) > 0){
            $assign=$assignuserId->user_id;
            $video=explode(',', $course->video_url);
            $results[$i]['id'] = $course->id;
            $results[$i]['plan_id'] = $course->plan_id;
            $results[$i]['name'] = $course->name;
            $results[$i]['assign_to'] = $assignuserId->user_id;
            // $results[$i]['category'] = $course->category_list->name;
            // $results[$i]['subcategory'] = $course->sub_category_list->name;
            $results[$i]['image'] =URL('public/assets/img/course/'.$course->image);
            $results[$i]['price'] = $course->price;
            $results[$i]['discount'] = $course->discount;
            if($course->discount_type==1)
            {
              $results[$i]['discount_type']='%';
            } else if($course->discount_type==2){
              $results[$i]['discount_type']='Flat';
             }
             else
             {
                $results[$i]['discount_type']='No Discount';
             }
           
              $results[$i]['description'] = $course->description;
              $results[$i]['short_description'] = $course->short_description;
              foreach($course->videourl as $key=>$val )
                {
                    $likeCount = \App\Likes::select('*')->where(['course_id'=>$course->id,'video_id'=>$val->id,"likes"=>1])->count();
                    $dislikeCount = \App\Likes::select('*')->where(['course_id'=>$course->id,'video_id'=>$val->id,"likes"=>0])->count();
                    $likebyme = \App\Likes::select('*')->where(['course_id'=>$course->id,'video_id'=>$val->id,"student_id"=>$userId])->count();
                    $val->like=$likebyme;
                    $val->likecount=$likeCount;
                    $val->dislike=$dislikeCount;
                }
              $results[$i]['video_url'] = $course->videourl;
              $results[$i]['video_count'] = count($course->videourl);
              $results[$i]['is_subscribe'] =0;
              $results[$i]['subscription_id'] ='';
              if(in_array($course->id,$ids))
              {
                $subscriptionslist = \App\Order::where(['user_id'=>$userId,'course_id'=>$course->id])->first();
               //print_r( $subscriptionslist);
                 $results[$i]['is_subscribe'] =1;
                 $results[$i]['subscription_id'] =$subscriptionslist->subscription_id;
              }
              $i++;
            }
        }
        }
        return response()->json($this->sResponse('Course List',$results));
    }

    public function getSubCategories(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
        $categories  = \App\Category::select('id','name','image')->where(['IsActive'=>1,'parent_id'=>$request->category_id])->get();
        foreach ($categories as $key => $category){
            $category->image = URL('public/assets/img/category/'.$category->image);
            $results[] = $category;
        }
        return response()->json($this->sResponse('Sub Category List',$results));
        // echo "string";
    }
    public function logout(Request $request)
        {      
            try {
               JWTAuth::invalidate(JWTAuth::getToken());
                return response()->json([
                    'status' => "success",           
                    'message' => 'User logged out successfully',
                    'messageId' => 200,
              
                ]);
            } catch (JWTException $exception) {
                return response()->json([
                    'status' => "failure",
                    'message' => 'Sorry, the user cannot be logged out',
                    'messageId' => 203,
                ]);
            }
    }

    public function getUserId(){
        try {
            // attempt to verify the credentials and create a token for the user
            $token = JWTAuth::getToken();
            $apy = JWTAuth::getPayload($token)->toArray();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
        return $apy['sub'];
    }

    public function update_profile(Request $request){
        $userId = $this->getUserId();
        $user = User::select('id','email','name','Phone','address','zipcode')->findOrFail($userId);
        if($request->name){
            $user->name = $request->name;
        }
       
        if($request->email){
            $user->email = $request->email;
        }
         
        if($request->mobile){
            $user->Phone  = $request->mobile;
        } 
         if($request->address){
            $user->address  = $request->address;
        } 
         if($request->zipcode){
            $user->zipcode  = $request->zipcode;
        }       
        $users = $user->save();

        if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('user_id',$user->id)->first();

            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->user_id = $user->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }
               
        if($users){
            return response()->json([
                "status"=> true,
                "messageId"=> 200,
                "message"=> "User Profile Update Successfully",
                "data"=>$user,
            ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'messageId' => 203,
                    'data' => $users,
                    'message' => 'Something went wrong. Please try again later',
                ]); 

        } 
    }


    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'zipcode'=>'required',
            'address'=>'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
    $countemail=User::where('email',$request->email)->count(); 
      if($countemail>0)
      {
         return response()->json($this->fResponse('This email id already registered.',[]));
      }
      $countphone=User::where('Phone',$request->mobile)->count(); 
    if($countphone>0)
      {
         return response()->json($this->fResponse('This mobile number already registered.',[]));
      }
         $usertype = $roles = 20;
         $user = User::create([
              'user_type' =>$usertype,
              'name' =>$request->name,
              'email' =>$request->email,
              'Phone' =>$request->mobile,
              'password' =>$request->password,
              'IsVerify' => '1',
              'IsAvailable' => '1',
              'zipcode' =>$request->zipcode,
              'address' =>$request->address,
              'CreatedBy' =>1
        ]);
        $code = 'u'.date('Y').$user->id;
        User::where('id',$user->id)->update(['user_code'=>$code,'zipcode' =>$request->zipcode,'address' =>$request->address]);
        
        if (isset($roles)) {
            $role_r = Role::where('id', '=', $roles)->firstOrFail();            
            $user->assignRole($role_r);
        }
        if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('user_id',$user->id)->first();

            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->user_id = $user->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }  

       
        return response()->json([
                        'success'   =>  true,
                        'messageId'   =>  200,
                        'message'   =>  "Your account has been successfully created.",
                        'data' =>null,
                        
                    ]);
    }

public function userLogin(Request $request)
{
       $validator = Validator::make($request->all(), [
            'email' => 'required', 
            'password' => 'required', 
        ]);  
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        } 
       $user = User::select('id','name','email','phone','password','user_type','zipcode','address')->where('email', $request->email)->first();
       if(empty($user))
       {
        return response()->json($this->fResponse('Email or password is wrong.',[]));
       }
       if ((Hash::check($request->password,$user->password)) == false)
        {
            return response()->json($this->fResponse('Email or password is wrong.',[]));
        }
        if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('user_id',$user->id)->first();

            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->user_id = $user->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }

            if($user->user_type==20)
            {
                $user_type='Teachers';
            }elseif($user->user_type==38)
            {
                $user_type='User';
            }
            elseif($user->user_type==36)
            {
                $user_type='Staff';
            }
            $user->user_type=$user_type;
            $userClaims = ['sid' => $user->id, 'baz' => 'bob','exp' => date('Y-m-d', strtotime('+12 month', strtotime(date('Y-m-d'))))];
             $token = JWTAuth::fromUser($user, $userClaims);
             $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Login successfully.',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user,
                   
                ]
            ];
            return response()->json($response);

        
}
public function changePassword(Request $request)
{
   $userId = $this->getUserId();
   $validator = Validator::make($request->all(), [
            'oldpassword' => 'required', 
            'newpassword' => 'required', 
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
   $user= User::where('id', $userId)->first();
   if ((Hash::check($request->oldpassword,$user->password)) == false)
   {
     return response()->json($this->fResponse('Old password not match.',[]));
   }
   $res=User::where('id', $userId)->update(['password' => Hash::make($request->newpassword)]);
   if($res)
   {
          return response()->json([
                              'success'   =>  true,
                              'messageId'   =>  200,
                              'message' => "Password has been change successfully.",
                              
                          ]);
   }
   else
   {
      return response()->json($this->fResponse('Please try again.',[]));
   }
}

public function placeOrder(Request $request)
{
    $userId = $this->getUserId(); 
    $validator = Validator::make($request->all(), [
            'course_id' => 'required|numeric', 
            'subscription_id' => 'required', 
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }

    $coursedetail= \App\Course::where('id',$request->course_id)->first(); 
    if(empty($coursedetail))
    {
        return response()->json($this->fResponse('Invalid course id.',[]));
    }
    $finalamountpay=$coursedetail->price;
     if($coursedetail->discount!=0 && $coursedetail->discount!="")
     {
        if($coursedetail->discount_type==1)
        {
            $amt=$coursedetail->price*$coursedetail->discount/100;
            $finalamountpay=$coursedetail->price-$amt; 
        }
        else if($coursedetail->discount_type==2)
        {
                 $finalamountpay=$coursedetail->price-$coursedetail->discount;
        }
        else
        {
            $finalamountpay=$coursedetail->price;
        }
     }
     $orderId='EDU'.getRandomNumber();
     $orderData['order_id']=$orderId;
     $orderData['user_id']=$userId;
     $orderData['course_id']=$request->course_id;
     $orderData['subscription_id']=$request->subscription_id;
     $orderData['order_amount']=$coursedetail->price;
     $orderData['payable_amount']=$finalamountpay;
     $orderData['payment_status']=1;
     $orderData['order_detail']=json_encode($coursedetail);
     $order = \App\Order::create($orderData);
     if($order)
     {
        \App\Course::where('id',$request->course_id)->update(['IsSale'=>1]);
       unset($orderData['order_detail']);
       return response()->json($this->sResponse('Order placed Successfully',$orderData));
     }
     else
     {
         return response()->json($this->fResponse('Order could not placed',[]));
     }
}

public function getOrder(Request $request)
{ 
     $userId = $this->getUserId(); 
     $orderlist = \App\Order::where('user_id',$userId)->get(); 
     $temp_data=array();
     if(count($orderlist)>0)
     {
        foreach ($orderlist as $key => $value)
        {
          $coursedetail= \App\Course::with(['videourl','videourl.videocomment'])->where('id',$value->course_id)->first();

          $assignuserId = \App\TeacherCourseMapping::select('user_id')->where(['course_id'=>$value->course_id])->first();
           $temp_data[$key]['assign_to'] = $assignuserId->user_id;
          $temp_data[$key]['id']= $value->id; 
          $temp_data[$key]['order_id']= $value->order_id; 
          $temp_data[$key]['subscription_id']= $value->subscription_id; 
          $temp_data[$key]['name']= $coursedetail->name; 
          $temp_data[$key]['image']=URL('public/assets/img/course/'.$coursedetail->image); 
          //$temp_data[$key]['video_link']= $coursedetail->video_url; 
          $temp_data[$key]['discountamount']= $coursedetail->discount; 
       
          if($coursedetail->discount_type==1)
            {
                $amt=$coursedetail->price*$coursedetail->discount/100;
                $temp_data[$key]['discount_type']='%';
            }
            else if($coursedetail->discount_type==2)
            {
                    $temp_data[$key]['discount_type']='Flat';
            }
            else
            {
                $temp_data[$key]['discount_type']='No Discount';
                $temp_data[$key]['discountamount']=0;
            }
          $temp_data[$key]['order_amount']= $value->order_amount; 
          $temp_data[$key]['payable_amount']= $value->payable_amount; 
          $temp_data[$key]['date']=date('d-m-Y h:i:s a',strtotime('+5 hour +30 minutes +1 seconds',strtotime($value->created_at))); 
              $temp_data[$key]['description'] = $coursedetail->description;
              $temp_data[$key]['short_description'] = $coursedetail->short_description;
              foreach($coursedetail->videourl as $val )
                {
                    $likeCount = \App\Likes::select('*')->where(['course_id'=>$coursedetail->id,'video_id'=>$val->id,"likes"=>1])->count();
                    $dislikeCount = \App\Likes::select('*')->where(['course_id'=>$coursedetail->id,'video_id'=>$val->id,"likes"=>0])->count();
                    $likebyme = \App\Likes::select('*')->where(['course_id'=>$coursedetail->id,'video_id'=>$val->id,"student_id"=>$userId])->count();
                    $val->like=$likebyme;
                    $val->likecount=$likeCount;
                    $val->dislike=$dislikeCount;
                }
              $temp_data[$key]['video_url'] = $coursedetail->videourl;
              $temp_data[$key]['video_count'] = count($coursedetail->videourl);
              $temp_data[$key]['is_subscribe'] =1;
        } 
         return response()->json([
                              'success'   =>  true,
                              'messageId'   =>  200,
                              'message' => "Order List.",
                              'data'=>$temp_data
                              
                          ]); 
     }
     else
     {
         return response()->json([
                              'success'   =>  true,
                              'messageId'   =>  200,
                              'message' => "No any order placed yet.",
                              
                          ]);
      } 
}

public function saveComment(Request $request)
{  
       $userId = $this->getUserId(); 
       $validator = Validator::make($request->all(), [
            'course_id' => 'required|numeric', 
            'video_id' => 'required|numeric', 
            'to_user' => 'required|numeric', 
            'message' => 'required', 
        ]);
       if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        $user = Comment::create([
              'course_id' =>$request->course_id,
              'video_id' =>$request->video_id,
              'from_user' =>$userId,
              'to_user' =>$request->to_user,
              'message' => $request->message,
              
        ]);
         //send pushnotification
           $userId = \App\TeacherCourseMapping::select('user_id')->where(['course_id'=>$request->course_id])->first();
           if(!empty($userorderlist))
           {
             $usertoken = \App\Device_Detail::where(['user_id'=>$userId->user_id])->first();
             
              $customData=array('video_id' =>$request->video_id,'course_id' => $request->course_id,'from_user' => $userId,'to_user' => $request->to_user);
              $title="New Comment";
              $body="You have got new comment.";
              if(!empty($usertoken))
              {
                sendPushNotification($usertoken->device_token,$title,$body,$customData);  
              }
              
           }
        
         return response()->json([
                              'success'   =>  true,
                              'messageId'   =>  200,
                              'message' => "Comment successfully save.",
                              'data'=>null
                              
                          ]); 
}

public function subscribePlan(Request $request)
{
          $userId = $this->getUserId();
          $validator = Validator::make($request->all(), [
            'course_id' => 'required|numeric', 
            'plan_id' => 'required', 
        ]);
       if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        $coursedetail= \App\Course::where('id',$request->course_id)->first(); 
        if(empty($coursedetail))
        {
            return response()->json($this->fResponse('Invalid course id.',[]));
        }

         $result=json_decode(subscriptions($request->plan_id));
           if (property_exists($result,"error"))
            {
              if($result->error)
              {
                return response()->json($this->fResponse('Invalid Plan Id ',[]));
              }
            }
            
            $plandetail=json_decode(getPlanDetail($request->plan_id));
            if (property_exists($plandetail,"error"))
            {
              if($plandetail->error)
              {
                return response()->json($this->fResponse('Invalid Plan Id ',[]));
              }
            }
           
            $amount=$plandetail->item->amount/100;
            if($plandetail->period=='yearly')
            {
              $expiry_date = date('Y-m-d H:i:s', strtotime("+12 months",$result->created_at));
            }
            else
            {
              $expiry_date = date('Y-m-d H:i:s', strtotime("+1 months",$result->created_at));
            }
         
          $subscription_id=$result->id;
          $paymentlink=$result->short_url;
               $subscriptionData = [
                'subscription_id'=>$result->id,
                'plan_id'=>$plandetail->id,
                'plan_type'=>$plandetail->period,
                'plan_name'=>$plandetail->item->name,
                'user_id'=>$userId,
                'course_id'=>$request->course_id,
                'expiry_date'=>$expiry_date,
                'payment_link'=>$result->short_url,
                'price'=>$amount,
                'payment_amount'=>$amount,
                'payment_date'=>date('Y-m-d H:i:s',$result->created_at),
               
            ];
            $subscription = \App\Subscription::create($subscriptionData);
            if($subscription)
              {
                   return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message' => 'Course has been successfully subscribed.',
                            "plane_detail"=>$subscriptionData
                            
                        ]);
              }
              else
              {
                return response()->json([
                            'success'   =>  false,
                            'messageId'   =>  203,
                            'message' => 'Try again later.',
                        ]);
              }
        
        
}
public function cancelSubscribePlan(Request $request)
{
     $userId = $this->getUserId();
     $validator = Validator::make($request->all(), [
            'subscription_id' => 'required', 
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
           $subscription = \App\Subscription::where(['subscription_id'=>$request->subscription_id])->first();
           $result=json_decode(cancelSubscriptions($request->subscription_id));
           \App\Subscription::where('subscription_id',$request->subscription_id)->update(['status'=>0]);
           \App\Order::where(['user_id'=>$userId,'course_id'=>$subscription->course_id])->update(['status'=>4]);
          return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message' => $result,
                            
                        ]);
}
public function getManagerCourse(Request $request){
       $validator = Validator::make($request->all(), [
            'start' => 'required',
            'pagelength' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        
         $userId = $this->getUserId();
         $userorderlist = \App\TeacherCourseMapping::select('course_id')->where(['user_id'=>$userId])->get()->toArray();
         $temp_data=array();
         if(count($userorderlist)>0)
         {
            foreach ($userorderlist as $key => $value) {
                $ids[$key]=$value['course_id'];
               $coursedetail= \App\Course::with(['videourl'])->where('id',$value['course_id'])->first();
                  $temp_data[$key]['id']= $coursedetail->id; 
                  $temp_data[$key]['name']= $coursedetail->name; 
                  $temp_data[$key]['image']=URL('public/assets/img/course/'.$coursedetail->image); 
                  $temp_data[$key]['description'] = $coursedetail->description;
                  $temp_data[$key]['short_description'] = $coursedetail->short_description;
                  $temp_data[$key]['video_url'] = $coursedetail->videourl;
                  $temp_data[$key]['video_count'] = count($coursedetail->videourl); 
            }
            return response()->json($this->sResponse('Course List',$temp_data));
         }
         else
         {
          return response()->json($this->sResponse('Course List',[]));
         }
       
        
    }
public function getManagerComment(Request $request)
{
     $validator = Validator::make($request->all(), [
            'start' => 'required',
            'pagelength' => 'required',
            'api_key' => 'required',
            'video_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'from_user' => 'required|numeric',
            'to_user' => 'required|numeric'
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
 
        $commentlist = \App\Comment::with('customer_detail')->select('id','from_user','message','created_at')->where(['video_id'=>$request->video_id, 'course_id'=>$request->course_id,'from_user'=>$request->from_user, 'to_user'=>$request->to_user])->orWhere('to_user',$request->from_user)->where(['video_id'=>$request->video_id, 'course_id'=>$request->course_id, 'from_user'=>$request->to_user])->get();
        $temp_data=array();
        foreach ($commentlist as $key => $value) {
          $temp_data[$key]['id']=$value->id;
          $temp_data[$key]['user_id']=$value->from_user;
          $temp_data[$key]['username']=$value->customer_detail->name;
          $temp_data[$key]['message']=$value->message;
          $temp_data[$key]['created_at']=date('Y-m-d H:s:i',strtotime($value->created_at));
        }
       return response()->json($this->sResponse('Comment List',$temp_data));

}

public function getComment(Request $request)
{
     $validator = Validator::make($request->all(), [
            'start' => 'required',
            'pagelength' => 'required',
            'api_key' => 'required',
            'video_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'from_user' => 'required|numeric',
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
 
        $commentlist = \App\Comment::with('customer_detail')
        ->select('id','from_user','message','created_at')
        ->where(['video_id'=>$request->video_id,'course_id'=>$request->course_id])
        ->where('from_user',$request->from_user)
        ->orWhere('to_user',$request->from_user)
        ->where(['video_id'=>$request->video_id,'course_id'=>$request->course_id])->get();
        $temp_data=array();
        foreach ($commentlist as $key => $value) {
          $temp_data[$key]['id']=$value->id;
          $temp_data[$key]['user_id']=$value->from_user;
          $temp_data[$key]['username']=$value->customer_detail->name;
          $temp_data[$key]['message']=$value->message;
          $temp_data[$key]['created_at']=date('Y-m-d H:s:i',strtotime($value->created_at));
        }
       return response()->json($this->sResponse('Comment List',$temp_data));

}

public function doLike(Request $request)
{
     $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'video_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'student_id' => 'required|numeric',
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
        
        $likeData = [
                'video_id'=>$request->video_id,
                'course_id'=>$request->course_id,
                'student_id'=>$request->student_id,
                'like'=>$request->like,
            ];
            
            $likesdata  = \App\Likes::select('id')->where(['video_id'=>$request->video_id,'course_id'=>$request->course_id,'student_id'=>$request->student_id])->get();
            if(count($likesdata) > 0){
                $likerow = Likes::where(['video_id'=>$request->video_id,'course_id'=>$request->course_id,'student_id'=>$request->student_id])->first();
                $likerow->likes = $request->like;
                $flag = $likerow->save();
            }else{
                $Likes = new \App\Likes(); 
                $Likes->video_id = $request->video_id;
                $Likes->course_id = $request->course_id;
                $Likes->student_id = $request->student_id;
                $Likes->likes = $request->like;
            
                $flag = $Likes->save();
            }
           
        $message = $request->like == 1 ? 'Liked Successfully' : 'Dislike Successfully';
       return response()->json($this->sResponse($message,$flag));

}

public function getCommentList(Request $request)
{
     $validator = Validator::make($request->all(), [
            'start' => 'required',
            'pagelength' => 'required',
            'api_key' => 'required',
            'video_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'from_user' => 'required|numeric',
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
        $commentlist = \App\Comment::with('customer_detail')->select('id','from_user','to_user','video_id','course_id','message','created_at')->where(['video_id'=>$request->video_id,'course_id'=>$request->course_id])->where('from_user',$request->from_user)->orWhere('to_user',$request->from_user)->where(['video_id'=>$request->video_id,'course_id'=>$request->course_id])->get();
        
        $temp_data=array();
        $subarray= [];
        foreach ($commentlist as $key => $value) {
            if($value->from_user == $request->from_user){
                if(array_key_exists($value->to_user,$subarray)){
                  $subarray[$value->to_user]['count'] += 1;
                }else{
                  $subarray[$value->to_user]['user_id']=$value->from_user;
                  $subarray[$value->to_user]['username']=$value->customer_detail->name;
                  $subarray[$value->to_user]['count']=1;
                }
            }else{
                if(array_key_exists($value->from_user,$subarray)){
                  $subarray[$value->from_user]['count'] += 1;
                }else{
                  $subarray[$value->from_user]['user_id']=$value->from_user;
                  $subarray[$value->from_user]['username']=$value->customer_detail->name;
                  $subarray[$value->from_user]['count']=1;
                }
            }
            
        }
        foreach($subarray as $key => $row){
            array_push($temp_data,$row);
        }
       return response()->json($this->sResponse('Comment List',$temp_data));

}

public function resetPassword(Request $request)
{
     $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        $user = User::select('id','email','name')->where('email', $request->email)->first();
        if(empty($user))
       {
        return response()->json($this->fResponse('Email Not Found.',[]));
       }
        $otp = mt_rand(100000, 999999);
        User::where('id',$user->id)->update(['otp'=>$otp]);
       
      $data = array('name'=>$user->name, "otp"=> $otp);
      $email = $user->email;
      Mail::send('mail', $data, function($message) use ($user) {
         $message->to($user->email, $user->name)
         ->subject('password reset OTP');
         $message->from('vishnualina1@gmail.com','Alina');
      });
      $temp_data = ['user_id' => $user->id, "email"=>$user->email ];
       return response()->json($this->sResponse('Reset Password',$temp_data));
}

public function resetPasswordOTP(Request $request)
{
     $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'user_id' => 'required|numeric',
            'password' => 'required',
            'otp' => 'required|numeric'
        ]);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        $user = User::select('id','email','name','otp')->where('email', $request->email)->first();
        if(empty($user))
       {
        return response()->json($this->fResponse('Email Not Found.',[]));
       }
       if($user->otp != $request->otp)
       {
        return response()->json($this->fResponse('Invalid OTP.',[]));
       }
        User::where('id',$user->id)->update(['password'=>$request->password]);
        $res=User::where('id', $user->id)->update(['password' => Hash::make($request->password), 'otp' =>'']);
       
       return response()->json($this->sResponse('Password Changed Successfully.',[]));
}

public function test()
{
  $device_token="cANPbC5kT_Cemt2Lbhw9wR:APA91bHyjvEByjt52-I3ikd--h1w6PWwew_Ef_VsLN87l4KCrICRx52cy2hq_bFcAfQ3lcvyPn2z6NK_NaRrmuUEVSiQBOZmK4Ei8gHyB5AN9Cd7eTIiApuj8qtaAdURBJIgvZYpOgKc";
  $title="fnaltest";
  $body="fnaltest";
  $customData=array('id'=>90);
 sendPushNotification($device_token,$title,$body,$customData);

}
}