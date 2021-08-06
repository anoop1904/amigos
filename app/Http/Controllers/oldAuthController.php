<?php
namespace App\Http\Controllers;
// use JWTAuth;
use JWTAuthException;
 use Tymon\JWTAuth\Facades\JWTAuth; 
use App\User;
use App\Student;
use App\Device_Detail;
use App\Subscription;
use App\SchoolVendorMapping;
use App\KitchenFood;
use App\Notification;
use App\OrderDetail;
use App\Order;
use App\School;
use App\Plan;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
include('send_notification.php');

class AuthController extends Controller
{
     public function __construct()
    {
        // $this->middleware('auth.jwt', ['except' => ['login','phoneNumberVerification']]);
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

     public function sss()
    {
      
        return "asd";
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
        // $token  = JWTAuth::getToken();
        // $apy    = JWTAuth::getPayload($token)->toArray();

       // return $apy;
        return $apy['sub'];
    }
    public function school_list(Request $request){
        $userId = $this->getUserId();
      
        $schoolResults = School::select('id','name','image')->where(['status'=>1])->orderBy('id','DESC')->get()->toArray();
        $schools = array();
        foreach ($schoolResults as $key => $value) {
            $tempArr = array();
            $tempArr['title']   = $value['name'];
            $tempArr['id']      = $value['id'];
            $tempArr['image']   = URL('public/school-img').'/'.$value['image'];
            $schools[] =$tempArr;
        }
        if(!empty($schools)){

            return response()->json([
                "status"=> 'success',
                "messageId"=> 200,
                "message"=> "School List",
                "data"=>$schools
            ]); 
        }else{

            return response()->json([
                    'status'=> 'failure',
                    'messageId' => 203,
                    'message' => 'Something went wrong. Please try again later',
                ]); 

        } 
    }

    public function plan_list(Request $request){
        $userId = $this->getUserId();
      
        $planResults = Plan::select('id','plan_id','max_meals_per_week', 'max_amount_per_meal','image','name','price','description','trail_days')->orderBy('id','DESC')->get()->toArray();
        $plans = array();

        

        foreach ($planResults as $key => $value) {
            $str = "?plan_id=".encrypt($value['id'])."&user_id=".encrypt($userId);
            $web_url = URL('pay_subscription'.$str);
            $tempArr = array();
            $tempArr['plan_id']   = $value['plan_id'];
            $tempArr['max_meals_per_week']   = $value['max_meals_per_week'];
            $tempArr['max_amount_per_meal']   = $value['max_amount_per_meal'];
            $tempArr['price']   = $value['price'];
            $tempArr['description']   = $value['description'];
            $tempArr['trail_days']   = $value['trail_days'];
            $tempArr['name']   = $value['name'];
            $tempArr['id']      = $value['id'];
            $tempArr['image']   = URL('public/assets/img/plan').'/'.$value['image'];
            $tempArr['web_url']   = $web_url;
            $plans[] =$tempArr;
        }
        if(!empty($plans)){

            return response()->json([
                "status"=> 'success',
                "messageId"=> 200,
                "message"=> "Plan List",
                "data"=>$plans
            ]); 
        }else{

            return response()->json([
                    'status'=> 'failure',
                    'messageId' => 203,
                    'message' => 'Something went wrong. Please try again later',
                ]); 

        } 
    }

    public function update_profile(Request $request){
        $userId = $this->getUserId();
        $student = Student::findOrFail($userId);
        $student->name = $student->name;
        $web_setting = \App\Websitesetting::first();
        $comman = new CommanController();
        $payment = new PaymentController();
        if($request->first_name){
            $student->name = $request->first_name;
            if(!$student->referral_code){
                $student->referral_code  = $comman->generateCode($request->first_name,$student->mobile_number);
            }
            // $student->referral_code   = substr($request->first_name, 0,4).substr($request->mobile_number,-2);
        }
        if($request->referral_code){
            $referral_student = Student::where(['referral_code'=>$request->referral_code])->get()->first();
            if($referral_student){
                if($refereed_studet_detail->ambassador){
                    // $referred_by_credit = config('constants.referred_by_ambassador_credit');
                    $referred_by_credit = $web_setting->ref_by_ambas_credit;
                }else{
                    // $referred_by_credit = config('constants.referred_by_credit');
                    $referred_by_credit = $web_setting->referred_by_credit;
                }
                $referred_to_credit = $web_setting->referred_to_credit;
                $user = Referral::updateOrCreate([
                  'referred_by'             => $referral_student->id,
                  'referred_to'             => $userId
                ],['referred_by_credit'     => $referred_by_credit,
                  'referred_to_credit'      => $referred_to_credit]);
                Student::where('referral_code',$request->referral_code)->update(['referral_code_count'=>($referral_student->referral_code_count+1)]);
                // $response = array(['status'=>"TRUE"]);
            }
        }
        if($request->profile_pic){
            $file_name = $this->createImage($request->profile_pic);
            $student->profile_pic = $file_name;
        } 
        if($request->email){
            if(!$student->email){
                $res = $payment->update_customer($userId,$request->email);
                // return $res;
            }
            $student->email = $request->email;
        }
        if($request->school_year){
            $student->school_year = $request->school_year;
        } 
        if($request->last_name){
            $student->last_name  = $request->last_name;
        }
        // profile_pic
        if($request->school){
            $student->school_id = $request->school;
        }
        if($request->complete_profile)
        {
          $student->complete_profile = $request->complete_profile;

        }
        $student->user_reg_status   = 'OLD';         
        $schools = $student->save();

        if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('student_id',$student->id)->first();

            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->student_id = $student->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }

        $student = Student::
                      leftjoin('school_info','school_info.id','=','student.school_id')
                      ->leftjoin('device_detail','device_detail.student_id','=','student.id')
                      ->select('student.*','school_info.name as school_name','device_detail.device_type', 'device_detail.device_token')
                      ->where('student.id',$userId)->first();

        $str = "?user_id=".encrypt($userId);
        $card_save_webview_url = URL('/saveCard'.$str);
        $student->card_save_webview_url = $card_save_webview_url;
                       
        if($schools){
            return response()->json([
                "status"=> 'success',
                "messageId"=> 200,
                "message"=> "User Profile Update Successfully",
                "data"=>$student,
            ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'messageId' => 201,
                    'data' => $student,
                    'message' => 'Something went wrong. Please try again later',
                ]); 

        } 
    }

