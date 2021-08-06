<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;
use App\SchoolVendorMapping;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use Validator;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    public function __construct() 
    {
        //$this->middleware(['auth','clearance']);
    }
    
    public function demo($student_id=1){
        echo "student id ".$student_id;
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
            return ['status'=>false];
        }
        curl_close ($ch);
        $result= json_decode($result,TRUE);
        
        if(array_key_exists('id',$result) || array_key_exists('handle',$result)) {
            return ['status'=>true,'session_id'=>$result['id'],'handle'=>$handle];
        }else{
            return ['status'=>false,'result'=>$result];
        }

    }
    
    public function chargeOneTime(Request $request)
    {
          
        $request['id']=$request['user_id'];
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:student',
            'handle' => 'required',
            'item_id' => 'required',
            'customer'=> 'required',
            'payment_method'=> 'required',
        ]);

        if ($validator->fails()) {
            $messenger_query_string='&chatfuel_block_name='.urlencode('Paid Order Success').'&item_payment_status=FALSE';
            try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
            catch(Exception $e) {}
    
           return ['status_code'=>0,'message'=>'Unable to create order'];
        }

        try{
            $food_item = \App\KitchenFood::where('id',$request->item_id)->firstOrFail();
            $student = \App\Student::where('id',$request->id)->firstOrFail();
        } catch (ModelNotFoundException $ex) {  

            $messenger_query_string='&chatfuel_block_name='.urlencode('Paid Order Success').'&item_payment_status=FALSE';
            try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
            catch(Exception $e) {}

          return response()->json(['status_code'=>0,'message'=>'Unable to create order']);
           
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        } 
       
       //Please apply every validation here==



        $amount=100*((int)$food_item->price);//please change as per calculation

        $charge_data['source']=$request['payment_method'];
        $charge_data['handle']=$request['handle'];
        $charge_data['amount']=$amount;
        

        // $charge_data['test']=TRUE;
        
        $payload_data=json_encode($charge_data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.reepay.com/v1/charge');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_data);
        curl_setopt($ch, CURLOPT_USERPWD, 'priv_b3510b505ef54bbd69db5ae0440b09ed' . ':' . '');

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {

            $messenger_query_string='&chatfuel_block_name='.urlencode('Paid Order Success').'&item_payment_status=FALSE';
            try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
            catch(Exception $e) {}

            return ['status_code'=>0,'message'=>'Unable to create order'];
        }
        
        curl_close($ch);
        
        $subscription_response= json_decode($result,TRUE);

       if(array_key_exists('code',$subscription_response) || array_key_exists('error',$subscription_response)) {
        $messenger_query_string='&chatfuel_block_name='.urlencode('Paid Order Success').'&item_payment_status=FALSE';
        try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
        catch(Exception $e) {}

             return ['status_code'=>0,'message'=>'Unable to create order'];
       }

       //Insert data as per you need 

            $order = \App\Order::create([
                'user_id'                 =>$request->id,
                'order_total'             =>$food_item->price,
                'payment_status'          =>'paid',
                'payment_by_subscription' =>0,
                'created_by'              =>$student->id,
                'updated_by'              =>$student->id
            ]);
            $orderDetail = \App\OrderDetail::create([
                'order_id'               =>$order->id,
                'order_item'             =>$food_item->id,
                'quantity'                =>'1',
                'price'                   =>$food_item->price,
                'created_by'              =>$student->id,
                'updated_by'              =>$student->id
            ]);

        //Adding data in order transaction

        $order_transaction['order_id']=$order['id'];
        $order_transaction['payment_type']=0;//0 for direct pay
        $order_transaction['payment_gateway']='reepay';
        $order_transaction['payment_transaction_id']=$subscription_response['handle'];

        $orderDetail = \App\OrderTransaction::create($order_transaction);
        
        $messenger_query_string='&chatfuel_block_name='.urlencode('Paid Order Success').'&item_payment_status=TRUE';
            try {  $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
            catch(Exception $e) {}


        return ['status_code'=>1,'message'=>'Subscription create'];


    }
    

     //Create a recurring session , need plan id  and return empty array in case of error
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
            return [];
        }
        curl_close ($ch);
        $result= json_decode($result,TRUE);

        return ['session_id'=>$result['id'],'handle'=>$handle];       
    }

    public function chargeSubscription(Request $request)
    {
        
        $request['id']=$request['user_id'];
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans',
            'id' => 'required|exists:student',
            'customer' => 'required',
            'payment_method' => 'required',
            'handle' => 'required',
        ]);

        if ($validator->fails()) {
           return ['status_code'=>0,'message'=>'Unable to create subscription'];
        }

        
        $subscription_existed=\App\Subscription::where('student_id',$request['user_id'])->orderBy('id','DESC')->first();

        if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
        {
            return ['status_code'=>0,'message'=>'Subscription already choosed'];
        }

        $charge_data['plan']=$request['plan_id'];
        $charge_data['payment_method']=$request['payment_method'];
        $charge_data['customer']=$request['customer'];
        $charge_data['signup_method']='email';
        $charge_data['handle']=$request['handle'];
        // $charge_data['test']=TRUE;
        
        $payload_data=json_encode($charge_data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.reepay.com/v1/subscription');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_data);
        curl_setopt($ch, CURLOPT_USERPWD, 'priv_b3510b505ef54bbd69db5ae0440b09ed' . ':' . '');

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return ['status_code'=>0,'message'=>'Unable to create subscription'];
        }
        
        curl_close($ch);

        $subscription_response= json_decode($result,TRUE);

       if(array_key_exists('code',$subscription_response))   return ['status_code'=>0,'message'=>'Unable to create subscription'];

       $plan=\App\Plan::where('plan_id',$request['plan_id'])->first();

     //handle as transaction id
        \App\Subscription::create(['plan_id'=>$request['plan_id'],'price'=>$plan->price,'payment_gateway'=>'reepay','transaction_id'=>$subscription_response['handle'],
        'next_period_start'=>$subscription_response['next_period_start'],'student_id'=>$request['user_id']]);

        // $order_transaction['order_id']=$order['id'];
        // $order_transaction['payment_type']=0;//0 for direct pay
        // $order_transaction['payment_gateway']='reepay';
        // $order_transaction['payment_transaction_id']=$subscription_response['handle'];

        // $orderDetail = \App\OrderTransaction::create($order_transaction);

        // 5
        // referred_to
        
        $referral = \App\Referral::where(['approval_status'=>2,'referred_to'=>$request['user_id']])->first();
        if($referral){
            $referral->approval_status = 1;
            $referral->save();
        }
        //insert data in user as per you need
        $user=\App\Student::where('id',$request['user_id'])->update($updateData = [
            'plan_id'=>$plan->id,
            'plan_start_date'=>date('Y-m-d', strtotime(now())),
            'plan_expiry_date'=>date('Y-m-d', strtotime($subscription_response['next_period_start'])),'current_order'=>0]);


        $messenger_query_string='&chatfuel_block_name='.urlencode('Success Payment Gateway Block').'&plan_id='.$request['plan_id'];
        try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
        catch(Exception $e) {}

      

        return ['status_code'=>1,'message'=>'Subscription create'];


        // https://api.chatfuel.com/bots/<BOT_ID>/users/<USER_ID>/send?
        // chatfuel_token=<TOKEN>&chatfuel_message_tag=<CHATFUEL_MESSAGE_TAG>&chatfuel_block_name=<BLOCK_NAME>
    }

    
    
    //store webhook payload
    public function renewWebhookCapture(Request $request)
    {
        \DB::table('webhooks')->insert(['payload'=>json_encode($request->all())]);
    }






