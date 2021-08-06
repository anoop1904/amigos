<?php
namespace App\Http\Controllers;
// use JWTAuth;
use JWTAuthException;
use Tymon\JWTAuth\Facades\JWTAuth; 
use App\User;
use App\Device_Detail;
use App\OrderDetail;
use App\Category;
use App\Comment;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
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
         $userorderlist = \App\Order::select('course_id')->where('user_id',$userId)->get()->toArray();
         if(count($userorderlist)>0)
         {
            foreach ($userorderlist as $key => $value) {
                $ids[$key]=$value['course_id'];
            }
         }
         $courselist  = \App\Course::with(['videourl','videourl.videocomment'])->where(['IsActive'=>1])->offset($request->start)->limit($request->pagelength)->get(); 
         $results=array();
        foreach ($courselist as $key => $course){
            $video=explode(',', $course->video_url);
            $results[$key]['id'] = $course->id;
            $results[$key]['plan_id'] = $course->plan_id;
            $results[$key]['name'] = $course->name;
            // $results[$key]['category'] = $course->category_list->name;
            // $results[$key]['subcategory'] = $course->sub_category_list->name;
            $results[$key]['image'] =URL('public/assets/img/course/'.$course->image);
            $results[$key]['price'] = $course->price;
            $results[$key]['discount'] = $course->discount;
            if($course->discount_type==1)
            {
              $results[$key]['discount_type']='%';
            } else if($course->discount_type==2){
              $results[$key]['discount_type']='Flat';
             }
             else
             {
                $results[$key]['discount_type']='No Discount';
             }
           
              $results[$key]['description'] = $course->description;
              $results[$key]['short_description'] = $course->short_description;
              $results[$key]['video_url'] = $course->videourl;
              $results[$key]['video_count'] = count($course->videourl);
              $results[$key]['is_subscribe'] =0;
              if(in_array($course->id,$ids))
              {
                 $results[$key]['is_subscribe'] =1;
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
         $usertype = $roles = 38;
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
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }

    $coursedetail= \App\Course::where('id',$request->course_id)->first(); 
    if(empty($coursedetail))
    {
        return response()->json($this->fResponse('Invalid course id.',[]));
    }
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
          $temp_data[$key]['id']= $value->id; 
          $temp_data[$key]['order_id']= $value->order_id; 
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

}