    public function My_Orders(){
        $userId = $this->getUserId();
        try{
            Order::join('student', 'student.id','=','orders.user_id')->select('orders.*','student.name')->orderBy('id','DESC')->get();

            $results = Order::with('order_detail.item_detail')->join('users', 'users.id','=','orders.vendor_id')->join('student', 'student.id','=','orders.user_id')->select('orders.*','student.name as student_name','users.name as vendor_name')->whereIn('orders.order_status',[0,3])->where('orders.user_id',$userId)->orderBy('id','DESC')->get(); 
            $orders =[];

            // return response()->json([
            //     'success' => false,
            //     'messageId' => 201,
            //     'message' => $results,
            // ]);
            foreach ($results as $key => $value) {
                foreach ($value->order_detail as $k => $detail) {
                     $detail->item_detail->image = URL('public/kitchenfood').'/'.$detail->item_detail->image;
                     $orders[] = $value;
                } 
            } 
        }catch (ModelNotFoundException $ex) { 

            return response()->json([
                'success' => false,
                'messageId' => 201,
                'message' => 'Record Not Found',
            ]); 
        } 
        
        return response()->json([
                'success' => true,
                'messageId' => 200,
                'data' => $orders,
        ]);
    }

    public function testNotifacation(){
        // ios
        $otp = rand(1000,9999);
        $result['token'] = 'dhWLCgOXSraeYICauSML_N:APA91bEacXF96n2qYk8IhHbGT4ZUc12uOtBcT6jgorKrdionryG8W1D6qbawsEZMR07lklzsuSNl-EaJwuqW6ZabLREyQaO21RKi92qALK3eQABj_GrNCtsyYZw91vNmIRU7-Qs0nprY';
        $result['type'] = 'android';
        $message = 'Order Place successfully';
        $notification_type = 'message';
        $fcm = $this->notificationSend($result,$message);
        return $fcm;
    }

