<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Plan;
use App\KitchenFood;
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
use App\Subscription;
class PlansController extends Controller
{
   
    
    
    public function index()
    {
        $plans = Plan::where('deleted',0)->get();
        return view('frontend.plans.index',compact('plans'));
    }


// function for subscribe plan
    public function subscribePlan($plane_id)
    {
      $subscription = new SubscriptionController();
      $studentId = Auth::guard('student')->user()->id;
      $subscription_existed= Subscription::where('student_id',$studentId)->orderBy('id','DESC')->first();
        if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
        {
             $notification = array(
                  'message' => 'Subscription already choosed.',
                  'alert-type' => 'error'
                  );
           return redirect()->back()->with($notification);
        }
         $response = $subscription->createAgreement($studentId,$plane_id);
          if($response['status']){
            $notification = array(
                  'message' => 'I have sent you a payment link to follow on your mobile number.',
                  'alert-type' => 'success'
                  );
           return redirect()->back()->with($notification);
        }else{
              $notification = array(
                  'message' => 'Unable to create agreement.',
                  'alert-type' => 'error'
                  );
           return redirect()->back()->with($notification);
        } 
    }
   
}
