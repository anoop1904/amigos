<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
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

class OfferController extends Controller
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
        $customer = \App\Offer::orderBy('id','DESC');
        
        if(isset($_GET['coupon']))
        {
          if($_GET['coupon']!='')
          {
           $customer->where('coupon','LIKE','%'.$_GET['coupon'].'%');
          }           
        }
		
		  if(isset($_GET['date_filter']))
        {
          if($_GET['date_filter']!='')
          { //return $_GET['date_filter'];
			 $date_filter =explode('-', $_GET['date_filter']);
             $from_date=date('Y-m-d',strtotime(trim($date_filter[0])));
             $to_date=date('Y-m-d',strtotime(trim($date_filter[1])));
             $customer->whereBetween('created_at', [$from_date, $to_date]);
			 
          }
        } 
		
		  if(isset($_GET['date']))
        {
          if($_GET['date']!='')
          { //return $_GET['date'];
	  //->whereDate('eodata', Carbon::today()->toDateString());
             $customer->whereDate('created_at','=',$_GET['date']);
          }
        } 
		
			
        if(isset($_GET['status']))
        {
          if($_GET['status']!='all')
          {
             $customer->where('IsActive',$_GET['status']);
          }
        } 
		
		
        
        $offers= $customer->get();
        $stores = \App\Store::where('IsActive','1')->get();
        $pagetitle='Offer Management';
        // foreach ($offers as $key => $value) {
        //     print_r($value->getMetaAttribute());
        // }
        // dd($offers);
        return view('offer.index',compact('offers','pagetitle','stores'));
    }

    public function create()
    {
        $pagetitle='Offer Create';
        $stores = array();
        return view('offer.create',compact('pagetitle','stores'));
    }


   public function edit($id)
    {
     $offer = \App\Offer::findOrFail($id);
     $stores = \App\Store::where('IsActive','1')->get(); 
     $pagetitle='Offer Edit';
     return view('offer.create',compact('offer','pagetitle','stores')); 
    }

   public function store(Request $request)
    {
        //return $request;
        date_default_timezone_set("Asia/Kolkata");
        $this->validate($request, [
            'coupon'=>'required|max:120|unique:tbl_offer',
        ]);
        $image = $request->file('file');
        $img = '';
        if($image){
            $img = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/offer');
            $image->move($destinationPath, $img);
        }
        // dd($request->all());
        $offer = new \App\Offer(); 
        $offer->coupon = $request->coupon;
		
		$offer->coupon_type = $request->coupon_type;
        if($request->coupon_type==1){
            $offer->store_ids =implode(',', $request->store_product);
        }else{
            $offer->store_ids ='';
        }
		$offer->discount_type = $request->discount_type;
		$offer->discount_amount = $request->discount_amount;
		$offer->description = $request->editor1;
    $offer->image = $img;
		
        $offer->from_date = date('Y-m-d H:i',strtotime($request->from_date));
        $offer->to_date = date('Y-m-d H:i',strtotime($request->to_date));
        $offer->min_amount = $request->min_amount;
        $offer->max_amount = $request->max_amount;
        //$offer->store_ids = implode(',', $request->store);
        
         $flag = $offer->save();

        if($flag) {
            return redirect()->route('offer.index')->with('message','Offer Created successfully.');
        }else{
            return redirect()->route('offer.index')->with('message','Action Failed Please try again.');
        }
    }

 public function update(Request $request, $id)
 {
        //return $request;
        $this->validate($request, [
            'coupon'=>'required|max:120',
        ]);
        // dd($request->all());
        $offer = \App\Offer::findOrFail($id); 
        $image = $request->file('file');
        $path = public_path('/assets/img/offer/');  
        if($image){
        
             if($offer->image)
             {
               unlink($path.$offer->image);
             }
             $img = uniqid().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/assets/img/offer');
             $image->move($destinationPath, $img);

             $offer->image=$img;
        }  
        $offer->coupon = $request->coupon;
		    $offer->coupon_type = $request->coupon_type;
        $offer->from_date = date('Y-m-d H:i',strtotime($request->from_date));
        $offer->to_date = date('Y-m-d H:i',strtotime($request->to_date));
        $offer->min_amount = $request->min_amount;
        $offer->max_amount = $request->max_amount;

        $offer->discount_type = $request->discount_type;
		    $offer->discount_amount = $request->discount_amount;
        $offer->description = $request->editor1;
        
		    if($request->coupon_type==1){
            $offer->store_ids =implode(',', $request->store_product);
        }else{
            $offer->store_ids ='';
        }
        $flag = $offer->save();
        if($flag) {
            return redirect()->route('offer.index')->with('message','Offer Update successfully.');
        }else{
            return redirect()->route('offer.index')->with('message','Action Failed Please try again.');
        }
    }
   

       public function destroy($id)
    {
        $banner = \App\Offer::findOrFail($id);
        $delete = $banner->delete();
        if(isset($delete)) {
        return redirect()->route('offer.index')
            ->with('message',
             'Offer successfully Deleted.');
        }else{
            return redirect()->route('offer.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }


    public function changeOfferStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $banner = \App\Offer::findOrFail($id);
        $banner->IsActive = $status;
        if($status){
            $message = 'Offer successfully Active';
        } else {
             $message = 'Offer successfully Deactive';
        }
        $flag = $banner->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
	
	public function getStore(Request $request)
    {
        $cid = $request->cid;
		if($cid==1){
		$products = \App\Store::where(['IsActive'=>1])->get();	
		}else{
		$products = \App\Product::where(['IsActive'=>1])->get();	
		}
        
        $htm = '';    
		
       // $htm .= '<option value="" selected="" disabled="">Select Store</option>';
        foreach ($products as $key => $value) {
            $htm .= "<option value=".$value->id.">".$value->name."</option>";
        }
        echo json_encode(['status'=>true,'result'=>$htm]);
     
    }




   
}
