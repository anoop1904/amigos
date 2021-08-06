<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Plan;
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

class PlanController extends Controller
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
        $plan = \App\Plan::orderBy('id','DESC');
        //$email_template = DB::table('tbl_messages_template')->get();;

        if(isset($_GET['name']))
        {
			
          if($_GET['name']!='')
          {
           $plan->where('name','LIKE','%'.$_GET['name'].'%');
          }       
        }
       else
        {
            $plan->orderBy('id','DESC');
        }
        
        $plans= $plan->paginate(20);
        $pagetitle='Plan List';
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.razorpay.com/v1/plans",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic cnpwX3Rlc3RfajRRbHkzbHBOV0E2YWk6WjZLQ0tJS2VlQW02UmxINDdQSmJjSGhj"
          ),
        ));
        $plans = curl_exec($curl);
        curl_close($curl);
        
        return view('plan.index',compact('plans','pagetitle'));
    }
	
		  public function create()
    {
		
        $pagetitle='Create Plan';
        return view('plan.create',compact('pagetitle'));
    }
	
	
	  public function edit($id)
    {

     $plan = \App\Plan::findOrFail($id); 

     $pagetitle='Plan Update';
     return view('plan.create',compact('plan','pagetitle')); 
    }
	

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//return $request;

        $this->validate($request, [
            'name'=>'required|max:500',
         //   'description'=>'required|max:3000',
         //   'price'=>"required|regex:/^\d{1,13}(\.\d{1,4})?$/|max:9999999" ,
         //   'file'=>'required|file|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
		
		$plans = new \App\Plan(); 
		   
		    $image = $request->file('file');
        if($image){
            $input['imagename'] = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/plan');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
		$plans->image = $img;	
        }
        
	
        //$plan->plan_id =uniqid();
        $plans->name = $request->name;
        $plans->plan_type = $request->planType;
        $plans->description = $request->editor1;
		$plans->price = $request->price;	
	    $flag = $plans->save();
		
	   if($flag) {
            return redirect('admin/plan')->with('message','Template Created successfully.');
        }else{
            return redirect('admin/plan/create')->with('message','Action Failed Please try again.');
        }
              
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->RoleID !== 0) return view('errors.401');
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		
        $plan = Plan::findOrFail($id);
        $delete = $plan->delete(['deleted'=>1]);
        if(isset($delete)) {
        return redirect()->route('plans.index')
            ->with('message',
             'Plan successfully Deleted.');
        }else{
            return redirect()->route('plans.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }
	
		 public function update(Request $request, $id)
    {
   
        $this->validate($request, [
        'name'=>'required|max:120',
        ]);

        $plans = \App\Plan::findOrFail($id); 
        
		    $image = $request->file('file');
        if($image){
            $input['imagename'] = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/plan');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
		$plans->image = $img;	
        }
        
	
        //$plan->plan_id =uniqid();
        $plans->name = $request->name;
        $plans->plan_type = $request->planType;
        $plans->description = $request->editor1;
		$plans->price = $request->price;	
		
		$flag = $plans->save();
        if($flag){
            return redirect()->route('plan.index')->with('message','Plan successfully added.');
        }else{
            return redirect()->route('plan.index')->with('message','Action Failed Please try again.');
        }
    }
	

   
}



