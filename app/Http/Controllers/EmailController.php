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
use Validator;
//use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
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
        
        $offers= $customer->get();
        $stores = \App\Store::where('IsActive','1')->get();
        $pagetitle='Offer Management';
        // foreach ($offers as $key => $value) {
        //     print_r($value->getMetaAttribute());
        // }
        // dd($offers);
        return view('email_template.index',compact('offers','pagetitle','stores'));
    }

    public function create()
    {
        $pagetitle='Offer Create';
        $stores = \App\Store::where('IsActive','1')->get();
        return view('offer.create',compact('pagetitle','stores'));
    }


   public function edit($id)
    {
     $offer = \App\Offer::findOrFail($id);
     $stores = \App\Store::where('IsActive','1')->get(); 
     $pagetitle='Banner Edit';
     return view('offer.create',compact('offer','pagetitle','stores')); 
    }

   public function store(Request $request)
    {
       // return $request;
        date_default_timezone_set("Asia/Kolkata");
        $this->validate($request, [
            'coupon'=>'required|max:120',
        ]);

        // dd($request->all());
        $offer = new \App\Offer(); 
        $offer->coupon = $request->coupon;
        $offer->from_date = date('Y-m-d H:i',strtotime($request->from_date));
        $offer->to_date = date('Y-m-d H:i',strtotime($request->to_date));
        $offer->min_amount = $request->min_amount;
        $offer->max_amount = $request->max_amount;
        $offer->store_ids = implode(',', $request->store);
        
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
        $offer->coupon = $request->coupon;
        $offer->from_date = date('Y-m-d H:i',strtotime($request->from_date));
        $offer->to_date = date('Y-m-d H:i',strtotime($request->to_date));
        $offer->min_amount = $request->min_amount;
        $offer->max_amount = $request->max_amount;
        $offer->store_ids = implode(',', $request->store);

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




   
}
