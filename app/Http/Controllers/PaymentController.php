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

class PaymentController extends Controller
{
    public function __construct() 
    {
        //$this->middleware(['auth','clearance']);
    }
    
    public function pay_subscription(){
        if(!isset($_GET['plan_id']) && !isset($_GET['user_id']))
        abort(404);
        $user_id = decrypt($_GET['user_id']);
        $plan_id = decrypt($_GET['plan_id']);

        // echo "plan_id ".$plan_id;
        // echo "student_id ".$user_id;
        $plan = \App\Plan::where('id',$plan_id)->first();
        $student = \App\Student::where('id',$user_id)->first();
        // dd($student);
        // die;
        $Publishable_KEY = config('constants.Publishable_KEY');
        if($plan && $student){
            if(!$plan->plan_id){
                abort(404);
            }
            return view('payment.subscription_strip_webview',compact('Publishable_KEY','student','plan','user_id','plan_id'));
        
        }
        abort(404);
    }

    public function pay_onetime(){
        if(!isset($_GET['item_id']) && !isset($_GET['user_id']))
        abort(404);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $user_id = decrypt($_GET['user_id']);
        $item_id = decrypt($_GET['item_id']);
        $items = \App\KitchenFood::where('id',$item_id)->first();
        $student = \App\Student::where('id',$user_id)->first();
        $Publishable_KEY = config('constants.Publishable_KEY');
        if($items && $student){
            return view('payment.ontime_strip_webview',compact('Publishable_KEY','student','items','user_id','item_id'));
        }
        abort(404);
    }

    public function create_payment_intent(Request $request){
            $pub_key = config('constants.STRIPE_KEY');
            \Stripe\Stripe::setApiKey($pub_key);
            $body = $request->all();

            $user_id = $body['user_id'];
            $item_id = $body['item_id'];
    
            $items = \App\KitchenFood::where('id',$item_id)->first();
            $student = \App\Student::where('id',$user_id)->first();
            if(!$student->customerId){
                // create new registration
                $this->createUser($student->id);
                $student = \App\Student::where('id',$user_id)->first();
                $customerId = $student->customerId;
            }
            $customerId = $student->customerId;

            // Create a PaymentIntent with the order amount and currency and the customer id
            $payment_intent = \Stripe\PaymentIntent::create([
                "amount" => (int)$items->price*100,
                "currency" => $body['currency'],
                "customer" => $customerId
            ]);
            // dd($payment_intent);
            // Send publishable key and PaymentIntent details to client
            // return $response->withJson(array());
            return response()->json( ['publicKey' => $pub_key, 'clientSecret' => $payment_intent->client_secret, 'id' => $payment_intent->id]);
    }

    public function update_customer($student_id=94,$email){
        try{
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $student = \App\Student::where('id',$student_id)->first();
            if($student && !$student->customerId){

            }
            $customer = $stripe->customers->update($student->customerId,[
                'email' => $email,
            ]);
            return ['status'=>true,'customer' => $customer];
        }catch (ModelNotFoundException $ex) {  
                 $response = [
                'status'=>false,
                'messageId'=>203,
                'message'=>'Customer update Failed'
            ];
        }

        
    }
    
