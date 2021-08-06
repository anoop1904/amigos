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

class CommanController extends Controller
{
    public function __construct() 
    {
        //$this->middleware(['auth','clearance']);
    }
    public function placeOrder($userId,$menu_item_id,$order_type,$payment_type='plan_payment'){    
        try{
            $student = \App\Student::with(['device_detail','plan_name','school_detail'])->where('id',$userId)->firstOrFail();
            $message = 'Your Order has been Placed';
            

            // return response()->json(['message'=>'plan not set']);
            $food_item = \App\KitchenFood::where('id',$menu_item_id)->firstOrFail();
            $subscription_id = 0;
            if($payment_type=='plan_payment'){
                $orderCount = \App\Order::whereDay('created_at', now()->day)->where('user_id',$student->id)->get()->count();
                if($orderCount){
                    return response()->json(['status'=>false,'messageId'=>201,'message'=>'only one order allow in a day.']);
                }
                $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->firstOrFail();
                $subscription_id = $subscription_existed->id;
                if((int)$student->current_order >= (int)$student->plan_name->max_meals_per_week){
                    $response = array(
                        'status' => false,
                        'messageId' => 201,
                        'message' => 'Meals order quota expired in this week',
                    );
                    return response()->json($response);
                }
                if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) < date('Y-m-d', strtotime(now())) ){
                    $response = array(
                        'status' => false,
                        'messageId' => 201,
                        'message' => 'Plan expire',
                    );
                    return response()->json($response);
                }
            }

            $order = \App\Order::create([
                'user_id'                 =>$student->id,
                'order_total'             =>$food_item->price,
                'payment_status'          =>'paid',
                'payment_by_subscription' =>$subscription_id,
                'created_by'              =>$student->id,
                'updated_by'              =>$student->id,
                'school_id'              =>$student->school_detail->id,
                'vendor_id'              =>$food_item->vendorId,
                'order_type'              =>'mobile'
            ]);

            $orderDetail = \App\OrderDetail::create([
                'order_id'               =>$order->id,
                'order_item'             =>$food_item->id,
                'quantity'                =>'1',
                'price'                   =>$food_item->price,
                'created_by'              =>$student->id,
                'updated_by'              =>$student->id
            ]);

            if($orderDetail){
                if($payment_type=='plan_payment'){
                    $student->current_order = $student->current_order+1;
                    $student->save();
                }

                sendNotification($student->id,$message);
                 $response = [
                    'status'=>true,
                    'messageId'=>200,
                    'message'=>'Order Placed'
                ];
                return response()->json($response);
            }else{
                $message ="Your order failed";
                sendNotification($student->id,$message,0);
                $response = [
                    'status'=>'false',
                    'messageId'=>203,
                    'message'=>'Order Placement Failed'
                ];

                return response()->json($response);
                // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"db error"]]);
            }
        } catch (ModelNotFoundException $ex) {  
                 $response = [
                'status'=>false,
                'messageId'=>203,
                'message'=>'Order Placement Failed'
            ]; 
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
        $count = \App\Student::where('referral_code',$rcode)->get()->count();  
        $step++;
        if(!$count){
            return $rcode;
        }else{
            return $this->generateCode($name,$mobile,$step); // should work better
        }
    }

    public function validateNumber($number){
        $number = str_replace(' ', '', $number);
        $ext = substr($number, 0, 1);
        $country_code = substr($number, 0, 3);
        $number = str_replace('+', '', $number);
        // $n = config('constants.NUMBER_LENGTH');
        // echo substr($number, 0, 1);
        $number_length = 10;
        $code = 91;
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
            $number_length = 10;
            $code = 45;
        }
        if(strlen($number) >= 8){
            $start = strlen($number) - $number_length; 
            $mobile_number = substr($number, $start);
            return ['status'=>true,'number'=>$mobile_number,'country_code'=>$code];
        }else{
            return ['status'=>false];
        }
    }

   
}
