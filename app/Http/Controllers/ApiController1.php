<?php
namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Student;
use App\School;
use App\Plan;
use App\Referral;
use App\Order;
use App\OrderDetail;
use App\SchoolVendorMapping;
use App\KitchenFood;
use App\Websitesetting;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ApiController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;
    private $api_key = 'testmanish';

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cron(){
        date_default_timezone_set("Europe/Copenhagen");
        // $time = date('Y-m-d H:i:s');
        // echo $time."<br/>";
        // die;
        // $time = date('H',time());
        // echo $time."<br/>";
        // if($time >= '10'){
        //     echo "time Over";
        //     die;
        // }else{
        //     echo "order time";
        //     die;
        // }

        // echo $time."<br/>";

        // die;
        // date_default_timezone_set("Asia/Kolkata");
        // $myfile = fopen("student.txt", "a+") or die("Unable to open file!");

        $time = date('H:i:s',time());
        echo $time."<br/>";
        // $txt = "---Message Trigger in chatbot ".$time."---\n";

        $schools = School::with('student_detail')->where('last_order_time', '>', $time)->whereIN('cron_status',[0,1])->get();

        if($schools->count() && !empty($schools)){
            foreach ($schools as $key => $value) {
                echo "Name ".$value->name.'<br/><br/>';
                // $value->cron_status = $value->cron_status+1;
                // $value->save();
                if($value->student_detail->count()){
                    echo "Student Name:  ".$value->name."<br/>";
                    // echo "messenger_id = ".$student->messenger_id."<br/>";
                    foreach ($value->student_detail as $k => $student) {
                        if($student->plan_id){
                            if($student->messenger_id){
                                $orderCount = Order::whereDay('created_at', now()->day)->where('user_id',$student->id)->get()->count();
                                // hit message to chatbot
                                if(!$orderCount)
                                echo "messenger_id = ".$student->id.'('.$student->messenger_id.')'."<br/>";
                                // $txt .= $student->messenger_id.',';
                                // $this->sendMessage($student->messenger_id);
                            }
                        }
                    }
                }
            }
            // $txt .= "---***End***---\n";
        }

        // fwrite($myfile, $txt);
        // fclose($myfile);
        //     $this->info('word:day Cummand Run successfully!');
        // }
    } 

    public function checkAPIKey($key) 
    {
        // echo $this->api_key;
        // echo $key;
        // die;
        if($this->api_key === $key){

        return true;
        // die;
        }else{
        return false;
        }
    }

    public function cancelAgreement(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);

        if($validator->fails()) {
           // return response()->json(['set_attributes'=>["subscription_status"=>"FALSE"]]);
           return response()->json(['set_attributes'=>["subscription_status"=>"TRUE"]]);
        }
        try{
            $student = Student::with(['plan_name','school_detail'])->where('messenger_id',$request->user_id)->firstOrFail();
            if(!$student->plan_name){
                // return response()->json(['status'=>"plan not subscribe"]);
                return response()->json(['set_attributes'=>["subscription_status"=>"TRUE"]]);
            }
            // return ['payment_gateway'=>'paygate','student_id'=>$student->id];
            $subscription_existed=\App\Subscription::where(['payment_gateway'=>'paygate','student_id'=>$student->id])->first();
            $subscription = new SubscriptionController;
            // 
            if($subscription_existed){
                $response = $subscription->cancelAgreementData($subscription_existed->agreement_id);

                // $response = $subscription->cancelAgreementData();
                // return $response;
                if(!$response['status']){
                   $subscription->doCancelAgreement($subscription_existed->agreement_id);
                   return response()->json(['set_attributes'=>["subscription_status"=>"FALSE"]]);
                }
                return response()->json(['set_attributes'=>["subscription_status"=>"TRUE"]]);
                // $subscription->cancelAgreementData($subscription_existed->agreement_id);
            }else{
                return response()->json(['set_attributes'=>["subscription_status"=>"TRUE"]]);
            }
            // return response()->json(['status'=>$subscription_existed]);
        } catch (ModelNotFoundException $ex) {  
          return response()->json(['set_attributes'=>["subscription_status"=>"TRUE"]]);
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        }     
    }

    public function getPrevOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            $res =["messages"=>[
            [
                "text"=> "Vi er desværre ikke i stand til at hente din tidligere ordre",
                "quick_replies"=> [
                        [
                            "title"=>"Hovedmenu",
                            "block_names"=> ["Menu Welcome flow"]
                        ],
                        [
                            "title"=>"Kontakt support",
                            "block_names"=> ["Support Us"]
                        ]
                    ]
            ]
            ]]; 
           return response()->json($res);
        }
        $order = array();
        try{
            $student = Student::with(['plan_name'])->where('messenger_id',$request->user_id)->firstOrFail();
            $orders = Order::with('order_detail.item_detail')->whereIn('order_status',[0,3])->where('user_id',$student->id)->get();
            if($orders->count() && !empty($orders)){
                foreach ($orders as $key => $value) { 
                    $ids = $value->order_detail->pluck('order_item');
                    $item_name = [];
                    $itemData = [];
                    if(!empty($ids)){
                        $item_name = KitchenFood::whereIn('id',$ids)->get()->pluck('name')->toArray(); 
                    }
                    if($value->order_status ==0){
                        $itemData = [
                                "title"=>implode(',', $item_name),
                                "subtitle"=>"Amount Kr ".(int)$value->order_total,
                                "buttons"=>[
                                    [
                                        "type" =>"show_block",
                                        "block_names"=>["Deliver Order"],
                                        "title"=>"Mark leveret.",
                                        "set_attributes"=> [
                                            "order_id"=>$value->id
                                        ]
                                    ]
                                ],
                        ];
                    } else if($value->order_status ==3){
                        $itemData = [
                            "title"=>implode(',', $item_name),
                            "subtitle"=>"Amount Kr ".(int)$value->order_total
                        ];
                    } 
                    if(!empty($itemData))
                    $order[] = $itemData;
                }
            }else{
                $res =[
                    'messages'=>[
                        [
                            "text"=> "Du har ikke tidligere ordrer",
                            "quick_replies"=> [
                                [
                                    "title"=>"Hovedmenu",
                                    "block_names"=> ["Menu Welcome flow"]
                                ]
                        ]    ]
                    ]
                ];
                return response()->json($res); 
            }
        }catch (ModelNotFoundException $ex) { 

        $res =["messages"=>[
            [
                "text"=> "Vi er desværre ikke i stand til at hente din tidligere ordre",
                "quick_replies"=> [
                        [
                            "title"=>"Hovedmenu",
                            "block_names"=> ["Menu Welcome flow"]
                        ],
                        [
                            "title"=>"Kontakt support",
                            "block_names"=> ["Support Us"]
                        ]
                    ]
            ]
        ]]; 
          return response()->json($res); 
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        } 
        // $results =[1,2];
        

        $res = ['messages' =>[
                ["attachment"=>[
                    "type"=>"template",
                    "payload"=>[
                        "template_type"=>"generic",
                        "image_aspect_ratio"=>"square",
                        "elements"=>$order
                    ],
                ]]
        ]];
        return response()->json($res);

    }

    public function deliverOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            "order_id"=>"required"
        ]);
        if ($validator->fails()) {
            $res =["set_attributes"=>[
                "order_delivered_status"=> "FALSE"
            ]]; 
           return response()->json($res);
        }
        $order = array();
        try{
            $student = Student::with(['plan_name'])->where('messenger_id',$request->user_id)->firstOrFail();
            $order = Order::with('order_detail')->where('id',$request->order_id)->first();
            $order->order_status = 3;
            $flag = $order->save();
            if($flag){
                $res =["set_attributes"=>[
                "order_delivered_status"=> "TRUE"
                ]];
            }else{
                $res =["set_attributes"=>[
                "order_delivered_status"=> "FALSE"
                ]];
            }
        }catch (ModelNotFoundException $ex) { 
            $res =["set_attributes"=>[
                "order_delivered_status"=> "FALSE"
            ]];  
          return response()->json($res); 
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        } 
        return response()->json($res);
    }
        

    public function place_order(Request $request){
        $validator = Validator::make($request->all(), [
            'menu_item_id' => 'required',
            'user_id' => 'required',
        ]);
       
        if ($validator->fails()) {
           return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]);
        }
        try{
            $student = Student::with(['plan_name','school_detail'])->where('messenger_id',$request->user_id)->firstOrFail();
            $orderCount = Order::whereDay('created_at', now()->day)->where('user_id',$student->id)->get()->count();

            if($orderCount){
            return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]);
            }

            if((int)$student->current_order >= (int)$student->plan_name->max_meals_per_week){
                 return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]);
            }

            date_default_timezone_set(config('constants.TIME_ZONE'));
            $time = date('H',time());
            if($time >= '19'){
                // echo "time over";
                // return response()->json(['set_attributes'=>['order_placed'=>"FALSE","message"=>'time over']]);
                return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]);
            }

            // return response()->json(['message'=>'plan not set']);
            $food_item = KitchenFood::where('id',$request->menu_item_id)->firstOrFail();
            $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->firstOrFail();
            $subscription_id = $subscription_existed->id;
            if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) < date('Y-m-d', strtotime(now())) ){
                return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]);
            }
            $order = Order::create([
                'user_id'                 =>$student->id,
                'order_total'             =>$food_item->price,
                'payment_status'          =>'paid',
                'payment_by_subscription' =>$subscription_id,
                'created_by'              =>$student->id,
                'updated_by'              =>$student->id,
                'school_id'              =>$student->school_detail->id,
                'vendor_id'              =>$food_item->vendorId,
                'order_type'              =>'chatbot'
            ]);

            $orderDetail = OrderDetail::create([
                'order_id'               =>$order->id,
                'order_item'             =>$food_item->id,
                'quantity'                =>'1',
                'price'                   =>$food_item->price,
                'created_by'              =>$student->id,
                'updated_by'              =>$student->id
            ]);

            if($orderDetail){
                $student->current_order = $student->current_order+1;
                $student->save();
                sendNotification($student->id,"Your Order has been Placed",1);
                return response()->json(['set_attributes'=>['order_placed'=>"TRUE"]]);
            }else{
                sendNotification($student->id,"Your order failed",0);
                return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]);
                // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"db error"]]);
            }
        } catch (ModelNotFoundException $ex) {  
          return response()->json(['set_attributes'=>['order_placed'=>"FALSE"]]); 
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        } 
        

        return response()->json($request->all());
    }

    public function verifyReferralCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'referral_code' => 'required'
            // 'user_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json(['status'=>"FALSE"]);
        }
        $studet = Student::where(['referral_code'=>$request->referral_code])->get()->first();
    
        if($studet){
            // if($studet->ambassador){
            //     $referred_by_credit = config('constants.referred_by_ambassador_credit');
            // }else{
            //     $referred_by_credit = config('constants.referred_by_credit');
            // }
            // $user = Referral::updateOrCreate([
            //   'referred_by'             =>$studet->id,
            //   'referred_to'             =>$request->user_id
            // ],['referred_by_credit'      =>$referred_by_credit,
            //   'referred_to_credit'      =>config('constants.referred_to_credit')]);
            // Student::where('referral_code',$request->referral_code)->update(['referral_code_count'=>($studet->referral_code_count+1)]);
            $response = [
                'set_attributes'=> ['refereed_status'=>"TRUE"]
            ];
        }else{
            $response = ['set_attributes'=> ['refereed_status'=>"FALSE"]];
        }
        return response()->json($response);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
            'otp' => 'required',
        ]);
        $res = $this->validateNumber($request->mobile_number);
        // return response()->json($res);
        if(!$res['status']){
            $response = array(
                'status'=>"failed",
                'message'=>'Invalid Mobile Number or OTP',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        
        $mobile_number = $res['number'];
        $country_code = $res['country_code'];

        // if ($validator->fails()) {
        //     $response = array(
        //         'status'=>"failed",
        //         'message'=>'Invalid Mobile Number or OTP',
        //         'error'=>$validator->errors()
        //     );
        //    return response()->json($response);
        // }
        $student = Student::where(['mobile_number'=>$mobile_number,'otp'=>$request->otp])->first();
        
        if($student){
            // $student = $query->first();
            $user_plan_set = "FALSE";
            $user_school_set = "FALSE";
            $user_refereed = "FALSE";
            if(Referral::where('referred_to',$student->id)->count()){
                $user_refereed = 'TRUE';
            }
            $user_reg_status = $student->user_reg_status;
            $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->first();
            if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
            {
                $user_plan_set = "TRUE";
            }

            // if($student->plan_id){$user_plan_set = "TRUE";}
            if($student->school_id){$user_school_set = "TRUE";}

            Student::where('mobile_number',$mobile_number)->update(['otp'=>NULL,'otp_count'=>0,'IsVerify'=>1]);
            $response = array('set_attributes'=>[
                "otp_verified"=>"TRUE",
                "user_school_set"=>$user_school_set,
                "user_plan_set"=>$user_plan_set,
                'user_reg_status'=>$user_reg_status,
                'user_refereed'=>$user_refereed]);
        }else{
            $response = array('set_attributes'=>["otp_verified"=>"FALSE"]);
        }
        return response()->json($response);
    }

    public function resendOpt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|integer',
            'country_code' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json(['status'=>"failed"]);
        }
        $student = Student::where('mobile_number',$request->mobile_number)->get()->first();
        if($student->otp_count ==3){
            // new otp generate
            $otp = rand(1000,9999);
            $flag = Student::where('mobile_number',$request->mobile_number)->update(['otp'=>$otp,'otp_count'=>1]);
        }else{
            // use old OTP
            $otp = $student->otp;
            $flag = Student::where('mobile_number',$request->mobile_number)->update(['otp'=>$otp,'otp_count'=>($student->otp_count+1)]);
        }
        
        if (!$flag) {
            // This number not register 
          return response()->json(['status' => 'failed']); 
        }
        $message = 'Your OTP is : '.$otp; 
        $recipients = $request->country_code.$request->mobile_number;
        $postData = [
            "To" => "+" . $recipients,
            "Body" => $message,
        ];
        
        $messageFlag = $this->callCurlRequest($postData, 2000, false, false);
        if($messageFlag){
            $response = array('status'=>'success');
        }else{
            $response = array('status'=>'failed');
        }
        return response()->json($response);

    }

    public function validateNumber($number){
        $number = str_replace(' ', '', $number);
        $ext = substr($number, 0, 1);
        $country_code = substr($number, 0, 3);
        $number = str_replace('+', '', $number);
        // $n = config('constants.NUMBER_LENGTH');
        // echo substr($number, 0, 1);
        $number_length = 8;
        $code = 45;
        if($ext == '+'){
            //
            if($country_code == '+91'){
                // echo "india";
                $number_length = 10;
                $code = 91;
            }else if($country_code == '+45'){
                // echo "denmark";
                $number_length = 8;
                $code = 45;
            }else{
                return ['status'=>false];
            }
        } else if(strlen($number) >= 10){
            $number_length = 10;
            $code = 91;
            if(substr($number, 0, 2) == 45){
                $number_length = 8;
                $code = 45;
            }
            // echo 'india';
           
        }else{
            // echo "denmark";
            $number_length = 8;
            $code = 45;
        }
        // echo strlen($number);
        // $start = strlen($number) - $number_length; 
        // $mobile_number = substr($number, $start);
        // echo ' : '.$start;
        // echo ' : '.$mobile_number;
        // return ['status'=>true,'number'=>$mobile_number,'country_code'=>$code];
        // die;
        if(strlen($number) >= 8){
            $start = strlen($number) - $number_length; 
            $mobile_number = substr($number, $start);
            return ['status'=>true,'number'=>$mobile_number,'country_code'=>$code];
        }else{
            return ['status'=>false];
        }
    }

    public function sendOpt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required',
        ]);
        $number =$request->mobile_number;
        $number = str_replace(' ', '', $request->mobile_number);
        $res = $this->validateNumber($request->mobile_number);
        if(!$res['status']){
            $response = array(
                'status'=>"failed",
                'message'=>'Invalid Mobile Number',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        
        $mobile_number = $res['number'];
        $country_code = $res['country_code'];
        $otp = rand(1000,9999);
        $message = $otp." er din MealTicket-otp til verifikation af mobilnummer"; 
        $recipients = "+".$country_code.$mobile_number;
        $postData = [
            "To"    => $recipients,
            "Body"  => $message,
        ];
        $messageFlag = $this->callCurlRequest($postData, 2000, false, false);
        // return response()->json($res);
 
        if($messageFlag){

            $student = Student::where('mobile_number',$mobile_number)->first();
            if (!$student) {
                // $res['message'] = "new user";
                // This number not register
                $messageFlag = $this->signup(['mobile'=>$mobile_number,'otp'=>$otp,'country_code'=>$country_code]);
                // return response()->json(['status' => 'failed']); 
            }else{
                // $res['message'] = "already register";
                $messageFlag = Student::where('mobile_number',$mobile_number)->update(['otp'=>$otp,'otp_count'=>1]); 
            }
            $response = array('status'=>'success');
        }else{
            $response = array('status'=>'failed');
        }
        return response()->json($response);
    }

    public function createChargeSession($student_id=1)
    {

        $user=\App\Student::find($student_id);
        if(!$user) return []; 
        $handle=rand(1000000000,9900000009);

        
        // $session_data['configuration']='checkoutConfig-fb944';
        // $session_data['locale']='da_DK';
        // $session_data['accept_url']='http://mealticketweb.rampwin.com/charge_subscription';
        // $session_data['cancel_url']='http://mealticketweb.rampwin.com/cancel_subscription';
        // $session_data['payment_methods']=['visa'];
        $session_data['button_text']="Signup";
        //Customer info
        $customer_info['email']=$user['email'];
        $customer_info['address']=$user['address'];
        $customer_info['handle']=$handle;
        $customer_info['first_name']=$user['name'];
        //Added customer info
        $session_data['create_customer']=$customer_info;

        $payload_data=json_encode($session_data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://checkout-api.reepay.com/v1/session/recurring');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'priv_b3510b505ef54bbd69db5ae0440b09ed' . ':' . '');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return ['starus'=>false];
        }
        curl_close ($ch);
        $result= json_decode($result,TRUE);

        return ['starus'=>true,'session_id'=>$result['id'],'handle'=>$handle];
    }
    
    public function getVendors($school_id){
        $ids=[];
        date_default_timezone_set(config('constants.TIME_ZONE'));
         $time = date('H:i:s',time());
        $ids = SchoolVendorMapping::with(['school_list'])->whereHas('school_list',function($query) use ($time){
            // $query->where('start_order_time', '<', $time);
            $query->where('last_order_time', '>=', $time);
        })->where('school_id',$school_id)->get()->pluck('vendor_id');
        return $ids;
    }

    public function getMenuItems(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json(['set_attributes'=>['menu_availability'=>"FALSE",'message'=>"User not found"]]);
        }  
        // return response()->json(['set_attributes'=>['menu_availability'=>"FALSE"]]);
        // return $request->user_id
        try{
            $student = Student::with(['plan_name'])->where('messenger_id',$request->user_id)->firstOrFail();
            // // return response()->json($student);
            $ids = $this->getVendors($student->school_id);
            // print_r($ids);
            // die;
            // return response()->json($ids);
            $final = array();
            $error = false;
            if(count($ids) && !empty($ids)){   
                // return response()->json($res = ['set_attributes'=>['registered_user'=>"FALSE",'message'=>$sessionData]]); 
                
                $items = KitchenFood::whereIn('vendorId',$ids)->get();
                foreach ($items as $key => $value) {
                    $user_id = $student->id;
                    $item_id = $value->id;
                    $web_url = '';
                    $str = "?item_id=".encrypt($value->id)."&user_id=".encrypt($student->id);
                    $web_url = URL('/pay_onetime'.$str);

                    $image_url = '';
                    if($value->image){
                        $image_url = URL('public/kitchenfood').'/'.$value->image;
                    }
                    $list = [];
                    $list['title'] = $value->name;
                    $list['image_url'] = $image_url;
                    $list['subtitle'] = $value->description;
                    $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->first();
                    if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) ){

                            if((int)$student->current_order >= (int)$student->plan_name->max_meals_per_week){
                                // paid
                                $list['buttons'] = [[
                                    "set_attributes"=>[
                                        "menu_item_id"=>$value->id,
                                        "menu_item_name"=>$value->name,
                                        "menu_item_status"=>'PAID',
                                    ],
                                    "type"=>"web_url",
                                    "url"=>$web_url,
                                    'title' => "Pay"
                                ]];

                            }else{
                                if((int)$value->price <= $student->plan_name->max_amount_per_meal){   
                                    $list['buttons'] = [[
                                        "set_attributes"=>[
                                            "menu_item_id"=>$value->id,
                                            "menu_item_name"=>$value->name,
                                            "menu_item_status"=>'FREE',
                                        ],
                                        "block_names"=>["Order Confirmation"],
                                        "type"=>"show_block",
                                        'title' => "Den nupper jeg"
                                    ]];
                                    // $final[]=$list;
                                }else{
                                    $list['buttons'] = [[
                                        "set_attributes"=>[
                                            "menu_item_id"=>$value->id,
                                            "menu_item_name"=>$value->name,
                                            "menu_item_status"=>'PAID',
                                        ],
                                        "type"=>"web_url",
                                        "url"=>$web_url,
                                        'title' => "Pay"
                                    ]];
                                }
                            }                       
                    }else{
                        // $messageDanish = "Din plan er ikke aktiv";
                        // $error = true;
                        $list['buttons'] = [[
                            "set_attributes"=>[
                                "menu_item_id"=>$value->id,
                                "menu_item_name"=>$value->name,
                                "menu_item_status"=>'PAID',
                            ],
                            "type"=>"web_url",
                            "url"=>$web_url,
                            'title' => "Pay"
                        ]];
                    }
                    $final[]=$list;
                }
            }else{       
                // return response()->json(['set_attributes'=>['menu_availability'=>"FALSE",'message'=>"school mapping not exist"]]);
                $messageDanish = "The time is unfortunately over 19 - which is our deadline. You can order all day but the order for the next day closes at 19!";
                $error = true;
            }
            if(!$error){


                $res = ["messages"=>[[
                "attachment" =>[
                    "type"=>"template",
                    "payload"=>[
                        "template_type"=>"generic",
                        "image_aspect_ratio"=>"square",
                        "elements"=>$final
                    ],
                   
                ]
                ]]]; 
            }else{
                $res = ["messages"=>
                            [
                                [
                                    "text"=>$messageDanish,
                                    "quick_replies" =>[
                                        [
                                            "title"=>"Kontakt support",
                                            "block_names"=> ["Contact Us"]
                                        ],
                                        [
                                            "title"=>"Hovedmenu",
                                            "block_names"=>["Menu Welcome flow"]
                                        ]            
                                    ]
                                ]
                            ]
                        ]; 
            }        
        
        }catch (ModelNotFoundException $ex) {
            $res = ["messages"=>
                [
                    [
                        "text"=>"bruger ikke fundet",
                        "quick_replies" =>[
                            [
                                "title"=>"Kontakt support",
                                "block_names"=> ["Contact Us"]
                            ],
                            [
                                "title"=>"Hovedmenu",
                                "block_names"=>["Menu Welcome flow"]
                            ]            
                        ]
                    ]
                ]
            ];  
          return response()->json($res); 
        }
        return response()->json($res); 
        // $student = Student::with(['school_detail'])->get()->toArray();
        // echo $request->user_id;
    }

    public static function callCurlRequest($postFields = array(), $timeout = 2000, $asynch = false, $postAsBodyParam = false)
    {
        $account_sid = config('constants.TWILIO_SID');
        $auth_token = config('constants.TWILIO_TOKEN');
        $twilio_number = config('constants.SENDER_NUMBER');
        $url = "https://api.twilio.com/2010-04-01/Accounts/" . $account_sid . "/Messages.json";
        // $postFields['From'] = "+" .$twilio_number;
        $SenderID = substr($postFields['To'], 0, 3) == '+45'?'MealTicket': "+" .$twilio_number;
        $postFields['From'] = $SenderID;

        $headers = ['Content-Type:application/x-www-form-urlencoded'];
        $userPass = $account_sid . ":" . $auth_token;

           $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            if (is_array($postFields) && count($postFields)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            if ($postAsBodyParam === true) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, @json_encode($postFields));
            } elseif ($postAsBodyParam === 5) {
                // $postAsBodyParam = 5 means put as it is
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
           if ($userPass) {
                curl_setopt($ch, CURLOPT_USERPWD, $userPass);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if (is_array($headers) && count($headers)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            } else {
                $headers = array("Content-Type: application/json");
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
            // Asynchronous Request
            if ($asynch === true) {
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            } else {
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            
            // return false;
            $result = curl_getinfo($ch);
            // print_r($result);
            // return $result;
            // die;
            curl_close($ch);
            if ($asynch || (isset($result['http_code']) && in_array($result['http_code'], [200, 201, 202, 204]))) {
                return $response;
            } else {
                return false;
            }
    } 

    public function school_list(Request $request){
        $validator = Validator::make($request->all(), [
            'user_selected_district' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'code'=>201,
            'message'=>'Validation Error',
            'results'=>[],
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }

        $schoolResults = School::select('id','name')->where(['status'=>1,'region_name'=>$request->user_selected_district])->orderBy('id','DESC')->get()->toArray();
        $schools = array();
        foreach ($schoolResults as $key => $value) {
            $tempArr = array();
            $tempArr['title'] = $value['name'];
            $tempArr['set_attributes']['user_selected_school'] = $value['id'];
            $tempArr['set_attributes']['user_selected_school_name'] = $value['name'];
            // $tempArr['image'] = URL('public/school-img').'/'.$value['image'];
            $schools[] =$tempArr;
        }
        $addBlock = [ 
            "block_names"=>["Ask District"],
            "type"=> "show_block",
          "title"=> "nulstil region"
        ];
        $schools[] =$addBlock;
        if(!empty($schools)){

            return response()->json(["messages"=>[
                [
                "text"=> "Vælg din skole?",
                "quick_replies"=>$schools]
            ] ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'no records',
                    'results' => [],
                ], 401); 

        } 
    }

    public function recurringSession($user_id=1,$plan_id='plan-0be22')//user id means student id
    {   
        
        $user=\App\Student::find($user_id);
        if(!$user) return []; 
        $handle=rand(1000000000,9900000009);

        
        // $session_data['configuration']='checkoutConfig-fb944';
        // $session_data['locale']='da_DK';
        $session_data['accept_url']=URL('/charge_subscription');
        $session_data['cancel_url']=URL('/cancel_subscription');
        // $session_data['payment_methods']=['visa'];
        $session_data['button_text']="Signup";
        //Customer info
        $customer_info['email']=$user['email'];
        $customer_info['address']="address";
        // $customer_info['address']=$user['address'];
        
        $customer_info['handle']=$handle;
        $customer_info['first_name']=$user['name'];
        //Added customer info
        $session_data['create_customer']=$customer_info;
        // return $session_data;
        $payload_data=json_encode($session_data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://checkout-api.reepay.com/v1/session/recurring');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'priv_b3510b505ef54bbd69db5ae0440b09ed' . ':' . '');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        // return curl_errno($ch);
        if (curl_errno($ch)) {
            return [];
        }
        curl_close ($ch);
        $result= json_decode($result,TRUE);
        // return $result;
        return ['session_id'=>$result['id'],'handle'=>$handle];        
    }

    public function getPlanDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'code'=>201,
            'message'=>'Validation Error',
            'results'=>[],
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        $student = Student::where('messenger_id',$request->user_id)->first();

        if(!$student){
            return response()->json(["set_attributes"=>["status"=>'FALSE','message'=>'user not found']]);
        }


        $user_id = $student->id;
        $planResults = Plan::where('deleted',0)->orderBy('id','DESC')->get()->toArray();
        $plans = array();
        foreach ($planResults as $key => $value) {
            $plan_id = $value['plan_id'];
            $str = "?plan_id=".encrypt($value['plan_id'])."&user_id=".encrypt($user_id);
            $web_url = URL('pay_subscription'.$str);
            $tempArr = array();
            $tempArr['title'] = $value['name'];
            $tempArr['subtitle'] = ""; // 'Kr '.$value['price'].'/week, '.$value['max_meals_per_week'].'/meals per week, Kr '.$value['max_amount_per_meal'].'/max amount per meal';
            $tempArr['buttons'] = [[
                "set_attributes" =>[
                    "selected_plan_id"=>$value['id']
                ],
                "block_names"=>["Subscribe Plan"],
                "type"=>"show_block",
                "url"=>$web_url,
                "title"=>"Tilmeld nu",
            ]];
            $plans[] =$tempArr;
        }

        if(!empty($plans)){
             $arr = [
                'messages'=>[
                        [
                            "attachment"=>[
                                "type"=>"template",
                                "payload"=>[
                                    "template_type"=>"generic",
                                    "image_aspect_ratio"=>"square",
                                    "elements"=>$plans
                                ]
                        ]
                    ]
                ]
            ];
            return response()->json($arr); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'no records',
                    'results' => [],
                ], 401); 

        } 
    }

    public function subscribePlan_old(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required',
            "selected_plan_id"  => "required"
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'code'=>201,
            'message'=>'Validation Error',
            );
           return response()->json($response);
        }
        $student = Student::where(['messenger_id'=>$request->user_id])->first();

        // $message = 'Your OTP is : '.$otp; 
        // $recipients = "+".config('constants.COUNTRY_CODE').$mobile_number;
        // $postData = [
        //     "To" => "+" . $recipients,
        //     "Body" => $message,
        // ];
        // $messageFlag = $this->callCurlRequest($postData, 2000, false, false);

        if($student){
            $arr = [
                'messages'=>[
                    [
                        "text"=>"I have sent you a payment link to follow on your mobile number"          
                    ]
                ]
            ];
            return response()->json($arr); 
        }else{

            return response()->json(["set_attributes"=>["status"=>'FALSE']]); 

        } 
    }

    public function getReferralDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'code'=>201,
            'message'=>'Validation Error',
            );
           return response()->json($response);
        }
        $student = Student::where(['messenger_id'=>$request->user_id])->first();
        if($student){
            $arr = [
                'messages'=>[
                    [
                        "attachment"=>[
                            "type"=>"template",
                            "payload"=>[
                                "template_type"=>"generic",
                                "image_aspect_ratio"=>"square",
                                "elements"=>[
                                    [
                                    "title"=>"Referral Code: ".$student->referral_code,
                                    "image_url"=>URL('/')."/public/app_barcode.png",
                                    "subtitle"=>"Please share the QR code or referral code with your friends"
                                    ]
                                ]
                            ]

                        ]
                       
                    ]
                ]
            ];
            return response()->json($arr); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'no records',
                    'results' => [],
                ]); 

        } 
    }

    public function getDistrict(){
        $schoolResults = School::select('id','name','address','zipcode','latitude','longitude','contact_number','email','region_name')->where('status',1)->orderBy('id','DESC')->groupBy('region_name')->get()->toArray();
        $schools = array();
        foreach ($schoolResults as $key => $value) {
            $tempArr = array();
            $tempArr['title'] = $value['region_name'];
            $tempArr['set_attributes']['user_selected_district'] = $value['region_name'];
            // $tempArr['image'] = URL('public/school-img').'/'.$value['image'];
            $schools[] =$tempArr;
        }
        if(!empty($schools)){

            return response()->json(["messages"=>[["text"=> "Vælg dit område:","quick_replies"=>$schools] ]]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'no records',
                    'results' => [],
                ], 401); 

        } 
    }

    public function getCredit(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'code'=>201,
            'message'=>'Validation Error',
            );
           return response()->json($response);
        }
        $student = Student::where(['messenger_id'=>$request->user_id])->first();
        if($student){
            $referred_by_credit_total = Referral::where(['referred_by'=>$student->id,'approval_status'=>1])->get()->sum('referred_by_credit');
            $referred_to_credit_total = Referral::where(['referred_to'=>$student->id,'approval_status'=>1])->get()->sum('referred_to_credit');
            $amount = $referred_to_credit_total+$referred_by_credit_total;
            $arr = [
                "set_attributes"=>[
                        "user_credit"=>$amount
                    ]
                    
                ];
            return response()->json($arr); 
        }else{
            return response()->json(["set_attributes"=>["status"=>'FALSE']]); 
        } 
    }
  
    public function registered_user(Request $request){
        $myfile = fopen("create_agreement.txt", "a+") or die("Unable to open file!");
        
        $time = date('H:i:s',time());
        $txt = "---registered_user  ".$time."---\n";
        $txt .= json_encode($request->all());
        fwrite($myfile, $txt);
        fclose($myfile);
        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'school_id' => 'required',
            // 'refereed_by' => 'required',
            'mobile_number' => 'required',
            // 'plan_id' => 'required',
        ]);

        $res = $this->validateNumber($request->mobile_number);
        if(!$res['status']){
            $response = array(
                'status'=>"failed",
                'message'=>'Invalid Mobile Number',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        // return response()->json($res);
        $mobile_number = $res['number'];
        $country_code = $res['country_code'];
        $web_setting = Websitesetting::first();
      
        if ($validator->fails()) {
           return response()->json(['set_attributes'=>['registered_user'=>"TRUE",'message'=>'Validation Error']]);
        }
        if($request->user_id){
            $studetCount = Student::where('messenger_id',$request->user_id)->get()->count();
            if($studetCount){
                return response()->json(['set_attributes'=>['registered_user'=>"TRUE",'message'=>'Aleady Exist User']]);
            }
        }
        
        try{
            // $student = Student::where('mobile_number',$request->mobile_number)->count();
            // $student = Student::where('mobile_number',$request->mobile_number)->first();
            $student = Student::where('mobile_number',$mobile_number)->firstOrFail();
            $student->school_id   = $request->school_id;
            $student->messenger_id   = $request->user_id;
            $student->user_reg_status   = 'OLD';
            $comman = new CommanController();
            if($request->plan_id){
                $student->plan_id   = $request->plan_id;
            }
            if($request->first_name){
                $len = strlen($mobile_number);
                if(!$student->referral_code){
                    $student->referral_code  = $comman->generateCode($request->first_name,$student->mobile_number);
                }
                // $student->referral_code   = substr($request->first_name, 0,4).substr($mobile_number,-2);
                // $student->referral_code = $this->generateCode($request->first_name,$mobile_number);
                $student->name   = $request->first_name;
            }

            if($request->last_name){
                $student->last_name   = $request->last_name;
            }

            if($request->email){
                $student->email   = $request->email;
            }

            if($request->school_year){
                $student->school_year = $request->school_year;
            } 

            if($request->is_ambassador){
                if($request->is_ambassador == 'TRUE'){
                    $student->ambassador   = 1;
                    
                    // create plan
                    $plan=\App\Plan::first();
                    $student->plan_id   = $plan->id;
                    $user = \App\Subscription::updateOrCreate([
                        'plan_id'       =>$plan->id,
                        'student_id'    =>$student->id
                        ],[
                            'price'             => $plan->price,
                            'payment_gateway'   => 'ambassador_package',
                            'transaction_id'    => 0,
                            'next_period_start' => date('Y-m-d', strtotime('+6 month', strtotime(date('Y-m-d')))),
                            'agreement_id'      => rand(1000000000,9900000009)
                    ]);
                }
            }

            if($request->refereed_by){
                $refereed_studet_detail = Student::where(['referral_code'=>$request->refereed_by])->get()->first();
                if($refereed_studet_detail){
                    if($refereed_studet_detail->ambassador){
                        // $referred_by_credit = config('constants.referred_by_ambassador_credit');
                        $referred_by_credit = $web_setting->ref_by_ambas_credit;
                    }else{
                        // $referred_by_credit = config('constants.referred_by_credit');
                        $referred_by_credit = $web_setting->referred_by_credit;
                    }
                    $referred_to_credit = $web_setting->referred_to_credit;
                    $user = Referral::updateOrCreate([
                      'referred_by'             =>$refereed_studet_detail->id,
                      'referred_to'             => $student->id
                    ],['referred_by_credit'      =>$referred_by_credit,
                      'referred_to_credit'      =>$referred_to_credit ]);

                    Student::where('referral_code',$request->refereed_by)->update(['referral_code_count'=>($refereed_studet_detail->referral_code_count+1)]);
                     // $studet->referral_code_count = ($studet->referral_code_count+1);
                    // $response = array(['status'=>"TRUE"]);
                }
            }
            $updateFlag = $student->save();
        }catch (ModelNotFoundException $ex) {  
          return response()->json($res = ['set_attributes'=>['registered_user'=>"FALSE",'message'=>"modal not found"]]); 
        }
       
        if($updateFlag){
            $res = ['set_attributes'=>['registered_user'=>"TRUE"]];
            return response()->json($res); 
        }else{
            $res = ['set_attributes'=>['registered_user'=>"FALSE"]];
            return response()->json($res); 
        } 
    }
    public function subscribePlan(Request $request){
        $subscription = new SubscriptionController;

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'selected_plan_id' => 'required',
        ]);
        
        if($validator->fails()) {
            $res = ['messages'=>[
                [
                    'text'=>"Jeg har sendt dig et betalingslink til abonnementsplan på dit registrerede mobilnummer.",
                    "quick_replies"=>[
                        [
                            "title"=>"ikke fik et link?",
                            "block_names"=>["Payment Gateway"]
                        ],
                        [
                            "title"=>"Tal med support",
                            "block_names"=>["Support Us"]
                        ]
                    ]

                ]
            ]
        ];
           return response()->json($res);
        }
        $student = @\App\Student::where('messenger_id',$request->user_id)->first();

        $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->first();

        if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
        {
 
            return response()->json(["set_attributes"=>["user_plan_set"=>'TRUE']]);
            // return $this->fResponse('Subscription already choosed');
            // return ['status_code'=>0,'message'=>'Subscription already choosed'];
        }
        
        $response = $subscription->createAgreement($student->id,$request->selected_plan_id);

        if($response['status']){
            // if(false){
                $res = ['messages'=>[
                    [
                        'text'=>"Jeg har sendt dig et betalingslink til abonnementsplan på dit registrerede mobilnummer.",
                        "quick_replies"=>[
                            [
                                "title"=>"ikke fik et link?",
                                "block_names"=>["Payment Gateway"]
                            ],
                            [
                                "title"=>"Tal med support",
                                "block_names"=>["Support Us"]
                            ]
                        ]

                    ]
                ]
            ];
            return response()->json($res); 
        }else{

            $res = ['messages'=>[
                [
                    "text"=> "Det ser ud til, at vi ikke er i stand til at sende dig et link. Vil du prøve igen?",
                    "quick_replies"=> [
                        [
                          "title"=>"Ja",
                          "block_names"=> ["Payment Gateway"]
                        ],
                        [
                          "title"=>"Tal med support",
                          "block_names"=> ["Support Us"]
                        ]
                    ]
                ]
            ]];
            return response()->json($res); 
        }       
    }
    public function assign_school(Request $request){


        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'school_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'code'=>201,
            'message'=>'Validation Error',
            'results'=>[],
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        try{
            School::findOrFail($request->school_id);
        }catch (ModelNotFoundException $ex) {
          return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'School Not Exist',
                    'results' => [],
                ], 401); 

        }
        try{
            $school = Student::findOrFail($request->student_id);
            $school->school_id         = $request->school_id;
            $updateFlag = $school->save();
        }catch (ModelNotFoundException $ex) {
          return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Student not exist',
                    'results' => [],
                ], 401); 

        }
       
        if($updateFlag){
            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Assign School Successfully',
                    'results' => [],
                ], 200); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Failed : Please Try Again',
                    'results' => [],
                ], 401); 

        } 
    }
  
    public function generateCode($name,$mobile,$step=0){
        if($step == 0){
            // first 4 number name and last two digit mobile number
            $rcode = substr($name, 0,4).substr($mobile,-2);
        }else{
            // first 4 number name and last two+$step digit mobile number
            $rcode = substr($name, 0,4).substr($mobile,- (2+$step) );
        }

        // $rcode = rand(1000,9999);
        $count = Student::where('referral_code',$rcode)->get()->count();  
        $step++;
        if(!$count){
            return $rcode;
        }else{
            return $this->generateCode($name,$mobile,$step); // should work better
        }
    }


    public function gototest(){
        echo $this->generateCode();
    }
    public function signup($user)
    {
        // 'country_code'=>$country_code
        // $rcode = $this->generateCode();
        $student = new Student();
        // $student->referral_code = $rcode;
        $student->mobile_number = $user['mobile'];
        // $student->otp = $user['otp'];
        $student->country_code = $user['country_code'];
        $student->otp_count = 1;
        $student->IsVerify = 0;
        $user = $student->save();
        if($user){
            return true;
        }else{
            return false;
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
        $student->IsVerify = 0;
        $student->save();

        return response()->json([
            'success'   =>  true,
            'message' => 'user register',
            'code' => 200,
            'IsData'=>true,
            'results'=>$student
        ]);
    }
}