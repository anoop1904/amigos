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

class CustomerController extends Controller
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
        $customer = \App\Customer::orderBy('id','DESC');;
        
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $customer->where('name','LIKE','%'.$_GET['name'].'%');
          }           
        }
        if(isset($_GET['shortby']))
        {
          if($_GET['shortby']!='all')
          {
            $customer->orderBy('total_credit',$_GET['shortby']);
          }
        }
        else
        {
            $customer->orderBy('id','DESC');
        }
        
        if(isset($_GET['email']))
        {
          if($_GET['email']!='')
          {
           $customer->where('email',$_GET['email']);
          }
        }
       
        if(isset($_GET['mobile']))
        {
          if($_GET['mobile']!='')
          {
            $customer->where('mobile_number',$_GET['mobile']);
          }
        }
        
        $customers= $customer->paginate(20);
        $pagetitle='Customer Management';
        // dd($student);
        return view('customer.index',compact('customers','pagetitle'));
    }

    public function create()
    {
        $pagetitle='Customer Create';
        return view('customer.create',compact('pagetitle'));
    }


   public function edit($id)
    {
     $user = \App\Customer::findOrFail($id); 
     $pagetitle='Customer Edit';
     return view('customer.create',compact('user','pagetitle')); 
    }

   public function store(Request $request)
    {
       //return $request;
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:tbl_customer',
            'mobile_number'=>'required|unique:tbl_customer',
        ]);

            
         $student = new \App\Customer(); 
         $student->name = $request->name;
         $student->last_name = $request->last_name;
         $student->email = $request->email;
         $student->mobile_number = $request->mobile_number;
         

        if($request->hasFile('file')) {
            $image = $request->file('file');
            if($image){
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/img/customer');
                $image->move($destinationPath, $input['imagename']);
                $img=$input['imagename'];
                $student->profile_pic = $img;
            }
        }


         $flag = $student->save();

        if($flag) {
            return redirect()->route('customer.index')->with('message','Customer Created successfully.');
        }else{
            return redirect()->route('customer.index')->with('message','Action Failed Please try again.');
        }
    }

 public function update(Request $request, $id)
 {
        //return $request;
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:tbl_customer,email,'.$id,
            'mobile_number'=>'required|unique:tbl_customer,mobile_number,'.$id,
        ]);

        $customer = \App\Customer::findOrFail($id); 
        $customer->name = $request->name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->mobile_number = $request->mobile_number;


        if($request->hasFile('file')) {
            $image = $request->file('file');
            if($image){
                $path = public_path('/assets/img/customer/');
                if($customer->image)
                {
                  unlink($path.$customer->image);
                }

                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/img/customer');
                $image->move($destinationPath, $input['imagename']);
                $img=$input['imagename'];
                $customer->profile_pic = $img;
            }
        }

        $flag = $customer->save();
        if($flag) {
            return redirect()->route('customer.index')->with('message','Customer Update successfully.');
        }else{
            return redirect()->route('customer.index')->with('message','Action Failed Please try again.');
        }
    }
   

       public function destroy($id)
    {
        $user = \App\Customer::findOrFail($id);
        $delete = $user->delete();
        if(isset($delete)) {
        return redirect()->route('customer.index')
            ->with('message',
             'Customer successfully Deleted.');
        }else{
            return redirect()->route('customer.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function customerStatus($id, $key)
    {
        $customer = \App\Customer::findOrFail($id);
        if($key === 'active'){
            $customer->status = 1;
            $message = 'Customer successfully Active';

        }
        if($key === 'deactive'){
            $customer->status = 0;
             $message = 'Customer successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            return redirect()->route('customer.index')->with('message',$message);
        }else{
            return redirect()->route('customer.index')->with('message','Operation failed please try again.');
        }
        
    }

    public function changeCustomerStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $customer = \App\Customer::findOrFail($id);
        $customer->IsActive = $status;
        if($status){
            $message = 'Customer successfully Active';
        } else {
            $message = 'Customer successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }

  




   
}