//*****Logic for the payment integretaion**
//Get Token
//Create Agreement based upon the plan and user id
//Capture webhook


//Function to create the Agreement
//Added plan and student id in custom data of agreement
//Frequency weekly for now
//next_payment_date after 1 week 

    public function  createAgreement($student_id='97',$plan_id='5')
    {
        $myfile = fopen("create_agreement.txt", "a+") or die("Unable to open file!");
        $time = date('H:i:s',time());
        $txt = "---create_agreement ".$time."---\n";
        $student=@\App\Student::find($student_id);
        $plan=@\App\Plan::find($plan_id);
        if(!$student || !$plan){
            $txt .= "---student or plan not found --plan_id".$plan_id." , student_id".$student_id."---\n";
            fwrite($myfile, $txt);
            fclose($myfile);
            return ['status'=>false,'message'=>'student or plan not found'];
            
            // return $this->fResponse('student or plan not found');
        }

         

        if(!$student['mobile_number']){
            $txt .= "---student don,t have phone number \n";
            fwrite($myfile, $txt);
            fclose($myfile);
            return ['status'=>false,'message'=>'student don,t have phone number'];
            
            // return $this->fResponse('student don,t have phone number');
        } 

        if($student['country_code'] != 45 ){
          $txt .= "---student don,t have valid phone number \n"; 
          fwrite($myfile, $txt);
          fclose($myfile);
          return ['status'=>false,'message'=>'student don,t have valid phone number']; 
        }
            
        // if($student['country_code'] == 45)  return $this->fResponse('student don,t have phone number');

        $subscription_existed=\App\Subscription::where('student_id',$student_id)->orderBy('id','DESC')->first();

        if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
        {
            $txt .= "---Subscription already choosed \n"; 
            fwrite($myfile, $txt);
            fclose($myfile);
            return ['status'=>false,'message'=>'Subscription already choosed']; 
            
            // return $this->fResponse('Subscription already choosed');
            // return ['status_code'=>0,'message'=>'Subscription already choosed'];
        }

        // return $this->fResponse('Accept');
        $token=$this->getAccessToken();
        $payload=[];
        $payload['phone']=$student['mobile_number'];
        // $payload['phone']='27141338';
        // $payload['amount']='1';
        $payload['amount']=$plan['price'];
        $payload['frequency']=52;
        $payload['plan_name']=$plan['name'];
        $trail_days = $plan->trail_days;
        $payload['next_payment_date']=date('d.m.Y',strtotime("+".$trail_days." day"));

        //Adding subscriber data
        $payload['firstname']=$student['name'];
        $payload['lastname']=$student['last_name'];
        $payload['email']=$student['email'];

        //Custom data in agreement
        $custom_data['student_id']=$student_id;
        $custom_data['plan_id']=$plan_id;
        $payload['custom_data']=json_encode($custom_data);

        $payload=http_build_query($payload);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://mps.paygate.dk/api/agreements');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Authorization: Bearer '.$token;
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $txt .= "---curl_errno :Unable to create agreement \n";
            fwrite($myfile, $txt);
            fclose($myfile);
            return ['status'=>false,'message'=>'Unable to create agreement','result'=>$result,'payload'=>$payload]; 
             
            // return $this->fResponse('Unable to create agreement');
        }
        curl_close($ch);

        $result=json_decode($result,True);

        if(!array_key_exists('code',$result) || $result['code'] != 201 ){
            $txt .= "---code not exist :Unable to create agreement \n";
            fwrite($myfile, $txt);
            fclose($myfile); 
            return ['status'=>false,'message'=>'Unable to create agreement','result'=>$result]; 
           
            // return $this->fResponse('Unable to create agreement');
        } 
        $txt .= "---Agreement created ".$plan_id." , student_id".$student_id."---\n"; 
        fwrite($myfile, $txt);
        fclose($myfile); 
        return ['status'=>true,'message'=>'Agreement created','result'=>$result]; 

        // return $this->sResponse('Agreement created',$result);
    }

    //Need to add security cheeck acc to header
    public function capturePaygateAgreement(Request $request)
    {
        //security check pending
        \DB::table('webhooks')->insert(['payload'=>json_encode($request->all())]);

        // if($request['payment_type'] != 'subscription_payment') return 'Subsciption payment type is needed';

        // $agreement_id=$request['agreement_id'];
        
        // $agreemnent_data=$this->getAgreementData($agreement_id);
        

        // if(!array_key_exists('custom_data',$agreemnent_data) ||  !array_key_exists('plan_id',$agreemnent_data['custom_data'])  || !array_key_exists('student_id',$agreemnent_data['custom_data'])) return 'invalid  agreement data';
       
        // //Need to insert or update the subscription table as per out need

  
        // $plan_id=$agreemnent_data['custom_data']['plan_id'];
        // $student_id=$agreemnent_data['custom_data']['student_id'];
        // $price=$request['amount'];

        // //Subscription updated
        // \App\Subscription::create(['plan_id'=>$plan_id,'price'=>$price,'payment_gateway'=>'paygate','transaction_id'=>$request['payment_id'],
        // 'next_period_start'=>$request['next_payment_date'],'student_id'=>$student_id,'agreement_id'=>$request['agreement_id']]);

        // //Student updation
        // $user=\App\Student::where('id',$request['user_id'])->update(['plan_start_date'=>date('Y-m-d', strtotime(now())),
        // 'plan_expiry_date'=>$request['next_payment_date'],'current_order'=>0]);

        // //Calling chat fuel Api

   
        // $messenger_query_string='&chatfuel_block_name='.urlencode('Success Payment Gateway Block').'&plan_id='.$plan_id;
        // try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
        // catch(Exception $e) {}
        return ['status_code'=>1,'message'=>'Subscription create'];
    }
    // type = agreement_accept
    // status = Created/Cancele/Pending/Expired/Accepted
    public function captureAgreementAccept(Request $request)
    {
        // security check pending
        \DB::table('webhooks')->insert(['status'=>$request['status'],'type'=>'agreement_accept','payload'=>json_encode($request->all())]);
        if($request['status'] == 'Canceled'){
            // $aagreemen_id = $request['agreement_id'];
            $aagreemen_id = $request['id'];
            $this->doCancelAgreement($request['id']);
            return 'Subsciption Canceled';
        }

        if($request['status'] != 'Accepted') return 'Subsciption payment not accept';
        //Need to insert or update the subscription table as per out need
        $plan_id=$request['custom_data']['plan_id'];
        $student_id=$request['custom_data']['student_id'];
        // $plan_id= $request['plan_id'];
        // $student_id=$request['student_id'];

        $price=$request['amount'];
        $student=\App\Student::where('id',$student_id)->first();

        //Subscription updated
        // \App\Subscription::create(['plan_id'=>$plan_id,'price'=>$price,'payment_gateway'=>'paygate','transaction_id'=>0,
        // 'next_period_start'=>$request['next_payment_date'],'student_id'=>$student_id,'agreement_id'=>$request['id']]);
        $installment = 0;
        $subscription_existed = \App\Subscription::where(['plan_id'=>$plan_id,'student_id'=>$student_id])->first();
        if($subscription_existed){
            $installment = ($subscription_existed->installment+1);
        }
         $user = \App\Subscription::updateOrCreate([
                    'plan_id'       =>$plan_id,
                    'student_id'    =>$student_id
                    ],[
                        'price'             => $price,
                        'payment_gateway'   => 'paygate',
                        'transaction_id'    => 0,
                        'next_period_start' => $request['next_payment_date'],
                        'student_id'        => $student_id,
                        'agreement_id'      => $request['id'],
                        'installment'       => $installment
                    ]);

        //Student updation

        $user=\App\Student::where('id',$student_id)->update([
            'plan_start_date'=>date('Y-m-d', strtotime(now())),
        'plan_expiry_date'=>$request['next_payment_date'],
        'current_order'=>0,'plan_id'=>$plan_id]);

        //Calling chat fuel Api

   
        $messenger_query_string='&chatfuel_block_name='.urlencode('Success Payment Gateway Block').'&plan_id='.$plan_id;
        // $user
        try { 
            // $this->sendMessageOnChatbot($student->user_id,$messenger_query_string);
            // $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);
            if($student->messenger_id){
                $this->sendMessageOnChatbot($student->id,$messenger_query_string);
            }
        }
        catch(Exception $e) {}
        return ['status_code'=>1,'message'=>'Subscription create'];
    }
    // type = agreement_create
    // // status = Rejected/Scheduled/Created
    // this webhook call when payment deduced
    public function capturePaygatePaymentCreate(Request $request)
    {
        // security check pending
        \DB::table('webhooks')->insert(['status'=>$request['status'],'type'=>'agreement_create','payload'=>json_encode($request->all())]);

        if($request['payment_type'] != 'subscription_payment') return 'Subsciption payment type is needed';

        $agreement_id=$request['agreement_id'];
        $agreemnent_data=$this->getAgreementData($agreement_id);
        if(!array_key_exists('custom_data',$agreemnent_data) ||  !array_key_exists('plan_id',$agreemnent_data['custom_data'])  || !array_key_exists('student_id',$agreemnent_data['custom_data'])) return 'invalid  agreement data';
       
        //Need to insert or update the subscription table as per out need

  
        $plan_id=$agreemnent_data['custom_data']['plan_id'];
        $student_id=$agreemnent_data['custom_data']['student_id'];
        $price=$request['response']['amount'];
        $student=\App\Student::where('id',$student_id)->first();


        //Subscription updated
        $installment = 0;
        $subscription_existed = \App\Subscription::where(['plan_id'=>$plan_id,'student_id'=>$student_id])->first();
        if($subscription_existed){
            $installment = ($subscription_existed->installment+1);
        }
        \App\Subscription::where(['plan_id'=>$plan_id,'studetn_id'=>$student_id])->update([
        'next_period_start'=>$request['next_payment_date'],
        'transaction_id'=>$request['response']['payment_id'],
        'installment'=>$installment,'subscription_status'=>$request['status']]);



        // \App\Subscription::create(['plan_id'=>$plan_id,'price'=>$price,'payment_gateway'=>'paygate','transaction_id'=>$request['payment_id'],
        //'next_period_start'=>$request['next_payment_date'],'student_id'=>$student_id,'agreement_id'=>$request['agreement_id']]);

        //Student updation
        $user=\App\Student::where('id',$student_id)->update(['plan_start_date'=>date('Y-m-d', strtotime(now())),
        'plan_expiry_date'=>$request['next_payment_date'],'current_order'=>0]);

        //Calling chat fuel Api

        $referral = \App\Referral::where(['approval_status'=>2,'referred_to'=>$student->id])->first();
        if($referral){
            $referral->approval_status = 1;
            $referral->save();
        }

        $messenger_query_string='&chatfuel_block_name='.urlencode('Success Payment Gateway Block').'&plan_id='.$plan_id;
        try { 
            if($student->messenger_id){
                $this->sendMessageOnChatbot($student->id,$messenger_query_string);
            }
        }
        catch(Exception $e) {}
        return ['status_code'=>1,'message'=>'Subscription create'];
    }


    //Get aggrement data acc to id agreement_id=14335
    public function getAgreementData($agreement_id=14335)
    {
        $token=$this->getAccessToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://mps.paygate.dk/api/agreements/'.$agreement_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
       
        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Authorization: Bearer '.$token;
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [];
        }
        curl_close($ch);

        $result=json_decode($result,True);

        if(array_key_exists('error',$result)) return [];

        return $result;
    }

    //Get aggrement data acc to id agreement_id=14335
    public function cancelAgreementData($agreement_id=14813)
    {
        $myfile = fopen("create_agreement.txt", "a+") or die("Unable to open file!");
        $time = date('H:i:s',time());
        $txt = "---cancelAgreementData ".$time."---\n";
        // return ['status'=>'agreement cancel','agreement_id'=>$agreement_id];
        $token=$this->getAccessToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://mps.paygate.dk/api/agreements/'.$agreement_id.'/cancel');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Authorization: Bearer '.$token;
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        // return $result;
        if (curl_errno($ch)) {
            $txt .= "-Unable to cancel agreement ".json_encode($result)."\n";
            fwrite($myfile, $txt);
            fclose($myfile);
            return ['status'=>false];
        }
        curl_close($ch);
        $result=json_decode($result,True);
        if(!array_key_exists('code',$result) || $result['code'] != 204 ){
            $txt .= "-Unable to cancel agreement ".json_encode($result)."\n";
            fwrite($myfile, $txt);
            fclose($myfile); 
            return ['status'=>false,'message'=>'Unable to cancel agreement','result'=>$result]; 
           
            // return $this->fResponse('Unable to create agreement');
        }
        $txt .= "- canceled agreement: agreement_id= ".$agreement_id."\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return ['status'=>true,'message'=>'agreement cancel','result'=>$result]; 
    }
    // cancel payget Agreement and strip subacription
    public function doCancelAgreement($agreement_id){
        $aagreemen_id = $agreement_id;
        $flag = false;
        $subscription_existed=\App\Subscription::where(['agreement_id'=>$aagreemen_id])->first();
        if($subscription_existed){
            // $totalSubscribtion++;
            $student=\App\Student::where(['id'=>$subscription_existed->student_id])->first();
            if($student){
                $student->plan_start_date = null;
                $student->plan_expiry_date = null;
                // $student->current_order = 0;
                $student->plan_id = null;
                $student->save();
            }
            // $subscription_existed->next_period_start = '';
            $subscription_existed->subscription_status = 'Canceled';
            // $subscription_existed->deleted_at = date('Y-m-d H:i:s');
            $updateFlag = $subscription_existed->save();
            if($updateFlag){
                $flag = true;
            }else{
                $flag = false;
            }
        }
        return ['status'=>$flag];
    }

    //paygate authcode
    public function authPaygate()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://mps.paygate.dk/api/auth');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=password&client_id=2&client_secret=BSKDjFC0zGqCx5wxmYAjkbMW4HWqMVbHURMtoLMl&username=pm%40mealticket.dk&password=mealticket1234");

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;

        if(!array_key_exists('access_token',$result)) return 'unauthorized';

        return $result;
    }
  
    public function sendMessageOnChatbot($user_id,$query_string)
    {
        $messenger_id=\App\Student::where('id',$user_id)->first()->messenger_id;
        
        // $block_name = urlencode("Success Payment Gateway Block");
        $bot_id='5f1c0ea4038a195563726ac7';
        $chatfuel_token='mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
        $tag='POST_PURCHASE_UPDATE';
        // $plan_id='1';


        // $url="https://api.chatfuel.com/bots/".$bot_id."/users/".$messenger_id."/send?chatfuel_token=".$chatfuel_token."&chatfuel_message_tag=".$tag."&chatfuel_block_name=".$block_name.'&plan_id='.$plan_id;

        $url="https://api.chatfuel.com/bots/".$bot_id."/users/".$messenger_id."/send?chatfuel_token=".$chatfuel_token."&chatfuel_message_tag=".$tag.$query_string;


        $payload_data=json_encode([]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_data);
        // curl_setopt($ch, CURLOPT_USERPWD, 'priv_b3510b505ef54bbd69db5ae0440b09ed' . ':' . '');

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_errno($ch);
            return "error while calling";
        }
        
        curl_close($ch);

        return json_decode($result,TRUE);
    }




    //Hardcode for now
    public function getAccessToken()
    {
        return "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImNlNDdhODEwNzNhYTQwNGVkZWY1N2MxNzQwODhiYzAwMzM2ZGNjNzEzMGQxNDI0YTJlYjM2MjMyMzQyNGMyZmQ0ZThlNzUyNTQwMTYxNmE5In0.eyJhdWQiOiIyIiwianRpIjoiY2U0N2E4MTA3M2FhNDA0ZWRlZjU3YzE3NDA4OGJjMDAzMzZkY2M3MTMwZDE0MjRhMmViMzYyMzIzNDI0YzJmZDRlOGU3NTI1NDAxNjE2YTkiLCJpYXQiOjE1OTY1NTg3OTEsIm5iZiI6MTU5NjU1ODc5MSwiZXhwIjoxNjI4MDk0NzkxLCJzdWIiOiIxNjAiLCJzY29wZXMiOltdfQ.RDNu8bNn8lSW6mj7cgFonW41f5IxIJ4XTQwWKFJlB1UahsWX4y5SZh2S2c1SVgg5E4RZ3pRxOCg2ps217RKxMSa-ozZL0BWzRv9zAjgvD6Sr1wuwt_pvqLdMYrhQZ_u927TOWiWRpUd3W5WYkPyqdhnw_GJ9Oa42Nen8Zea4M4_lrM7W7rwix_t7DSE4swISfUHDuV1HoPe4rN4HocrUe_t7EL61rIo6BInVIYaDCBt5CJ4WuTog6H4Axp4nVDei40Q1JYZSAID_TXG0f_TG3jMuHQ6yioDNol3u14aAfhMxyk-4MjTUIrPvpJ9BVSa2F1IduUlbVR0mLR0ixXsWT7pIeCvgTjm4yakthu3drDjO6xCCpD5IlCQPUrydtnJgR4yCUNBwU3dqltWQ4AiTMCke3JzFgfZ-MAs7bM3pLqJru0B885dVjnAEVR4OF_a6cqAcQxd1UUIPew6OWkOhOuuo9aGnj6h39FQXw0F67qYAq4lk23JzrcWoF6yOBotH9dnT-gua4KiEXjfYzIrqe1CLniZTlWnD5lrxceQDeIV4jGsvhGcTAdEkPpOsu__p6B6WomXgPqeFa0hB72xOEAnbInHf_TpzApBQ96QDRwgNEhj48Ww4hmYKc1AAwwOEosAZquU89uPnquwb6vowPaSgJcqhkbBcOG4nzVEwovw";
    }

    public function getNewToken()
    {
        //
        $this->getTokenFromRefreshToken();
    }

    public function fResponse($message,$payload=[])
    {
        $data=[];
        $data['status_code']=0;
        $data['status_text']='failed';
        $data['message']=$message;
        $data['data']=$payload;
        return $data;
    }


    public function sResponse($message,$payload=[])
    {
        $data=[];
        $data['status_code']=1;
        $data['status_text']='success';
        $data['message']=$message;
        $data['data']=$payload;
        return $data;
    }

    public function getPaymentDetails(){
        
        
        $start='';
     //   $category = \App\Category::with(['category_name'])->orderBy('id','DESC');
      //  dd($_GET);
        $paymentDetail = \App\Subscription::with(['getStore'])->orderBy('id','DESC');;
            $planList=getPlan();
            $temdata=array();
            if($planList->items)
            {
                 foreach ($planList->items as $key => $value) 
                 {
                   $temdata[$key]['id']=$value->id;
                   $temdata[$key]['period']=$value->period;
                   $temdata[$key]['interval']=$value->interval;
                   $temdata[$key]['name']=$value->item->name;
                   $temdata[$key]['amount']=$value->item->amount/100;
                   $temdata[$key]['description']=$value->item->description;
                   $temdata[$key]['currency']=$value->item->currency;
                }
            }
       
        if(isset($_GET['store']))
        {
          if($_GET['store']!='' && $_GET['store']!='all')
          {
           $paymentDetail->where('store_id','LIKE','%'.$_GET['store'].'%');
          }
           
        }
        
        if(isset($_GET['plan']))
        {
          if($_GET['plan']!='')
          {
           $paymentDetail->where('plan_id',$_GET['plan']);
          }
        }

        if(isset($_GET['date_filter']))
        {
          if($_GET['date_filter']!='')
          { //return $_GET['date_filter'];
			 $date_filter =explode('-', $_GET['date_filter']);
             $from_date=date('Y-m-d',strtotime(trim($date_filter[0])));
             $to_date=date('Y-m-d',strtotime(trim($date_filter[1])));
             $paymentDetail->whereBetween('created_at', [$from_date, $to_date]);
			 
          }
        } 

        if(isset($_GET['expirey_date']))
        {
          if($_GET['expirey_date']!='')
          {
           // $e_date = strtotime($_GET['expirey_date']);
            $paymentDetail->whereDate('expiry_date','=',$_GET['expirey_date']);
          }
        } 
       
        
        $paymentDetails= $paymentDetail->paginate(20);
       // dd($temdata);
        $stores = \App\Store::where(['IsActive'=>1])->get();
        $stores = \App\Store::where(['IsActive'=>1])->get();
        $pagetitle='Subscription Details';
        return view('subscription.index',compact('pagetitle','paymentDetails','stores','temdata'));
    }

   
   public function cancelSubscription(Request $request)
   {
      
         $stores = \App\Store::where(['id'=>$request->id])->first();
         $subscription = \App\Subscription::where(['store_id'=>$stores->user_id,'status'=>1])->first();
         $result=json_decode(cancelSubscriptions($subscription->subscription_id));
          \App\Subscription::where('id',$subscription->id)->update(['status'=>0]);
          \App\Store::where('id',$request->id)->update(['plan_id'=>'']);
        //   return response()->json([
        //                     'success'   =>  true,
        //                     'messageId'   =>  200,
        //                     'message' => $result, 
        //                 ]);
   }


}
