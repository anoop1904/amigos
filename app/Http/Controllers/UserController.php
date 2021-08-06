<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\School;
use App\Student;
use App\Subscription;
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
//use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $rolename = Auth::user()->roles()->pluck('name')->implode(' ');
        $roles      = Role::where('userid','0')->orWhere('userid','1')->where('name','!=',$rolename)->get();
            $users = User::where('id','!=',1)->orderBy('id','DESC');
         if(Auth::user()->id !=1){
            $users = User::where('CreatedBy',Auth::user()->id)->orderBy('id','DESC');
         }
     
        $start='';
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $users->where('name','LIKE','%'.$_GET['name'].'%');
          }
           
        }
        if(isset($_GET['email']))
        {
          if($_GET['email']!='')
          {
           $users->where('email',$_GET['email']);
          }

        }
        if(isset($_GET['status']))
        {
          if($_GET['status']!='all')
          {
            $users->where('IsActive',$_GET['status']);
          }

        } 
        if(isset($_GET['store'])){
          if($_GET['store']!='all'){
            $users->where('CreatedBy',$_GET['store']);
          }
        }

		    $stores = \App\User::where(['IsActive'=>1,'user_type'=>20])->get();
        $users= $users->paginate(20);
        $pagetitle='User List';
        return view('users.index',compact('users','stores','roles','pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $roles = Role::get();
        $rolename = Auth::user()->roles()->pluck('name')->implode(' '); 
        $users = User::where('CreatedBy',Auth::user()->id)->get();
        if($rolename =='Store Manager'){
         $roles = Role::where('userid','1')->where('name','=','Delivery boy')->get();
        }else{
             $roles = Role::where('userid','1')->where('name','!=',$rolename)->get();
        }
       
        
        $pagetitle='Create User';
        return view('users.create',compact('users','roles','pagetitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $this->validate($request, [
            'name'=>'required|max:120',
            'zipcode'=>'required|max:6',
            'email'=>'required|email|unique:users',
            'Phone'=>'required|max:15|unique:users',
            'password'=>'required|min:6|max:30|confirmed'
        ]);
		

        $data = $request->all();
        //print_r($data );
        $usertype = $roles = $request['roles']; 
      
        $user = User::create([
              'user_type' =>$usertype,
              'name' =>$data['name'],
              'email' =>$data['email'],
              'Phone' =>$data['Phone'],
              'password' => $data['password'],
              'IsVerify' => '1',
              'zipcode' =>$data['zipcode'],
              'CreatedBy' =>Auth::user()->id
        ]);
        $code = 'u'.date('Y').$user->id;
        User::where('id',$user->id)->update(['user_code'=>$code,'zipcode' =>$data['zipcode']]);
        
        if (isset($roles)) {
            $role_r = Role::where('id', '=', $roles)->firstOrFail();            
            $user->assignRole($role_r);
        }    
     
        //varification link


        $getWebInfo = Websitesetting::select('website_name', 'website_logo', 'email', 'address', 'mobile')->first();
        $user = User::find($user->id);
        //dd($user->name);
         $content = [
             'title'         => 'Varification Link with SubTitle', 
             'body'          => 'The body of your message.',
             'address'       => $getWebInfo->address,
             'mobile'        => $getWebInfo->mobile,
             'website_name'  => $getWebInfo->website_name,
             'website_logo'  => $getWebInfo->website_logo,
             'email'         => $getWebInfo->email,
             'user'          => $user,
             'name'          => $data['name'],
             ];
        //$receiverAddress = array('manish09.chakravarti@gmail.com');
        $receiverAddress = array($data['email']);

        // //return view('emails.CandidateApply',compact('content'));
        $mail = Mail::to($receiverAddress)->bcc('manish09.chakravarti@gmail.com')->send(new Verification($content) );
        if (count(Mail::failures()) > 0) {
            //echo "There was one or more failures. They were: <br />";
            foreach (Mail::failures as $email_address) {
              //  echo " - $email_address <br />";
            }
        }else {
            //echo "No errors, all sent successfully!";
        }

        /////////////    

        return redirect()->route('users.index')->with('message','User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolename = Auth::user()->roles()->pluck('name')->implode(' '); 
        $user = User::findOrFail($id); 
        $roles = Role::where('userid','1')->where('name','!=',$rolename)->get();

        $pagetitle='Store Edit';
        return view('users.create', compact('user', 'roles','pagetitle'));
    }
    public function change_password($id)
    {
        $user = User::findOrFail($id); 
        $users = User::where('CreatedBy',Auth::user()->id)->get();
        $roles = Role::where('userid','0')->get();
        return view('users.change_password', compact('user', 'roles','users'));
    }
    public function update_password(Request $request)
    {
        $data = $request->all();
        $user = User::findOrFail($data['userId']); 
         $this->validate($request, [
            'password'=>'required|min:6|confirmed',
        ]);
        $input = $request->only(['password']);
        $user->fill($input)->save();
          return redirect()->route('users.index')
            ->with('message',
             'Password update successfully.');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        if(!$request['password'] && $request['password'] == '') unset($request['password']);
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'Phone'=>'required|max:10|unique:users,Phone,'.$id,
            ]);
        $user = User::findOrFail($id);
        $user->email              = $request->email;
        $user->name               = $request->name;
        $user->Phone              = $request->Phone;
        $user->zipcode            = $request->zipcode;
        if($request['password']) $user->password  = $request->password;
        $user->save();
        $roles = $request['roles'];
      
        if (isset($roles)) {        
            $user->roles()->sync($roles);            
        }else {
            $user->roles()->detach();
        }

        return redirect()->route('users.index')
            ->with('message',
             'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchoolVendorMapping::where('vendor_id',$id)->delete();
        $user = User::findOrFail($id);
        $delete = $user->delete();
        if(isset($delete)) {
        return redirect()->route('users.index')
            ->with('message',
             'User successfully Deleted.');
        }else{
            return redirect()->route('users.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function deActiveUser($id)
    {
        $user = User::findOrFail($id);
        User::where('id',$id)->update(array('IsActive'=>'0'));
        return redirect()->route('users.index')
            ->with('message',
             'User successfully De-active.');
    }
    public function activeUser($id)
    {
        $user = User::findOrFail($id);
        User::where('id',$id)->update(array('IsActive'=>'1'));
        return redirect()->route('users.index')
            ->with('message',
             'User successfully Active.');
    }

   // function for show subscriptions according school
    public function subscriptions()
    {
        $schools=School::where('status',1)->get();
        $schoolList=School::where('status',1);
        if(isset($_GET['school']))
        {
          if($_GET['school']!='')
          {
           $schoolList->where('id','=',$_GET['school']);
          }
           
        }
         $schoolList=$schoolList->paginate(20);
         $pagetitle='Subscriptions List';
        return view('school.subscriptions',compact('schoolList','schools','pagetitle'));
    }

   // function for show subscriptions details according particular school

    public function showSubscriptionDetail($school_id,$status)
    {
        if($status=='active')
        {
            $list = Student::with(['subscription','plan_name'])->whereHas('subscription',function($query){
               $query->whereDate('next_period_start', '>=',date('Y-m-d', strtotime(now())));
              })->where('school_id',$school_id)->paginate(20);
        }
        else
        {
            $list = Student::with(['subscription','plan_name'])->whereHas('subscription',function($query){
              
              })->where('school_id',$school_id)->paginate(20);    
        }
         
         $pagetitle='Subscriptions Details';
         $schoolname=School::select('name','id')->where('id',$school_id)->firstOrFail();
        return view('school.subscriptiondetail',compact('list','pagetitle','schoolname','status'));
        
    }

    public function subscriptionlist()
    {
         $schools=School::where('status',1)->get();
        $schoolList=School::where('status',1);
        if(isset($_GET['school']))
        {
          if($_GET['school']!='')
          {
           $schoolList->where('id','=',$_GET['school']);
          }
           
        }
         $schoolList=$schoolList->paginate(20);
        //echo count($schools1);
      
        // foreach ($schools as $key => $value) {
        //  $students = Student::where('school_id', $value->id)
        // ->select('school_id')
        // ->selectRaw('GROUP_CONCAT(id) as ids')
        // ->get();
        // $studentIds=explode(',',$students[0]->ids);
        // $users =Subscription::whereIn('student_id',$studentIds)->get();
        //  echo count($users);
        //  $t+=count($users);
        // echo '<br>';
        // }
         // $list=Student::with(['subscription','school_detail'])->whereHas('school_detail',function($query){
         //             $query->where('status',1);   
         //        })->groupBy('school_id')->paginate(20);
       

        $pagetitle='Subscriptions List';
        return view('school.subscriptionlist',compact('schoolList','pagetitle','schools'));
        
    }

     // function for show subscriptions expire list
    public function showSubscriptionExpire()
    {
         $schools=School::where('status',1)->get();
         $startdate = date('Y-m-d'.' 23:59:59',strtotime('monday this week'));
         $enddate = date('Y-m-d'.' 23:59:59',strtotime("sunday this week"));
         $date=date('m/d/Y',strtotime('monday this week')).'-'.date('m/d/Y',strtotime('sunday this week'));
         $schoolid='';
         $name='';
         $email='';
         $mobile='';
        if(isset($_GET['school']))
        {
          if($_GET['school']!='all')
          {
             $schoolid=$_GET['school'];
          }
          
        }
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
             $name=$_GET['name'];
          }
          
        }
        if(isset($_GET['email']))
        {
          if($_GET['email']!='')
          {
             $email=$_GET['email'];
          }
          
        }
        if(isset($_GET['mobile']))
        {
          if($_GET['mobile']!='')
          {
             $mobile=$_GET['mobile'];
          }
          
        }
       
         $list=Subscription::with(['student_detail','student_detail.school_detail','plan_name'])->whereHas('student_detail',function($query) use($schoolid,$name,$email,$mobile){
                    if($schoolid!='')
                    {
                     $query->where('school_id', '=',$schoolid);   
                    }
                    if($name!='')
                    {
                     $query->where('name', 'LIKE','%'.$name.'%');   
                    }
                    if($email!='')
                    {
                     $query->where('email', '=',$email);   
                    }
                    if($mobile!='')
                    {
                     $query->where('mobile_number', '=',$mobile);   
                    }
                });

       if(isset($_GET['date_filter']))
        {
          if($_GET['date_filter']!='')
          {
             $date_filter =explode('-', $_GET['date_filter']);
              $from_date=date('Y-m-d'.' 23:59:59',strtotime(trim($date_filter[0])));
              $to_date=date('Y-m-d'.' 23:59:59',strtotime(trim($date_filter[1])));
              $list->whereBetween('next_period_start', [$from_date, $to_date]);
          }
          else
          {
            $list->whereBetween('next_period_start', [$startdate, $enddate]);
          }

         }
         else
         {
           $list->whereBetween('next_period_start', [$startdate, $enddate]);
         }

         $list= $list->paginate(20);
        // dd($list);
        $pagetitle='Subscriptions expired this week';
        return view('school.subscriptionexpire',compact('list','pagetitle','schools','date'));
        
    }
}
