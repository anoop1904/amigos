<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Kitchen;
use App\KitchenFood;
use App\Student;
use App\Referral;
use App\School;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use Validator;
//use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct() 
    {
        //$this->middleware(['auth','clearance']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        
        $start='';
        $student = Student::with(['school_detail','subscription']);
        if(isset($_GET['school']))
        {
          if($_GET['school']!='all')
          {
            $student->where('school_id',$_GET['school']);
          }
          
        }
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $student->where('name','LIKE','%'.$_GET['name'].'%');
          }
           
        }
        if(isset($_GET['shortby']))
        {
          if($_GET['shortby']!='all')
          {
            $student->orderBy('total_credit',$_GET['shortby']);
          }
           
        }
        else
        {
            $student->orderBy('id','DESC');
        }
        if(isset($_GET['subscription']))
        {
          if($_GET['subscription']!='all')
          {
            if($_GET['subscription']==1)
            {
                $student->whereNotNull('plan_id');
            }
            else
            {
                $student->whereNull('plan_id');
            }
          
          }
           
        }
        if(isset($_GET['email']))
        {
          if($_GET['email']!='')
          {
           $student->where('email',$_GET['email']);
          }

        }
       
        if(isset($_GET['ambassador']))
        {
          if($_GET['ambassador']!='all')
          {
             $student->where('ambassador',$_GET['ambassador']);
          }

        } 
        if(isset($_GET['mobile']))
        {
          if($_GET['mobile']!='')
          {
            $student->where('mobile_number',$_GET['mobile']);
          }

        }
        
        
        $student= $student->paginate(20);
        $schoolList=School::where('status',1)->get();
        $pagetitle='Student Management';
        // dd($student);
        return view('student.index',compact('student','schoolList','pagetitle'));
    }

        public function create()
    {
       // $roles = Role::get();
            
              $schools = School::get();  

        
        return view('student.create',compact('schools'));
    }


   public function edit($id)
    {
     $user = Student::findOrFail($id); 
     $schools = School::get(); 
     return view('student.create',compact('user','schools')); 
    }

   public function store(Request $request)
    {
       //return $request;
        $this->validate($request, [
              'name'=>'required|max:120',
              'email'=>'required|email|unique:users',
              'Phone'=>'required|max:15',
              'school'=>'required',
            ]);

        if($request->is_ambasadder == 'on')
        {
          $is_ambasadder = 1;
        } else{
          $is_ambasadder = 0;
        }
        
     $student = new Student(); 
     $student->name = $request->name;
     $student->last_name = $request->last_name;
     $student->email = $request->email;
     $student->referral_code = $request->referral_code;
     $student->mobile_number = $request->Phone;
     $student->school_id = $request->school;
     $student->ambassador = $is_ambasadder;


    if($request->hasFile('file')) {

        $image = $request->file('file');
        if($image){
            // $path = '/public/student';  
            //  if(file_exists($path.$student->image))
            //  {
            //    unlink($path.$student->image);
            //  }

            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/student');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $student->profile_pic = $img;
        }
    }


     $student->save();
        return redirect()->route('student.index')
            ->with('message',
             'student Info successfully edited.');
    }

 public function update(Request $request, $id)
    {
       //return $request;
        $this->validate($request, [
            'name'=>'required|max:120',
            'school'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'Phone'=>'required|max:15',
            ]);

        $student = Student::findOrFail($id); 
        $stud = $request->user;

        if($request->is_ambasadder == 'on')
        {
          $is_ambasadder = 1;
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
        } else{
          $is_ambasadder = 0;
          $student->plan_id = null;
          $subscription_existed=\App\Subscription::where(['student_id'=>$student->id])->first();
            if($subscription_existed){
                $subscription_existed->next_period_start = '';
                $subscription_existed->deleted_at = time();
                $subscription_existed->save();
            }

        }
     $student->name = $request->name;
     $student->last_name = $request->last_name;
     $student->email = $request->email;
     $student->mobile_number = $request->Phone;
     $student->school_id = $request->school;
     $student->ambassador = $is_ambasadder;


    if($request->hasFile('file')) {

        $image = $request->file('file');
        if($image){
            $path = '/public/student';  
             if(file_exists($path.$student->image))
             {
               unlink($path.$student->image);
             }

            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/student');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $student->profile_pic = $img;
        }
    }


     $student->save();
        return redirect()->route('student.index')
            ->with('message',
             'student Info successfully edited.');
    }
   

       public function destroy($id)
    {
        $user = Student::findOrFail($id);
        $delete = $user->delete();
        // Log::create([
        //   'user_id' =>$id,
        //   'activity' =>"User Deleted",
        //   'createdBy' =>Auth::user()->id
        // ]);
        if(isset($delete)) {
        return redirect()->route('student.index')
            ->with('message',
             'Student successfully Deleted.');
        }else{
            return redirect()->route('student.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function deActiveUser($id)
    {
        $user = Student::findOrFail($id);
        Student::where('id',$id)->update(array('status'=>'0'));
        return redirect()->route('student.index')
            ->with('message',
             'Student successfully De-active.');
    }
    public function activeUser($id)
    {
        $user = Student::findOrFail($id);
        Student::where('id',$id)->update(array('status'=>'1'));
        return redirect()->route('student.index')
            ->with('message',
             'Student successfully Active.');
    }


    public function make_ambassador(Request $request)
    {
        $student = Student::findOrFail($request->userid); 
        if($request->status == 1)
        {
           // create plan
            $plan=\App\Plan::first();
            $student->plan_id   = $plan->id;
            $student->save();
            $user = \App\Subscription::updateOrCreate([
                'plan_id'       =>$plan->id,
                'student_id'    =>$request->userid
                ],[
                    'price'             => $plan->price,
                    'payment_gateway'   => 'ambassador_package',
                    'transaction_id'    => 0,
                    'next_period_start' => date('Y-m-d', strtotime('+6 month', strtotime(date('Y-m-d')))),
                    'agreement_id'      => rand(1000000000,9900000009)
            ]);
        } else{
          
             $student->plan_id = null;
             $student->save();
             $subscription_existed=\App\Subscription::where(['student_id'=>$request->userid])->first();
             if($subscription_existed){
                $subscription_existed->next_period_start = '';
                $subscription_existed->deleted_at = date('Y-m-d H:i:s');
                $subscription_existed->save();
             }

        }

        Student::where('id',$request->userid)->update(array('ambassador'=>$request->status));
        
    }

// gel all reffer list of student

    public function referrallist($student_id)
    {
         $pagetitle='Referral List';
         $student = Student::findOrFail($student_id);

    //      $data = Activity::select('activity_log.*', 'users.first_name', 'users.last_name', 'users.email')
    // ->join('users', 'users.id', '=', 'activity_log.causer_id')
    // ->where('subject_id', '=', $id)
    // ->where('subject_type', '=', 'App\Models\Node')
    // ->where(function ($query) use ($filtertext) {
    //     $query
    //         ->orWhere('first_name', 'like', '%' . $filtertext . '%')
    //         ->orWhere('last_name', 'like', '%' . $filtertext . '%')
    //         ->orWhere('email', 'like', '%' . $filtertext . '%');
    // })
    // ->with([
    //     'subject' => function ($q) {
    //         $q->whereNull('deleted_at');
    //     }
    // ])
    // ->orderBy('created_at', 'desc')
    // ->paginate(12);


         $referrallist=Referral::select('referred_map.*')
         ->where('referred_by',$student_id)
         ->orWhere(function ($query) use ($student_id) {
            $query->orWhere('referred_to', $student_id)
           ;
        });

         // ->where(function ($query) use ($student_id) {
         //   $query->orWhere('referred_to',$student_id);
         // });
         $start='';
        if(isset($_GET['status']))
         {
          if($_GET['status']!='all')
          {
            $referrallist->where('approval_status',$_GET['status']);
          }

         } 
       
        if(isset($_GET['date']))
        {
          if($_GET['date']!='')
          {
             $start=date('Y-m-d'.' 00:00:00',strtotime($_GET['date']));
             $referrallist->whereDate('created_at', '=', $start);
          }

        }
         if(isset($_GET['date_filter']))
        {
          if($_GET['date_filter']!='')
          {
            if($_GET['date']=='')
            {

             $date_filter =explode('-', $_GET['date_filter']);
             $from_date=date('Y-m-d'.' 23:59:59',strtotime(trim($date_filter[0])));
              $to_date=date('Y-m-d'.' 23:59:59',strtotime(trim($date_filter[1])));
             $referrallist->whereBetween('created_at', [$from_date, $to_date]);
            }
          }

         }
         $referrallist=$referrallist->paginate(20);
         return view('student.referrallist',compact('pagetitle','student','referrallist'));
    }


   
}
