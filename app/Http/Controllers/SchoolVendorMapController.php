<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\SchoolVendorMapping;
use App\KitchenFood;
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

class SchoolVendorMapController extends Controller
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
        $kitchens = SchoolVendorMapping::
                    join('school_info', 'school_info.id','=','school_vendor_mapping.school_id')
                    ->join('users', 'users.id','=','school_vendor_mapping.vendor_id')
                    ->select('school_vendor_mapping.*','school_info.name as school','users.name as username')
                    ->get();  

     //    $kitchens = SchoolVendorMapping::with(['vendors'])->get();
     // echo '<pre>';
     //  foreach ($kitchens as $kitchen) {
     //      print_r($kitchen->vendors);
     //  }
                    
                     //echo "<pre>";
                    //print_r($kitchens);
                    //die;
        
        // return $kitchens;


        return view('school-vendor-map.index',compact('kitchens'));
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
        $users = User::where('user_type',config('constants.VENDOR'))->get();
        $school = School::get();
        return view('school-vendor-map.create',compact('users','school'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = $request->all();

         // $vendor = implode(',', $request->vendor);
        
        $this->validate($request, [
            'school'=>'required|max:120',
            'vendor'=>'required|max:120'
           
        ]);

       
        foreach ($request->vendor as $key => $value) {

         

         $user = SchoolVendorMapping::create([
              'vendor_id'            =>$value,
              'school_id'           =>$request->school,
              'status'              =>1,
              'created_by' =>Auth::user()->id,
              'updated_by' =>Auth::user()->id
          ]);

        }
         

          
        //varification link


    
        return redirect()->route('school-vendor-map.index')->with('message','kitchen Info successfully added.');
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
        $kitchen = SchoolVendorMapping::findOrFail($id); 
        $users = User::where('user_type',config('constants.VENDOR'))->get();
        $school = School::get();
        return view('school-vendor-map.create', compact('school','users','kitchen'));
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
            'school'=>'required|max:120',
            'vendor'=>'required|max:120',
            ]);


        foreach ($request->vendor as $key => $value) {

        $kitchen = SchoolVendorMapping::findOrFail($id);
        $kitchen->vendor_id               = $value;
        $kitchen->school_id              = $request->school;
        $kitchen->status              = 1;
        $kitchen->created_by           = Auth::user()->id;
        $kitchen->updated_by         = Auth::user()->id;
         
         }


        $kitchen->save();
        return redirect()->route('school-vendor-map.index')
            ->with('message',
             'Kitchen Info successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kitchen = SchoolVendorMapping::findOrFail($id);
        $delete = $kitchen->delete();
        if(isset($delete)) {
        return redirect()->route('school-vendor-map.index')
            ->with('message',
             'Kitchen Info successfully Deleted.');
        }else{
            return redirect()->route('school-vendor-map.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

 
   
}