    public function place_order(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                    'success' => false,
                    'messageId' => 201,
                    'message' => 'Something Went Wrong!',
                );
            return response()->json($response);  
        }
        if(isset($request['payment_method']) && $request['payment_method']){
            $student = \App\Student::where('id',$request['user_id'])->first();
            if(!$student->paymentMethodId){
                $student->paymentMethodId = $request['payment_method'];
                $student->save();
            }
        }

        // $auth = new AuthController; 
        $comman = new CommanController();
        $response = $comman->placeOrder($request['user_id'],$request['item_id'],'mobile','one_time');
        return $response;
        // if($response['status']){
        //     return response()->json($response);  
        // }else{
        //     return response()->json($response);
        // }
    }

    public function create_subscription(Request $request){
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
            'user_id' => 'required',
            'paymentMethodId' => 'required',
            'priceId' => 'required',
        ]);

        if ($validator->fails()) {
           return ['status'=>false,'message'=>'Unable to create subscription'];
        }

        $subscription_existed=\App\Subscription::where('student_id',$request['user_id'])->orderBy('id','DESC')->first();

        if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
        {
            // return ['status'=>false,'message'=>'Subscription already choosed'];
            return response()->json( ['status'=>false,'message'=>'Subscription already choosed']);
        }


        $body = $request->all();
        $plan = \App\Plan::where('id',$request['plan_id'])->first();
        $student = \App\Student::where('id',$request['user_id'])->first();
        $customerId = $body['customerId'];
        // dd($student);
        if(!$student->customerId){
            // create new registration
            $this->createUser($student->id);
            $student = \App\Student::where('id',$request['user_id'])->first();
        }

        if(!$student->paymentMethodId){
            $student->paymentMethodId = $body['paymentMethodId'];
            $student->save();
        }
        $customerId = $student->customerId;
        try {
        $payment_method = $stripe->paymentMethods->retrieve(
            $body['paymentMethodId']
        );
        $payment_method->attach([
        'customer' => $customerId,
        ]);
        } catch (Exception $e) {
            return response()->json( ['status'=>false,'message'=>'Subscription Failed']);
        }


        // Set the default payment method on the customer
        $stripe->customers->update($customerId, [
            'invoice_settings' => [
            'default_payment_method' => $body['paymentMethodId']
            ]
        ]);
        $trail_days = $plan->trail_days;
        // Create the subscription


        if($trail_days && $trail_days != 0){
            $feilds['trial_end'] = strtotime( date('Y-m-d',strtotime("+".$trail_days." day") ));
        }
        $feilds['expand'] = ['latest_invoice.payment_intent'];
        $subscription = $stripe->subscriptions->create([
            'customer' => $customerId,
            'items' => [
                [
                'price' => $body['priceId'],
                ],
            ],
            $feilds
        ]);
        if($subscription){
                    $user = \App\Subscription::updateOrCreate([
                        'plan_id'       =>$request['plan_id'],
                        'student_id'    =>$request['user_id']
                        ],[
                            'price'             => $plan->price,
                            'payment_gateway'   => 'stripe',
                            'transaction_id'    => $subscription['id'],
                            'next_period_start' => date('Y-m-d',$subscription['current_period_end']),
                            'agreement_id'      => $subscription['id'],
                            'installment'       => 1,
                            'json'=>json_encode($subscription)
                        ]);

        $referral = \App\Referral::where(['approval_status'=>2,'referred_to'=>$request['user_id']])->first();
        if($referral){
            $referral->approval_status = 1;
            $referral->save();
        }

        //insert data in user as per you need
        $user=\App\Student::where('id',$request['user_id'])->update($updateData = [
            'plan_id'=>$request['plan_id'],
            'plan_start_date'=>date('Y-m-d', strtotime(now())),
            'plan_expiry_date'=>date('Y-m-d', $subscription['current_period_end']),'current_order'=>0]);


        // $messenger_query_string='&chatfuel_block_name='.urlencode('Success Payment Gateway Block').'&plan_id='.$request['plan_id'];
        // try { $this->sendMessageOnChatbot($request['user_id'],$messenger_query_string);}
        // catch(Exception $e) {}
            // return ['status'=>true,'subscription'=>$subscription];
            return response()->json( ['status'=>true,'message'=>'subscription created','subscription'=>$subscription]);
        }else{
            // return ['status'=>false,'subscription'=>$subscription];
            return response()->json( ['status'=>false,'message'=>'unable to create subscription','subscription'=>$subscription]);
        }
    }

    public function createUser($student_id=94){
        $student = \App\Student::where('id',$student_id)->first();
        if($student && !$student->customerId){
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            if($student->email){
                $session_data['email'] = $student->email;
            }
            if($student->name){
                $session_data['name'] = $student->name.' '.$student->last_name;
            }
            $session_data['phone'] = $student->mobile_number;
            $customer = $stripe->customers->create($session_data); 
            $student->customerId = $customer->id;
            $student->save();
            return ['status'=>true,'customer' => $customer];
        }else{
            return ['status'=>false,'messsage'=>'user already created'];
        }        
    }
    
    public function capture_webhook_strip(Request $request)
    {
        \DB::table('webhooks')->insert(['status'=>'','type'=>$request->type,'payload'=>json_encode($request->all())]);
        if($request->type == 'invoice.paid'){
            // \DB::table('webhooks')->insert(['status'=>$request['data']['object']['lines']['data'][0]['period']['end'],'type'=>$request->type,'payload'=>json_encode($request->all())]);
            $plan_period = date('Y-m-d', $request['data']['object']['lines']['data'][0]['period']['end']);
            $subscription = $request['data']['object']['lines']['data'][0]['subscription'];
            $customer_id  = $request['data']['object']['customer'];
            $student = \App\Student::where('customerId',$customer_id)->first();
            if($student){
                \App\Subscription::where(['student_id'=>$student->id,'plan_id'=>$student->plan_id])->update(['next_period_start'=>$plan_period]);
            }
            $subscription = $request['data']['object']['subscription'];
        }
        if($request->type == 'customer.subscription.deleted' || $request->type == 'subscription_schedule.canceled'){
            $customer_id  = $request['data']['object']['customer'];
            // $subscription = $request['data']['object']['subscription'];
            $student = \App\Student::where('customerId',$customer_id)->first();
            if($student){
                $sid=  \App\Subscription::where(['student_id'=>$student->id])->orderBy('id','DESC')->first();
                $sub = new SubscriptionController();
                $sub->doCancelAgreement($sid->agreement_id);
                return ['status'=>'true'];
            }
        }
    }
    
    public function saveCardPayment($student_id=61,$item_id=6){
        try{
            $item = \App\KitchenFood::where('id',$item_id)->first();
            $student = \App\Student::where('id',$student_id)->first();
            $pub_key = config('constants.STRIPE_KEY');
            \Stripe\Stripe::setApiKey($pub_key);
         
            // List the Customer's PaymentMethods to pick one to pay with
            $payment_methods = \Stripe\PaymentMethod::all([
            'customer' => $student->customerId,
            'type' => 'card'
            ]);

            // Create a PaymentIntent with the order amount, currency, and saved payment method ID
            // If authentication is required or the card is declined, Stripe
            // will throw an error
            $payment_intent = \Stripe\PaymentIntent::create([
                'amount' => (int)$item->price*100,
                'currency' => 'dkk',
                'payment_method' => $payment_methods->data[0]->id,
                'customer' => $student->customerId,
                'confirm' => true,
                'off_session' => true
            ]);
            if($payment_intent['status']==='succeeded'){
                // $auth = new AuthController; 
                // $response = $auth->placeOrder($student_id,$item_id,'mobile','one_time');
                // return $response;
                return ['status'=>true];
            }else{
                return ['status'=>true];
            }
            
            // Send public key and PaymentIntent details to client
            return response()->json(['succeeded' => true, 'publicKey' => $pub_key, 'clientSecret' => $payment_intent->client_secret]);
        }catch (ModelNotFoundException $ex) {  
                 $response = [
                'status'=>false,
                'messageId'=>203,
                'message'=>'Order Placement Failed'
            ];
        }
    }

    public function saveCard($user_id=65){

        if(!isset($_GET['user_id']))
        abort(404);

        $user_id = decrypt($_GET['user_id']);
        // dd($user_id);
        $student = \App\Student::where('id',$user_id)->first();
        $Publishable_KEY = config('constants.Publishable_KEY');

        if($student){
            return view('payment.save_cart_strip',compact('student','Publishable_KEY','user_id'));
        }
        abort(404);
    }


    public function saveCardData(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'payment_method_id' => 'required',
            ]);

            if ($validator->fails()) {
                return ['status'=>false,'message'=>'Unable to create subscription'];
            }

            $student = \App\Student::where('id',$request['user_id'])->first();

            $pub_key = config('constants.STRIPE_KEY');
            \Stripe\Stripe::setApiKey($pub_key);

            if(!$student->customerId){
                // create new registration
                $this->createUser($student->id);
                $student = \App\Student::where('id',$user_id)->first();
                $customerId = $student->customerId;
            }
            $customerId = $student->customerId;

            $payment_method = \Stripe\PaymentMethod::retrieve($request['payment_method_id']);
            $payment_data = $payment_method->attach(['customer' => $customerId]);
            return $payment_data;
         
            if($payment_data['status']==='succeeded'){
                return ['status'=>true,'code'=>200,'message'=>'Card Save Successfully'];
            }else{
                return ['status'=>false,'code'=>201,'message'=>'Card Save failed'];
            }
            
            // Send public key and PaymentIntent details to client
            // return response()->json(['succeeded' => true, 'publicKey' => $pub_key, 'clientSecret' => $payment_intent->client_secret]);
        }catch (ModelNotFoundException $ex) {  
               return ['status'=>false,'code'=>500,'message'=>'Card Save failed'];
        }
    }

    public function cartList($student_id = 65){

        $student = \App\Student::where('id',$student_id)->first();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        // $list = $stripe->customers->allSources(
        // $student->customerId,
        // ['object' => 'card', 'limit' => 3]
        // );

        $list = $stripe->paymentMethods->all([
            'customer' => $student->customerId,
            'type' => 'card',
        ]);
        return $list;
    }
    public function cancelSubscription($student_id = 98){
        try{
            $student = \App\Student::where('id',$student_id)->first();
            if(!$student->customerId){
                return response()->json( ['status'=>false,'message'=>'User not found']);
            }
            $subscription_exist = \App\Subscription::where('student_id',$student_id)->orderBy('id','DESC')->first();
            if($subscription_exist){
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                $sid = $subscription_exist->transaction_id;
                $sub = new SubscriptionController();
                $sub->doCancelAgreement($sid);
                $subscription = $stripe->subscriptions->retrieve($sid);
                $flag = $subscription->delete();
                return response()->json(['status'=>true,'message'=>'subscription cancel','flag'=>$flag]);
                // return $flag;    
            }else{
                return response()->json( ['status'=>false,'message'=>'unable to cancel subscription']);
            }
        } catch (Exception $e) {
            return response()->json( ['status'=>false,'message'=>'Subscription Failed']);
        }
        
    }
}
