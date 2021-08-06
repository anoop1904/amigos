<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\School;
use App\Organizationmaster;
use App\Log;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use App\Language_master;
use Validator;
use App\SchoolVendorMapping;
//use Illuminate\Support\Facades\Hash;

class SchoolController extends Controller
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
        $school = School::where('created_by',Auth::user()->id)->orderBy('id','DESC');
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $school->where('name','LIKE','%'.$_GET['name'].'%');
          }
           
        }
        if(isset($_GET['email']))
        {
          if($_GET['email']!='')
          {
           $school->where('email',$_GET['email']);
          }

        }
        if(isset($_GET['status']))
        {
          if($_GET['status']!='all')
          {
            $school->where('status',$_GET['status']);
          }

        } 
       
        if(isset($_GET['region']))
        {
          if($_GET['region']!='')
          {
            $school->where('region_name',$_GET['region']);
          }

        }
       
        $school= $school->paginate(20);
        $schoolList=School::where('status',1)->get();
        $pagetitle='School Management';
        return view('school.index',compact('school','pagetitle'));
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
        $user = School::where('created_by',Auth::user()->id)->get();
        $roles = Role::where('userid','0')->where('name','!=',$rolename)->get();
        //dd($roles);
        $pagetitle='Create School';
        return view('school.create',compact('user','roles','pagetitle'));
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
            // 'email'=>'required|email|unique:users',
            // 'Phone'=>'required|max:15',
             'Address'=>'required|max:15',
            // 'zipcode'=>'required|max:15',
            // 'latitude'=>'required|max:15',
            // 'longitude'=>'required|max:15',
            'region_name'=>'required|max:15',
            'start_order_time' => 'required|date_format:H:i',
             'last_order_time' => 'required|date_format:H:i|after:start_order_time',
            
        ]);

        $time_in_24_hour_format  = date("H:i", strtotime("1:30 PM"));


        $usertype = $roles = $request['roles']; 

        // upload image

       if ($request->hasFile('image_input')) {
  
        $image = $request->file('image_input');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('school-img');
        $image->move($destinationPath, $name);

        } else {
          $name = '';
        }


      
        $user = School::create([

              'name' =>$request->name,
              // 'email' =>$request->email,
              // 'contact_number' =>$request->Phone,
              'address' =>$request->Address,
              // 'zipcode' =>$request->zipcode,
              // 'latitude' =>$request->latitude,
              // 'longitude' =>$request->longitude,
              'start_order_time' =>$request->start_order_time,
              'last_order_time' =>$request->last_order_time,
              'image'   =>$name,
              'region_name'   =>$request->region_name,
              'status' => '1',
              'adminUserId' => '0',
              'created_by' =>Auth::user()->id
        ]);
     

        return redirect()->route('school.index')->with('message','School successfully added.');
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
        $user = School::findOrFail($id); 
        $roles = Role::where('userid','1')->where('name','!=',$rolename)->get();
        $pagetitle='Update School';
        return view('school.create', compact('user', 'roles', 'pagetitle'));
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

        $this->validate($request, [
            'name'=>'required|max:120',
            // 'Phone'=>'required|max:15',
            'Address'=>'required|max:15',
            // 'zipcode'=>'required|max:15',
            // 'latitude'=>'required|max:15',
            // 'longitude'=>'required|max:15',
            'region_name'=>'required|max:15',
            //'start_order_time' => 'required|date_format:H:i',
            // 'last_order_time' => 'required|date_format:H:i|after:start_order_time',
            ]);

        $user = School::findOrFail($id);

                // upload image



       if ($request->hasFile('image_input')) {


            // delete old image
            $dest_path = public_path('/school-img');

            if (!empty($user->image))
            {
            $imagePath = $dest_path . '/' . $user->image;
            if (file_exists($imagePath))
            {

            unlink($imagePath);

            }
            }
  
        $image = $request->file('image_input');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('school-img');
        $image->move($destinationPath, $name);
        $user->image    = $name;
        }


        $user->region_name       = $request->region_name;
        $user->name              = $request->name;
        $user->email             = $request->email;
        $user->contact_number    = $request->Phone;
        $user->address           = $request->Address;
        $user->zipcode           = $request->zipcode;
        $user->latitude          = $request->latitude;
        $user->longitude         = $request->longitude;
        $user->last_order_time         = $request->last_order_time;
        $user->start_order_time         = $request->start_order_time;
       
        $user->save();

        // Log::create([
        //       'user_id' =>$user->id,
        //       'activity' =>"School Updated",
        //       'createdBy' =>Auth::user()->id
        // ]);

 
        return redirect()->route('school.index')
            ->with('message',
             'School Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = School::findOrFail($id);
        $delete = $user->delete();
        // Log::create([
        //   'user_id' =>$id,
        //   'activity' =>"User Deleted",
        //   'createdBy' =>Auth::user()->id
        // ]);
        if(isset($delete)) {
        return redirect()->route('school.index')
            ->with('message',
             'School successfully Deleted.');
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

    public function getNotmapSchool()
    {
        $schoolnotmap=getUnmapSchool();
        $school = School::whereIn('id',$schoolnotmap)->orderBy('id','DESC');
        $school= $school->paginate(20);
        $vendorList = User::where('user_type',config('constants.VENDOR'))->get();
        $pagetitle='School Not map';
        return view('school.schoolnotmap',compact('school','pagetitle','vendorList'));
      
    }

    public function mapschool(Request $request)
    {
            $map=SchoolVendorMapping::create([
              'vendor_id'            =>$request->vendor,
              'school_id'           =>$request->school_id,
              'status'              =>1,
              'created_by' =>Auth::user()->id,
              'updated_by' =>Auth::user()->id
              ]);
        if($map){
            return \Redirect::back()->with('message','School has been maped successfully.');
        }else{
            return \Redirect::back()->with('message','Action Failed...');
        }
    }

}
