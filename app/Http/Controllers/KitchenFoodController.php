<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Kitchen;
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
//use Illuminate\Support\Facades\Hash;

class KitchenFoodController extends Controller
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
        $kitchens = KitchenFood::with('vendor')->orderBy('id','DESC');
         if(Auth::user()->user_type != 1)
         {
            $kitchens->where('vendorId',Auth::user()->id);
         }
        $start='';
        if(isset($_GET['vendor']))
        {
          if($_GET['vendor']!='all')
          {
           $kitchens->where('vendorId',$_GET['vendor']);
          }
           
        }
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $kitchens->where('name','LIKE','%'.$_GET['name'].'%');
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
        $pagetitle='Kitchen Food Item';
        return view('kitchenfood.index',compact('kitchens','pagetitle','vendorList'));
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

        $is_vendor=1;

          if(Auth::user()->user_type == 1)
        {
            $is_vendor=0;
        }
        

        
        return view('kitchenfood.create',compact('users','is_vendor'));
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
            'price'=>"required|regex:/^\d{1,13}(\.\d{1,4})?$/|max:15",
            'internal_price'=>"required|regex:/^\d{1,13}(\.\d{1,4})?$/|max:15",
            'description'=>'required',
            'vendorUserId'=>'required|max:120'
           
        ]);

        $data = $request->all();

        $image = $request->file('file');
        $img = '';
        if($image){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/kitchenfood');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
        } else {

            $img = '';
        }
        $user = KitchenFood::create([
              'name'            =>$data['name'],
              'price'           =>$data['price'],
              'internal_price'  =>$data['internal_price'],
              'vendorId'        => $data['vendorUserId'],
              'description'        => $data['description'],
              'image'           => $img,
              'created_by' =>Auth::user()->id,
              'updated_by' =>Auth::user()->id
        ]);
          
        //varification link


    
        return redirect()->route('kitchenfood.index')->with('message','kitchen Info successfully added.');
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
        $kitchen = KitchenFood::findOrFail($id); 
        $users = User::where('user_type',config('constants.VENDOR'))->get();
         

        $is_vendor=1;

         if(Auth::user()->user_type == 1)
        {
            $is_vendor=0;
        }

        if($is_vendor)
        {
           if($kitchen['vendorId']  != Auth::user()->id) return view('errors.401');
        }

        return view('kitchenfood.create', compact('kitchen','users','is_vendor'));
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
        $kitchen = KitchenFood::findOrFail($id);
         if(Auth::user()->user_type == 1)
         {
               $this->validate($request, [
            'name'=>'required|max:120',
            'price'=>"required|regex:/^\d{1,13}(\.\d{1,4})?$/|max:15",
            'internal_price'=>"required|regex:/^\d{1,13}(\.\d{1,4})?$/|max:15",
            'description'=>'required',
            'vendorUserId'=>'required|max:15',
            ]);
          $kitchen->internal_price     = $request->internal_price;
         }else
         {
             $this->validate($request, [
            'name'=>'required|max:120',
            'price'=>'required|max:15',
           'vendorUserId'=>'required|max:15',
            ]);  
         }
        $kitchen->name               = $request->name;
        $kitchen->price              = $request->price;
        $kitchen->description        = $request->description;
        $kitchen->stock              = $request->stock;
        $kitchen->vendorId           = $request->vendorUserId;
        $kitchen->updated_by        = Auth::user()->id;
        
         if ($request->hasFile('file')) {
        $image = $request->file('file');
        if($image){
            $path = '/kitchenfood';  
             if(file_exists($path.$kitchen->image))
             {
               unlink($path.$kitchen->image);
             }

            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/kitchenfood');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $kitchen->image = $img;
        }
    }

        $kitchen->save();
        return redirect()->route('kitchenfood.index')
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
        $kitchen = KitchenFood::findOrFail($id);
        $delete = $kitchen->delete();
        if(isset($delete)) {
        return redirect()->route('kitchenfood.index')
            ->with('message',
             'Kitchen Info successfully Deleted.');
        }else{
            return redirect()->route('kitchenfood.index')
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