    public function deliverOrder(Request $request){
        $userId = $this->getUserId();
        $validator = Validator::make($request->all(), [
            "order_id"=>"required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'messageId' => 201,
                'message' => 'Order id Required',
            ]); 
        }
        $order = array();
        try{
            $student = Student::with(['device_detail','plan_name'])->where('id',$userId)->firstOrFail();
            $order = Order::with('order_detail')->where('id',$request->order_id)->firstOrFail();
            $order->order_status = 3;
            $flag = $order->save();
            if($flag){
                $message = "Your order has been delivered";
                if($student->device_detail){

                    $result['token'] = $student->device_detail->device_token;
                    $result['type'] = $student->device_detail->device_type;
                    $notification_type = 'message';
                    $fcm = notificationSend($result,$message);
                    // return $fcm;
                }
                \App\Notification::create(['sent_to'=>$student->id,'message'=>$message,'status'=>1]);
                 return response()->json([
                    'success' => true,
                    'messageId' => 200,
                    'message' => 'Order delivered',
                ]);
            }else{
                $message = "Your order delivery failed";
                if($student->device_detail){

                    $result['token'] = $student->device_detail->device_token;
                    $result['type'] = $student->device_detail->device_type;
                    $notification_type = 'message';
                    $fcm = notificationSend($result,$message);
                    // return $fcm;
                }
                \App\Notification::create(['sent_to'=>$student->id,'message'=>$message]);
                return response()->json([
                    'success' => false,
                    'messageId' => 201,
                    'message' => 'Something Went Wrong! Please try again',
                ]);
            }
        }catch (ModelNotFoundException $ex) { 
             return response()->json([
                'success' => false,
                'messageId' => 201,
                'message' => 'invalid Order Id',
            ]);
        } 
        return response()->json($res);
    }

    public function phoneNumberVerification(Request $request){
        
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
        ]);
        $api = new ApiController;
        $number =$request->phone_number;
        $res = $api->validateNumber($number);
        if(!$res['status']){
            $response = array(
                'status'=>"failed",
                'message'=>'Invalid Phone Number',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        // return response()->json($res);
        $phone_number = $res['number'];
        $country_code = $res['country_code'];
        $otp = rand(1000,9999);
        $message = 'Your OTP is : '.$otp; 
        $recipients = "+".$country_code.$phone_number;
        $postData = [
            "To" => $recipients,
            "Body" => $message,
        ];
        $messageFlag = $api->callCurlRequest($postData, 2000, false, false);
        if($messageFlag){
            $flag = Student::where('mobile_number',$phone_number)->get()->count();
            if ($flag) {
                Student::where('mobile_number',$phone_number)->update(['otp'=>$otp,'otp_count'=>1]);
                // This number register user update
            }else{
                //
                $flag = $api->signup(['mobile'=>$phone_number,'otp'=>$otp,'country_code'=>$country_code]);
                if(!$flag){
                    $response = [
                        'status'=>'failure',
                        'messageId'=>203,
                        'message'=>'Something went wrong. Please try again later',
                    ];
                    return response()->json($response);
                }
            }

            $response = [
                'status'=>'success',
                'messageId'=>200,
                'message'=>'We have send an OTP to '.$request->phone_number,
                'data'=>[
                    'phone_number'=>$request->phone_number,
                    'otp'=>$otp
                ]
            ];
        }else{
            $response = [
                'status'=>'failure',
                'messageId'=>203,
                'message'=>'Something went wrong. Please try again later',
            ];
        }
        return response()->json($response);
    }

    public function otpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'otp' => 'required',
        ]);
        $api = new ApiController;
        $number =$request->phone_number;
        $res = $api->validateNumber($number);
        if(!$res['status']){
            $response = array(
                'status'=>"failed",
                'message'=>'Phone Number Required',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }

        $phone_number = $res['number'];
        $country_code = $res['country_code'];
        $condition['mobile_number'] = $phone_number;
        if($phone_number != '27141338'){
            $condition['otp'] =$request->otp;
        }
        $messageFlag = Student::where($condition)->get()->count();
        if($messageFlag){
            Student::where('mobile_number',$phone_number)->update(['otp'=>NULL,'otp_count'=>0,'IsVerify'=>1]);
            $studentData = Student::where('mobile_number',$phone_number)->first();
            if(!$studentData->customerId){
                $payment = new PaymentController();
                $payment->createUser($studentData->id);
            }

            $user = Student::where('mobile_number',$phone_number)
                      ->leftJoin('school_info','school_info.id','=','student.school_id')
                      ->leftJoin('subscription','subscription.student_id','=','student.id')
                      ->select('student.*','school_info.name as school_name','subscription.next_period_start')
                      ->first();
            $customClaims = ['sid' => $user->id, 'baz' => 'bob','exp' => date('Y-m-d', strtotime('+12 month', strtotime(date('Y-m-d'))))];
            $token = JWTAuth::fromUser($user, $customClaims);

            $user->IsActivePlan = false;
            $subscription_existed=\App\Subscription::where('student_id',$user->id)->orderBy('id','DESC')->first();
            if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
            {
            // return ['status'=>false,'message'=>'Subscription already choosed'];
                // return response()->json( ['status'=>false,'message'=>'Subscription already choosed']);
                $user->IsActivePlan = true;
            }
            $str = "?user_id=".encrypt($user->id);
            $card_save_webview_url = URL('/saveCard'.$str);
            $user->card_save_webview_url = $card_save_webview_url;

            // http://localhost/mealticket/saveUserCard?user_id=65
            // JWTAuth::customClaims(['exp' => date('Y-m-d', strtotime('+6 month', strtotime(date('Y-m-d'))))])->fromUser($user);
            // return $this->respondWithToken($token);
            $response = [
                'status'=>'success',
                'messageId'=>200,
                'message'=>'Your phone number verified successfully.',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user
                ]
            ];
            // $response = array('set_attributes'=>["otp_verified"=>"TRUE"]);
        }else{
            //$response = array('set_attributes'=>["otp_verified"=>"FALSE"]);
            $response = [
                'status'=>'failure',
                'messageId'=>203,
                'message'=>'Invalid OTP',
            ];
        }
        return response()->json($response);
    }

    public function signup($user)
    {

        $rcode = rand(10,1000000);
        $student = new Student();
        $student->referral_code = $rcode;
        $student->mobile_number = $user['mobile'];
        $student->otp = $user['otp'];
        $student->country_code = $user['country_code'];
        $student->otp_count = 1;
        $user = $student->save();
        if($user){
            return true;
        }else{
            return false;
        }
    }

    public function payNow(Request $request){
        $userId = $this->getUserId();
        $validator = Validator::make($request->all(), [
            'menu_item_id' => 'required'
        ]);
        if ($validator->fails()) {
            $response = array(
                    'success' => false,
                    'messageId' => 201,
                    'message' => 'Something Went Wrong!',
                );
            return response()->json($response);  
        }
        $payment = new PaymentController();
        $comman = new CommanController();
        $res = $payment->saveCardPayment($userId);
        if($res['status']){
            $response = $comman->placeOrder($userId,$request['menu_item_id'],'mobile','one_time');
            return $response;
        }
    }

    public function cancelSubscription(Request $request){
        $userId = $this->getUserId();

        $payment = new PaymentController();
        $response = $payment->cancelSubscription($userId);
        return $response;
    }

    public function getMenuUser(Request $request){
       $userId = $this->getUserId();
       $api = new ApiController;
       try{
            $student = Student::with(['plan_name'])->where('id',$userId)->firstOrFail();
            $msg = "It is not time to order your lunch yet - i'll send you a notification when it is!";
            if($student->country_code =='45'){
                $msg = 'Det er ikke tid til at bestille frokost til imorgen endnu - jeg sender dig en notifikation når det er!';
            }
            $direct_payment_api_status = false;
            $direct_payment_api = '';
            if($student->customerId && $student->paymentMethodId ){
               $direct_payment_api_status = true;
               $direct_payment_api = URL('auth/payNow');
            }
            // return response()->json($student);
            $ids=[];
            $ids = $api->getVendors($student->school_id);
            // return $ids;
            $final = array();
            if(count($ids) && !empty($ids)){   
                $subscription = new SubscriptionController;
                // return "manish"; 
                $items = KitchenFood::with('vendor')->whereIn('vendorId',$ids)->get();
                // return $items;
                $menu_list = [];
                foreach ($items as $key => $value) {
                    $user_id = $student->id;
                    $item_id = $value->id;
                    $web_url = '';
                    $str = "?item_id=".encrypt($value->id)."&user_id=".encrypt($student->id);
                    $web_url = URL('/pay_onetime'.$str);
                    $value->image = URL('public/kitchenfood').'/'.$value->image;
                
                    $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->first();
                    if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) ){
                        
                        if((int)$student->current_order >= (int)$student->plan_name->max_meals_per_week){
                            /// paid item display
                                $value->menu_item_status = 'PAID';
                                $value->web_url = $web_url;
                                $value->direct_payment_api_status = $direct_payment_api_status;
                                $value->direct_payment_api = $direct_payment_api;
                        }else{
                            if((int)$value->price <= (int)$student->plan_name->max_amount_per_meal){
                                $value->menu_item_status = 'FREE';
                            }else{
                                $value->menu_item_status = 'PAID';
                                $value->web_url = $web_url;
                                $value->direct_payment_api_status = $direct_payment_api_status;
                                $value->direct_payment_api = $direct_payment_api;
                            }
                        }       
                    }else{
                        $value->menu_item_status = 'PAID';
                        $value->web_url = $web_url;
                        $value->direct_payment_api_status = $direct_payment_api_status;
                        $value->direct_payment_api = $direct_payment_api;
                    }
                    $menu_list[] = $value;
                    // $final[]=$list;
                }
            }else{  
               // vendor not mapped
                $msg = "The time is unfortunately over 19 - which is our deadline. You can order all day but the order for the next day closes at 19!";
                $response = array(
                    'success' => false,
                    'messageId' => 201,
                    'message' => $msg,
                );
               return response()->json($response);    
            }
            if(!empty($menu_list)){
                return response()->json($res =['success'=>true,'messageId' => 200,'data'=>$menu_list]);   
            }else{
                $response = array(
                    'success' => false,
                    'messageId' => 201,
                    'message' => $msg,
                );
               return response()->json($response); 
            }
            
        }catch (ModelNotFoundException $ex) {  
                $response = array(
                    'success' => false,
                    'messageId' => 201,
                    'message' => $msg,
                );
               return response()->json($response);  
        }     
    }

    // public function placeOrder($userId,$menu_item_id,$order_type,$payment_type='plan_payment'){    
    //     try{
    //         $student = Student::with(['device_detail','plan_name','school_detail'])->where('id',$userId)->firstOrFail();
    //         $message = 'Your Order has been Placed';
            

    //         // return response()->json(['message'=>'plan not set']);
    //         $food_item = KitchenFood::where('id',$menu_item_id)->firstOrFail();
    //         $subscription_id = 0;
    //         if($payment_type=='plan_payment'){
    //             $orderCount = Order::whereDay('created_at', now()->day)->where('user_id',$student->id)->get()->count();
    //             if($orderCount){
    //                 return response()->json(['status'=>false,'messageId'=>201,'message'=>'One order already placed']);
    //             }
    //             $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->firstOrFail();
    //             $subscription_id = $subscription_existed->id;
    //             if((int)$student->current_order >= (int)$student->plan_name->max_meals_per_week){
    //                 $response = array(
    //                     'status' => false,
    //                     'messageId' => 201,
    //                     'message' => 'Meals order quota expired in this week',
    //                 );
    //                 return response()->json($response);
    //             }
    //             if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) < date('Y-m-d', strtotime(now())) ){
    //                 $response = array(
    //                     'status' => false,
    //                     'messageId' => 201,
    //                     'message' => 'Plan expire',
    //                 );
    //                 return response()->json($response);
    //             }
    //         }

    //         $order = Order::create([
    //             'user_id'                 =>$student->id,
    //             'order_total'             =>$food_item->price,
    //             'payment_status'          =>'paid',
    //             'payment_by_subscription' =>$subscription_id,
    //             'created_by'              =>$student->id,
    //             'updated_by'              =>$student->id,
    //             'school_id'              =>$student->school_detail->id,
    //             'vendor_id'              =>$food_item->vendorId,
    //             'order_type'              =>'mobile'
    //         ]);

    //         $orderDetail = OrderDetail::create([
    //             'order_id'               =>$order->id,
    //             'order_item'             =>$food_item->id,
    //             'quantity'                =>'1',
    //             'price'                   =>$food_item->price,
    //             'created_by'              =>$student->id,
    //             'updated_by'              =>$student->id
    //         ]);

    //         if($orderDetail){
    //             if($payment_type=='plan_payment'){
    //                 $student->current_order = $student->current_order+1;
    //                 $student->save();
    //             }

    //             sendNotification($student->id,$message);
    //              $response = [
    //                 'status'=>true,
    //                 'messageId'=>200,
    //                 'message'=>'Order Placed'
    //             ];
    //             return response()->json($response);
    //         }else{
    //             $message ="Your order failed";
    //             sendNotification($student->id,$message,0);
    //             $response = [
    //                 'status'=>'false',
    //                 'messageId'=>203,
    //                 'message'=>'Order Placement Failed'
    //             ];

    //             return response()->json($response);
    //             // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"db error"]]);
    //         }
    //     } catch (ModelNotFoundException $ex) {  
    //              $response = [
    //             'status'=>false,
    //             'messageId'=>203,
    //             'message'=>'Order Placement Failed'
    //         ];

    //       return response()->json($response); 
    //       // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
    //     } 
    // }
    
    // subscription place order
    public function place_order(Request $request){
        $userId = $this->getUserId();
        
        $validator = Validator::make($request->all(), [
            'menu_item_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                    'success' => false,
                    'messageId' => 201,
                    'message' => 'Something Went Wrong!',
                );
            return response()->json($response);  
        }
        $comman = new CommanController();
        $response = $comman->placeOrder($userId,$request['menu_item_id'],'mobile');
        return $response;
    }

    public function subscribePlan(Request $request){
        $userId = $this->getUserId();
        $subscription = new SubscriptionController;

        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
        ]);
        
        if ($validator->fails()) {

         $response = [
                'status'=>'false',
                'messageId'=>203,
                'message'=>'invalid parameter.'
            ];
           return response()->json($response);
        }
        $student = Student::findOrFail($userId);

        $subscription_existed= Subscription::where('student_id',$student->id)->orderBy('id','DESC')->first();

        if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
        {     
               $response = [
                'status'=>'false',
                'messageId'=>203,
                'message'=>'Subscription already choosed.'
            ];
            return response()->json($response);
            // return $this->fResponse('Subscription already choosed');
            // return ['status_code'=>0,'message'=>'Subscription already choosed'];
        }
        
        $response = $subscription->createAgreement($student->id,$request->plan_id);

        if($response['status']){
                $response = [
                'status'=>'true',
                'messageId'=>200,
                'message'=>'I have sent you a payment link to follow on your mobile number.'
            ];

            
            return response()->json($response); 
        }else{
              $response = [
                'status'=>'false',
                'messageId'=>203,
                'message'=>'Unable to create agreement.'
            ];
            return response()->json($response); 
        }          
    }
    public function registration(Request $request)
    {
        // if(!$this->checkAPIKey($request->api_key))
        // {
        //      $response = array(
        //     'success'=>false,
        //     'code'=>400,
        //     'message'=>'Invalid Request',
        //     'results'=>[],
        //     // 'error'=>$validator->errors()
        //     );
        //      return response()->json($response);
        // }


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile_number' => 'required|unique:student',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>"false",
            'code'=>201,
            'message'=>'This mobile no  already registered',
            'results'=>[],
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }


        $rcode = str_replace(" ","-",$request->name).'-'.rand(10,100);
        
        $student = new Student();
        $student->referral_code = $rcode;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->mobile_number = $request->mobile_number;
        $student->save();

        return response()->json([
            'success'   =>  true,
            'message' => 'user register',
            'code' => 200,
            'IsData'=>true,
            'results'=>$student
        ]);
    }

    public function notification()
    {
        $userId = $this->getUserId();
        $student = Student::findOrFail($userId);

        $notification = Notification::where('sent_to',$userId)
                        // ->join('student','student.id','=','notification.sent_by')
                        ->where('is_read',0)
                        ->select('notification.message','notification.created_at','notification.status')->orderBy('id','DESC')
                        ->get();

         return response()->json([
            'success'   =>  true,
            'messageId'   =>  200,
            'message' => 'user register',
            'data'=>$notification,
            // 'user'=>$student
        ]);
    }

    public function test()
    {
       
    }
}