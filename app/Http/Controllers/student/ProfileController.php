<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Student;
use App\OrderDetail;
use App\Order;
use App\School;
use App\Subscription;
use Session;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ContactMail;
use App\Mail\Forgot;
use App\Referral;
use App\Websitesetting;
use App\KitchenFood;
//use Illuminate\Support\Facades\Hash;
use Hash;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'isAdmin','clearance']);
          $this->middleware('student');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
     $studentId = Auth::guard('student')->user()->id;
     // validate user plan
     $plan=getUserPlan($studentId);
     if(!$plan)
     {
       return redirect('/plans');
     }   
     $orderList = Order::where('user_id',$studentId)->orderBy('id','DESC')->get();
     $pagename='dashboard'; 
     return view('frontend.student.dashboard',compact('orderList','pagename'));

    }

    public function subscriptions(){
     $studentId = Auth::guard('student')->user()->id;   
     // validate user plan
     $plan=getUserPlan($studentId);
     if(!$plan)
     {
       return redirect('/plans');
     }  
     $student = Student::with('plan_name')->findOrFail($studentId); 
     $pagename='subscriptions';
     return view('frontend.student.subscriptions',compact('student','pagename'));

    }
    public function profile(){
     $studentId = Auth::guard('student')->user()->id;    
     $student = Student::findOrFail($studentId); 
     $schools = School::get(); 
     $pagename='profile';
     return view('frontend.student.profile',compact('student','schools','pagename'));

    }
    public function change_password()
    {

     // $studentId = Auth::guard('student')->user()->id; 
     //  // validate user plan
     // $plan=getUserPlan($studentId);
     // if(!$plan)
     // {
     //   return redirect('/plans');
     // } 
       $pagename='change_password';
       return view('frontend.student.change_password',compact('pagename')); 
    }
    public function update_password(Request $request)
    {
         $studentId = Auth::guard('student')->user()->id;   
         $res= Student::where('id',$studentId)->get();
         if(!Hash::check($request->oldpassword, $res[0]['password'])){
            $notification = array(
                  'message' => 'Old Password Not Match.',
                  'alert-type' => 'error'
                  );
           return redirect()->back()->with($notification);
          }
          else
          {
             $dusers=User::where('id',$studentId)->update(array('password'=>bcrypt($request->newpassword)));
              $notification = array(
                  'message' => 'Password has been changed successfully.',
                  'alert-type' => 'success'
                  );
           return redirect()->back()->with($notification);
          }
    }

    public function wallet()
    {

         $pagename='wallet';
         $studentId = Auth::guard('student')->user()->id; 
         // validate user plan
         $plan=getUserPlan($studentId);
         if(!$plan)
         {
           return redirect('/plans');
         } 
         $referrallist=Referral::select('referred_map.*')
         ->where('referred_by',$studentId)
         ->orWhere(function ($query) use ($studentId) {
            $query->orWhere('referred_to', $studentId)
           ;
         });
         $referrallist=$referrallist->paginate(20);
         $student=Auth::guard('student')->user()->id; 
         return view('frontend.student.wallet',compact('pagename','referrallist','student')); 
    }


// function for place order
    public function placeOrder($menu_item_id)
    {

       $userId = Auth::guard('student')->user()->id;  
        if (!$menu_item_id) {
            $notification = array(
                  'message' => 'Menu Item Required.',
                  'alert-type' => 'error'
                  );
           return redirect()->back()->with($notification);
        }

        try{
          
          // check student already palce order or not for current data

           $ordercount = Order::where(['user_id'=>$userId])->whereDate('created_at', '=', date('Y-m-d'))->count();
           if($ordercount>0)
           {
             $notification = array(
                  'message' => 'You can place only one order for a day.',
                  'alert-type' => 'error'
                  );
                 return redirect()->back()->with($notification);
           }

            $subscription_existed=\App\Subscription::where('student_id',$student->id)->orderBy('id','DESC')->firstOrFail();
            if(empty($subscription_existed))
            {
              $notification = array(
                  'message' => 'You have not subscribe any plan.So please subscribe plan first',
                  'alert-type' => 'error'
                  );
                 return redirect()->back()->with($notification); 
            }
            else
            {
               if(date('Y-m-d', strtotime($subscription_existed['next_period_start'])) >= date('Y-m-d', strtotime(now())) )
               {
                  $student = Student::with(['plan_name','school_detail'])->where('id',$userId)->firstOrFail();

                   if((int)$student->current_order >= (int)$student->plan_name->max_meals_per_week){
                        $notification = array(
                        'message' => 'Your max meals per week limit has been used.',
                        'alert-type' => 'error'
                        );
                       return redirect()->back()->with($notification);
                  }
                  $food_item = KitchenFood::where('id',$menu_item_id)->firstOrFail();
                  $subscription_id = $subscription_existed->id;
                  $order = Order::create([
                      'user_id'                 =>$student->id,
                      'order_total'             =>$food_item->price,
                      'payment_status'          =>'paid',
                      'payment_by_subscription' =>$subscription_id,
                      'created_by'              =>$student->id,
                      'updated_by'              =>$student->id,
                      'school_id'              =>$student->school_detail->id,
                      'vendor_id'              =>$food_item->vendorId,
                      'order_type'              =>'web'
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
                        $notification = array(
                        'message' => 'Order has been placed successfully.',
                        'alert-type' => 'success'
                        );
                       return redirect('/student/dashboard')->with($notification);
                  }else{
                         
                        $notification = array(
                        'message' => 'Order Placement Failed.Try Again',
                        'alert-type' => 'error'
                        );
                       return redirect()->back()->with($notification);
                  }
              }
              else
              {
                 $notification = array(
                  'message' => 'Your scbscription plan has been expired.',
                  'alert-type' => 'error'
                  );
                 return redirect()->back()->with($notification);
              }
            }
            
        } catch (ModelNotFoundException $ex) {  

                  $notification = array(
                  'message' => 'Order Placement Failed.Try Again',
                  'alert-type' => 'error'
                  );
                 return redirect()->back()->with($notification);
        } 
    
    }
}
