<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Referral;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
include('send_notification.php');

class LoginController extends Controller
{
    public function __construct() 
    {
        //$this->middleware(['auth','clearance']);
    }
    
    
   public function send_opt(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'mobile_number'=>'required|integer|unique:student',
            'country'=>'required'
        ]);

        $number =$request->mobile_number;
        $n = config('constants.NUMBER_LENGTH');
        //$number =  substr($number,$n);  


        $country_code =$request->country;
        //$country_code = config('constants.COUNTRY_CODE');



        $otp = rand(1,10000);

        $rcode = rand(10,1000000);
        $student = new Student();
        $student->referral_code = $rcode;
        $student->mobile_number = $number;
        $student->country_code = $country_code;
        $student->otp = $otp;
        $student->otp_count = 1;
        $user = $student->save();

           if($request->referral_code){
            $referral_student = Student::where(['referral_code'=>$request->referral_code])->first();
            if($referral_student){
                if($referral_student->ambassador){
                    $referred_by_credit = config('constants.referred_by_ambassador_credit');
                }else{
                    $referred_by_credit = config('constants.referred_by_credit');
                }
                $user = Referral::updateOrCreate([
                  'referred_by'             => $referral_student->id,
                  'referred_to'             => $student->id,
                ],['referred_by_credit'     => $referred_by_credit,
                  'referred_to_credit'      => config('constants.referred_to_credit')]);
                Student::where('referral_code',$request->referral_code)->update(['referral_code_count'=>($referral_student->referral_code_count+1)]);
                // $response = array(['status'=>"TRUE"]);
            }
        }
        
        $id = base64_encode($student->id);
        $message = 'Your OTP is : '.$otp; 
        $recipients = $country_code.$number;
        $postData = [
            "To" => "+" . $recipients,
            "Body" => $message,
        ];
        $messageFlag = $this->Send_Otp_Twillio($postData, 2000, false, false);

          $notification = array(
                  'message' => 'Registration Successfull. Please Verify OTP.',
                  'alert-type' => 'success'
                  );
        
        return view('frontend.auth.verify',compact('id'))->with($notification);
    }

     public function test()
    {

        

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, 'https://checkout-api.reepay.com/v1/session/recurring');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_data);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_USERPWD, 'priv_b3510b505ef54bbd69db5ae0440b09ed' . ':' . '');

        // $headers = array();
        // $headers[] = 'Content-Type: application/json';
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $result = curl_exec($ch);
        // if (curl_errno($ch)) {
        //     return [];
        // }
        // curl_close ($ch);
        // $result= json_decode($result,TRUE);

        // return ['session_id'=>$result['id'],'handle'=>$handle];




        $otp = rand(1000,9999);
        $notification_for_user = 'sa';
        $message = 'Test Message rom Abhishek.';
        $notification_type = 'message';
       $fcm =  sendPushNotificationToFCMSever($notification_for_user,$message,$notification_type);
        
        return $fcm;
        $userId = 1;
         $referred_map = Referral::where('referred_by',$userId)->sum('referred_by_credit');


       // $student = Student::
       //                join('school_info','school_info.id','=','student.school_id')
       //                ->leftjoin('device_detail','device_detail.student_id','=','student.id')
       //               // ->leftjoin('referred_map','referred_map.student_id','=','student.id')
       //                ->select('student.*','school_info.name as school_name','device_detail.device_type', 'device_detail.device_token')
       //                ->where('student.id',$userId)->first();

       //  $json = [];
       //     $bus = array(
       //          'id'                 => $student->id,
       //          'user_code'             => $student->user_code,
       //          'referral_code'          => $student->referral_code,
       //          'school_id'          => $student->school_id,
       //          'name'          => $student->name,
       //          'last_name'          => $student->last_name,
       //          'password'          => $student->password,
       //          'profile_pic'          => $student->profile_pic,
       //          'mobile_number'          => $student->mobile_number,
       //          'email'          => $student->email,
       //          'ambassador'          => $student->ambassador,
       //          'otp'          => $student->otp,
       //          'otp_count'          => $student->otp_count,
       //          'complete_profile'          => $student->complete_profile,
       //          'created_by'          => $student->created_by,
       //          'updated_by'          => $student->updated_by,
       //          'IsVerify'          => $student->IsVerify,
       //          'status'          => $student->status,
       //          'created_at'          => $student->created_at,
       //          'updated_at'          => $student->updated_at,
       //          'deleted_at'          => $student->deleted_at,
       //          'school_name'          => $student->school_name,
       //          'device_type'          => $student->device_type,
       //          'device_token'          => $student->device_token,
       //          'referral_points'          => $student->referred_map,
       //          'referral_code_count'    => $student->referral_code_count);

       //         array_push($json, $bus);



       //   return response()->json([
       //          "status"=> 'success',
       //          "messageId"=> 200,
       //          "message"=> "User Profile Update Successfully",
       //          "data"=>$json,
       //      ]); 


    }
     public function verify(Request $request)
    {
        $this->validate($request, [
            'otp'=>'required|integer'
        ]);

        $id = base64_decode($request->user);

        $student = Student::findOrFail($id); 


        if($student->otp == $request->otp)
        {
        
             Auth::guard('student')->login($student);

              $notification = array(
                  'message' => 'Otp Verified Successfully',
                  'alert-type' => 'success'
                  );
              if($student->plan_id)
              {
               //return redirect('/student/home')->with($notification); 
               return redirect('/student/dashboard')->with($notification); 
              }
              else
              {
                return redirect('/plans')->with($notification); 
              }
           
        } else {

          $id = base64_encode($id);

            $notification = array(
                  'message' => 'Otp Verification Failed.',
                  'alert-type' => 'error'
                  );

          return view('frontend.auth.verify', compact('id'))->with($notification);
        }
        

    }

            public function guard()
            {
             return Auth::guard('student');
            }



        public function login(Request $request)
        {
                $this->validate($request, [
                'mobile'=>'required|integer',
                'country'=>'required'
            ]);

        $number =$request->mobile;
        $country_code =$request->country;
        $n = config('constants.NUMBER_LENGTH');
         //$number =  substr($number,$n);
         // $country_code = config('constants.COUNTRY_CODE');

              $student = Student::where('mobile_number',$number)->first();

              if($student){
                     $otp = rand(1,10000);
                          $student->otp = $otp;
                          $student->save();

                    $id = base64_encode($student->id);
                    $message = 'Your OTP is : '.$otp; 
                    $recipients = $country_code.$number;
                    $postData = [
                        "To" => "+" . $recipients,
                        "Body" => $message,
                    ];
                    $messageFlag = $this->Send_Otp_Twillio($postData, 2000, false, false);
                    $notification = array(
                          'message' => 'Please Verify OTP',
                          'alert-type' => 'success'
                          );

                    return view('frontend.auth.verify',compact('id'))->with($notification);
              } else{
              
                   $notification = array(
                  'message' => "Invalid Mobile Number",
                  'alert-type' => 'error'
                  );
                   return redirect()->back()->with($notification);
              }
        }

    public function resend_otp(Request $request)
      {

        $id = base64_decode($request->user);
        $otp = rand(1,10000);
        //$country_code = config('constants.COUNTRY_CODE');
         $student = Student::findOrFail($id); 
         $country_code =$student->country_code;
         $student->otp = $otp;
         $student->save();
        $message = 'Your OTP is : '.$otp; 
        $recipients = $country_code.$student->mobile_number;
        $postData = [
            "To" => "+" . $recipients,
            "Body" => $message,
        ];
        $messageFlag = $this->Send_Otp_Twillio($postData, 2000, false, false);
        $id = $request->user;
          $notification = array(
                  'message' => ' Please Verify OTP.',
                  'alert-type' => 'success'
                  );

        
        
        return view('frontend.auth.verify',compact('id'))->with($notification);
      }






        public static function Send_Otp_Twillio($postFields = array(), $timeout = 2000, $asynch = false, $postAsBodyParam = false)
    {


        $account_sid = config('constants.TWILIO_SID');
        $auth_token = config('constants.TWILIO_TOKEN');
        $twilio_number = config('constants.SENDER_NUMBER');
        $url = "https://api.twilio.com/2010-04-01/Accounts/" . $account_sid . "/Messages.json";
        $postFields['From'] = "+" .$twilio_number;

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
            $result = curl_getinfo($ch);
            curl_close($ch);
            if ($asynch || (isset($result['http_code']) && in_array($result['http_code'], [200, 201, 202, 204]))) {
                return $response;
            } else {
                return false;
            }
         } 


         public function signin()
         {
           return view('frontend.auth.login');
         }

         public function signup()
         {
           return view('frontend.auth.register');
         }
   
}
