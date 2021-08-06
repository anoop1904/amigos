<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use App\Category;
use App\Store;

use Validator;
use Illuminate\Support\Facades\DB; 

//use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
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
        $customer = \App\Store::with('checkcategory')->orderBy('id','DESC');;
        
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $customer->where('name','LIKE','%'.$_GET['name'].'%');
          }           
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
        
        $stores= $customer->paginate(20);
		
		//dd($stores);
        $pagetitle='Store Management';
        return view('store.index',compact('stores','pagetitle'));
    }

    public function create()
    {   
	    $category_ids=[];
        $pagetitle='Store Create';
        $categoryList=Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        //dd($categoryList);
        return view('store.create',compact('pagetitle','categoryList','category_ids'));
    }


   public function edit($id)
    {
     $store = \App\Store::findOrFail($id); 
     $pagetitle='Store Edit';	
	 $category_ids = \App\StoreCategoryMaping::where('store_id', $id)->pluck('category_id')->toArray();
     
     $categoryList=Category::where(['IsActive'=>1,'parent_id'=>0])->get();
     return view('store.create',compact('store','pagetitle','categoryList','category_ids')); 
    }

   public function store(Request $request)
    {
        //return $request->category;
        $this->validate($request, [
            'name'=>'required|max:120',
            'category'=>'required',
            'email'=>'required|email|unique:users',
            'mobile_number'=>'required|max:11|unique:tbl_store',
        ]);

            // dd($request->all());

          $usertype = $roles = 20; 
      
          $user = User::create([
              'user_type' =>$usertype,
              'name' =>$request->name,
              'email' =>$request->email,
              'Phone' =>$request->mobile_number,
              'password' => $request->password,
              'IsVerify' => '1',
              'Designation' =>'',
              'CreatedBy' =>Auth::user()->id
          ]);
         $code = 'u'.date('Y').$user->id;
         User::where('id',$user->id)->update(['user_code'=>$code]);
        
        if (isset($roles)) {
            $role_r = Role::where('id', '=', $roles)->firstOrFail();            
            $user->assignRole($role_r);
        }   

        $store = new \App\Store(); 
        $store->name = $request->name;
        $store->email = $request->email;
        $store->user_id =$user->id;
        $store->user_type = $usertype;
        $store->mobile_number = $request->mobile_number;
        $store->zipcode = $request->zipcode;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;
        $store->address = $request->address;
        $store->city = $request->city;
        $store->ratting = $request->ratting;
        $store->store_id = getRandomNumber();
        
        if($request->hasFile('file')) {
        $image = $request->file('file');
        if($image){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/store');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $store->image = $img;
        }
        }
		   $storelogo = $request->file('storelogo');
			if($storelogo) {
        if($storelogo){
            $input['imagename'] = uniqid().'.'.$storelogo->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/store');
            $storelogo->move($destinationPath, $input['imagename']);
            $img1=$input['imagename'];
            $store->storelogo = $img1;
        }
        } 
        
        $pan_card = $request->file('pan_card');
        if($pan_card) {
    if($pan_card){
        $input['imagename'] = uniqid().'.'.$pan_card->getClientOriginalExtension();
        $destinationPath = public_path('/assets/img/store');
        $pan_card->move($destinationPath, $input['imagename']);
        $img1=$input['imagename'];
        $store->pan_card = $img1; 
    }
    } 
		
	
		

 
        $flag = $store->save();
			//return $store;
		foreach($request->category as $value){
		$store_cate_maping = new \App\StoreCategoryMaping(); 
        $store_cate_maping->store_id = $store->id;
        $store_cate_maping->category_id = $value;
		$store_cate_maping->save();
		}
		
        if($flag) {
            return redirect()->route('store.index')->with('message','Store Created successfully.');
        }else{
            return redirect()->route('store.index')->with('message','Action Failed Please try again.');
        }
    }

 public function update(Request $request, $id)
 {
        //return $request;
        $this->validate($request, [
            'name'=>'required|max:120',
            'category'=>'required',
            'email'=>'required|email|unique:tbl_store,email,'.$id,
            'mobile_number'=>'required|unique:tbl_store,mobile_number,'.$id,
        ]);

        $store = \App\Store::findOrFail($id); 
        $store->name = $request->name;
        $store->email = $request->email;
     
        $store->mobile_number = $request->mobile_number;
        $store->zipcode = $request->zipcode;
        $store->latitude = $request->latitude;
        $store->longitude = $request->longitude;
        $store->address = $request->address;
        $store->city = $request->city;
        $store->ratting = $request->ratting;
		
			
		$image = $request->file('file');
        $storelogo = $request->file('storelogo');
      
	  
        if($image) {
      
            if($image){
                $path = public_path('/assets/img/store/');  
            
                $input['imagename'] = uniqid().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/img/store/');
                $image->move($destinationPath, $input['imagename']);
                $img=$input['imagename'];
                $store->image = $img;
            }
        }
		
		if($storelogo) {
        if($storelogo){
            $input['imagename'] = uniqid().'.'.$storelogo->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/store');
            $storelogo->move($destinationPath, $input['imagename']);
            $img1=$input['imagename'];
            $store->storelogo = $img1;
        }
        }

        $pan_card = $request->file('pan_card');
        if($pan_card) {
    if($pan_card){
        $input['imagename'] = uniqid().'.'.$pan_card->getClientOriginalExtension();
        $destinationPath = public_path('/assets/img/store');
        $pan_card->move($destinationPath, $input['imagename']);
        $img1=$input['imagename'];
        $store->pan_card = $img1; 
    }
    }

    $aadhar_card_front = $request->file('aadhar_card_front');
    if($aadhar_card_front) {
    if($aadhar_card_front){
    $input['imagename'] = uniqid().'.'.$aadhar_card_front->getClientOriginalExtension();
    $destinationPath = public_path('/assets/img/store');
    $aadhar_card_front->move($destinationPath, $input['imagename']);
    $img1=$input['imagename'];
    $store->aadhar_front = $img1; 
    }
    } 

    $aadhar_card_back = $request->file('aadhar_card_back');
    if($aadhar_card_back) {
    if($aadhar_card_back){
    $input['imagename'] = uniqid().'.'.$aadhar_card_back->getClientOriginalExtension();
    $destinationPath = public_path('/assets/img/store');
    $aadhar_card_back->move($destinationPath, $input['imagename']);
    $img1=$input['imagename'];
    $store->aadhar_back = $img1; 
    }
    } 




        $flag = $store->save();
		DB::table('tbl_store_category_maping')->where('store_id', $store->id)->delete();
		
	
		foreach($request->category as $value){
		$store_cate_maping = new \App\StoreCategoryMaping(); 
        $store_cate_maping->store_id = $store->id;
        $store_cate_maping->category_id = $value;
		$store_cate_maping->save();
		}
			//return $request->category;
		
        if($flag) {
            return redirect()->route('store.index')->with('message','Store Update successfully.');
        }else{
            return redirect()->route('store.index')->with('message','Action Failed Please try again.');
        }
    }
   

   public function destroy($id)
    {
        $store = \App\Store::findOrFail($id);
        $delete = $store->delete();
        if(isset($delete)) {
        return redirect()->route('store.index')
            ->with('message',
             'Store successfully Deleted.');
        }else{
            return redirect()->route('store.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function storeStatus($id, $key)
    {
        $store = \App\Store::findOrFail($id);
        if($key === 'active'){
            $customer->status = 1;
            $message = 'Store successfully Active';

        }
        if($key === 'deactive'){
            $customer->status = 0;
             $message = 'Store successfully Deactive';
        }
        $flag = $store->save();
        if($flag){
            return redirect()->route('store.index')->with('message',$message);
        }else{
            return redirect()->route('store.index')->with('message','Operation failed please try again.');
        }
        
    }

    public function changeStoreStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $store = \App\Store::findOrFail($id);
        $store->IsActive = $status;
        if($status){
            $message = 'Store successfully Active';
        } else {
             $message = 'Store successfully Deactive';
        }
        $flag = $store->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
	
	public function paymentLink(Request $request){
	
		$id= $request->storeid;
		
		$store = \App\Store::findOrFail($id); 
        $store->payment_method = $request->payment_method;
        $store->payment_link = $request->payment_link;
		
		$flag = $store->save();
        if($flag){
			  $message = 'Link Send successfully';
         return redirect()->route('store.index')->with('message',$message);
        }else{
	      return redirect()->route('store.index')->with('message','Operation failed please try again.');
        }
		
	} 
    
	public function paymentDetails(Request $request){
	
		$store_id= $request->Paymetn_storeid;
		$store1 = \App\Store::where(['id'=>$store_id])->first();
        $plain_id = $store1->plain_id;	
       	
		
		$flag = DB::table('subscription')
                ->where('store_id', $store_id)
				->where('plan_id',$plain_id)
                ->update(['payment_method' =>$request->payment_method,
				'payment_amount'=>$request->payment_amount,
				'payment_date'=>$request->payment_date,
				'desctiption'=>$request->desctiption]);
				
        if($flag){
			  $message = 'Payment Detail Update successfully';
         return redirect()->route('store.index')->with('message',$message);
        }else{
	      return redirect()->route('store.index')->with('message','Operation failed please try again.');
        }
		
    }

    public function docVerified(Request $request){
       $flag=Store::where('id',$request->store_id)->update(['isDocumentApprove'=>1]);
       if($flag){ 
        $message = 'Document Aprove successfully';
   return redirect()->route('store.index')->with('message',$message);
  }else{
    return redirect()->route('store.index')->with('message','Operation failed please try again.');
  }


    }



   
}
