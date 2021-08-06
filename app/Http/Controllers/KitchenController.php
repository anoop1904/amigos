<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Kitchen;
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

class KitchenController extends Controller
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
        $kitchens = Kitchen::with('vendor')->orderBy('id','DESC');
         if(Auth::user()->user_type != 1)
         {
            $kitchens->where('vendorUserId',Auth::user()->id);
         }
        $start='';
        if(isset($_GET['vendor']))
        {
          if($_GET['vendor']!='all')
          {
           $kitchens->where('vendorUserId',$_GET['vendor']);
          }
           
        }
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $kitchens->where('name','LIKE','%'.$_GET['name'].'%');
          }
           
        }
        if(isset($_GET['email']))
        {
          if($_GET['email']!='')
          {
            $kitchens->where('email',$_GET['email']);
          }

        } 
        if(isset($_GET['status']))
        {
          if($_GET['status']!='all')
          {
            $kitchens->where('status',$_GET['status']);
          }

        } 
       
        if(isset($_GET['date']))
        {
          if($_GET['date']!='')
          {
             $start=date('Y-m-d'.' 00:00:00',strtotime($_GET['date']));
             $kitchens->whereDate('created_at', '=', $start);
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
             $kitchens->whereBetween('created_at', [$from_date, $to_date]);
            }
          }

         }
         $kitchens= $kitchens->paginate(20);
        $is_vendor=1;
        if(Auth::user()->user_type == 1)$is_vendor=1;
        // get vendor list
        $vendorList=User::where('user_type',config('constants.VENDOR'))->get();
        $pagetitle='Kitchen Info';
        return view('kitchen_info.index',compact('kitchens','pagetitle','vendorList'));
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
        $is_vendor=1;
        $condition['user_type'] = config('constants.VENDOR');
        if(Auth::user()->user_type == 1){
            $is_vendor=0;
            
        }else{
            $condition['id']= Auth::user()->id;
        }
        $users = User::where($condition)->get();
        return view('kitchen_info.create',compact('users'));
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
            'email'=>'required|email|unique:kitchen_establishment_info',
            'Phone'=>'required|max:15',
            'address'=>'required',
            'vendorUserId'=>'required',
        ]);

        $data = $request->all();
        // print_r($data );
        // die;
        $image = $request->file('file');
        $img = '';
        if($image){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('../assets/images/kitchen');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
        }
        $user = Kitchen::create([
              'vendorUserId'    =>$data['vendorUserId'],
              'name'            =>$data['name'],
              'email'           =>$data['email'],
              'contact_number'  =>$data['Phone'],
              'address'         => $data['address'],
              'zipcode'         => $data['zipcode'],
              'latitude'        => $data['latitude'],
              'longitude'       => $data['longitude'],
              'image'           => $img,
              'created_by' =>Auth::user()->id,
              'updated_by' =>Auth::user()->id
        ]);
          
        //varification link


    
        return redirect()->route('kitchens.index')->with('message','kitchen Info successfully added.');
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
        $kitchen = Kitchen::findOrFail($id); 
        $is_vendor=1;
        $condition['user_type'] = config('constants.VENDOR');
        if(Auth::user()->user_type == 1){
            $is_vendor=0;
            
        }else{
            $condition['id']= Auth::user()->id;
        }
        $users = User::where($condition)->get();
        return view('kitchen_info.create', compact('kitchen','users'));
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
            'email'=>'required|email|unique:kitchen_establishment_info,email,'.$id,
            'Phone'=>'required|max:15',
            'address'=>'required',
            'vendorUserId'=>'required',
            ]);
        $kitchen = Kitchen::findOrFail($id);
        $kitchen->email              = $request->email;
        $kitchen->name               = $request->name;
        $kitchen->contact_number              = $request->Phone;
        $kitchen->vendorUserId        = $request->vendorUserId;
        $kitchen->address        = $request->address;
        $kitchen->zipcode        = $request->zipcode;
        $kitchen->latitude        = $request->latitude;
        $kitchen->longitude        = $request->longitude;
        $kitchen->updated_by        = Auth::user()->id;

        $image = $request->file('file');
        if($image){
            $path = 'assets/images/kitchen/'; 
            if($kitchen->image!='')
            {
               if(file_exists($path.$kitchen->image))
                 {
                   unlink($path.$kitchen->image);
                 }  
            } 
             

            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('../assets/images/kitchen');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $kitchen->image = $img;
        }

        $kitchen->save();
        return redirect()->route('kitchens.index')
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
        $kitchen = Kitchen::findOrFail($id);
        $delete = $kitchen->delete();
        if(isset($delete)) {
        return redirect()->route('kitchens.index')
            ->with('message',
             'Kitchen Info successfully Deleted.');
        }else{
            return redirect()->route('kitchens.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function changeStatusKitchen($id,$keyword)
    {
        //$kitchen = Kitchen::findOrFail($id);
        if($keyword == 'deactive'){
           
        Kitchen::where('id',$id)->update(array('status'=>'0'));
        return redirect()->route('kitchens.index')
            ->with('message',
             'Kitchen Info successfully De-active.');
        }

        if($keyword == 'active'){
           
        Kitchen::where('id',$id)->update(array('status'=>'1'));
        return redirect()->route('kitchens.index')
            ->with('message',
             'Kitchen Info successfully Active.');
        }
    }
   
}
