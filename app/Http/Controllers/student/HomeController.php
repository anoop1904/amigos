<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Student;
use App\School;
use Session;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ContactMail;
use App\Mail\Forgot;
use App\Websitesetting;
//use Illuminate\Support\Facades\Hash;
use Hash;

class HomeController extends Controller
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
           
     $stud = Auth::guard('student')->user()->id;  
        
     $student = Student::findOrFail($stud); 
     $schools = School::get(); 
     //return $student;

     if($student->school_id == null)
     {
           $notification = array(
                  'message' => 'OTP Verification Successfull. Please Update your Profile.',
                  'alert-type' => 'success'
                  );
        return view('frontend.auth.profile',compact('student','schools'))->with( $notification);
    } else {
         $notification = array(
                  'message' => 'Welcome'.$student->name,
                  'alert-type' => 'success'
                  );
        return view('student/home',compact('student'))->with($notification);
    }



    }
       
      public function profile(){
     $stud = Auth::guard('student')->user()->id;  
        
     $student = Student::findOrFail($stud); 
     $schools = School::get(); 
    return view('frontend.auth.profile',compact('student','schools'));
   }


     public function user(){
          $stud = Auth::guard('student')->user()->id; 
           $student = Student::findOrFail($stud); 
            $notification = array(
                  'message' => 'Welcome'.$student->name,
                  'alert-type' => 'success'
                  );
        return view('student.home',compact('student'))->with($notification);
     }


    public function getcode($fname,$number){


        $name =  substr($fname,0,4);      
        $num =  substr($number,6);   
        $code = rand(10,10000);   
        $dcode = $name.$num.$code;

        
        $count = Student::where('referral_code',$dcode)->get()->count();  
        if(!$count){
            return $dcode;
        }else{
            return $this->getcode($fname,$number); // should work better
        }
    }


    public function update_profile(Request $request){
         
      
     $stud = $request->user;
        
     $student = Student::findOrFail($stud); 
     $student->name = $request->fname;
     $student->mobile_number = $request->mobile;
     $student->school_year = $request->school_year;
     $student->last_name = $request->lname;
     $student->email = $request->email;
     $student->school_id = $request->school;

     if(!$student->referral_code)
     {
       $refcode = $this->getcode($request->fname,$student->mobile_number);
     }

     


    if($request->hasFile('file')) {

        $image = $request->file('file');
        if($image){
            $path = '/public/student';  
             if(file_exists($path.$student->profile_pic))
             {
               unlink($path.$student->profile_pic);
             }

            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/student');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $student->profile_pic = $img;
        }
    }


     $student->save();
     
     $notification = array(
                  'message' => 'Profile Updated Successfully.',
                  'alert-type' => 'success'
                  );
    
     return redirect()->back()->with($notification);

    }



}
