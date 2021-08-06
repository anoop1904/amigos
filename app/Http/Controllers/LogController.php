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

class LogController extends Controller
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

        // get vendor list
        $logs=\App\Log::get();
        $pagetitle='Logs Detail';
        return view('log.index',compact('logs'));
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
            'price'=>'required|max:120',
            'internal_price'=>'required|max:120',
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
    public function cancelAgreementAll(){
        $logs=\App\Log::get();
        echo count($logs).'<br/>';
        // die;
        $totalCancelCount=0;
        $totalSubscribtion = 0;
        foreach ($logs as $value){
        $payload = json_decode($value->payload,true);
            if($payload['status'] == 'Canceled'){
                $totalCancelCount++;
               $aagreemen_id = $payload['id'];

                $subscription_existed=\App\Subscription::where(['agreement_id'=>$aagreemen_id])->first();
                // dd($subscription_existed);
                if($subscription_existed){
                    $totalSubscribtion++;
                    $student=\App\Student::where(['id'=>$subscription_existed->student_id])->first();
                    if($student){
                        $student->plan_start_date = null;
                        $student->plan_expiry_date = null;
                        $student->current_order = 0;
                        $student->plan_id = null;
                        $student->save();
                    }
                    // $referral = \App\Referral::where(['referred_to'=>$subscription_existed->student_id])->first();
                    // if($referral){
                    //     $referral->approval_status = 2;
                    //     $referral->save();
                    // }

                    $subscription_existed->next_period_start = '';
                    $subscription_existed->subscription_status = 'Canceled';
                    $subscription_existed->deleted_at = date('Y-m-d H:i:s');
                    $subscription_existed->save();

                }
            }
        }
        echo "Total totalCancelCount = ".$totalCancelCount.'<br/>';
        echo "Total total Subscription = ".$totalSubscribtion.'<br/>';
    }
    public function cancelAgreementData($id)
    {
        // echo $id;
        // $aagreemen_id = $id;
        // $subscription_existed=\App\Subscription::where(['agreement_id'=>$aagreemen_id])->first();
        // dd($subscription_existed);
        // dd($id);
         try{
            $aagreemen_id = $id;

            $subscription_existed=\App\Subscription::where(['agreement_id'=>$aagreemen_id])->first();
            // dd($subscription_existed);
            if($subscription_existed){
                $student=\App\Student::where(['id'=>$subscription_existed->student_id])->first();
                if($student){
                    $student->plan_start_date = null;
                    $student->plan_expiry_date = null;
                    $student->current_order = 0;
                    $student->plan_id = null;
                    $student->save();
                }
                // $referral = \App\Referral::where(['referred_to'=>$subscription_existed->student_id])->first();
                // if($referral){
                //     $referral->approval_status = 2;
                //     $referral->save();
                // }

                $subscription_existed->next_period_start = '';
                $subscription_existed->subscription_status = 'Canceled';
                $subscription_existed->deleted_at = date('Y-m-d H:i:s');
                $subscription_existed->save();

            }
         } catch (ModelNotFoundException $ex) {  
          // return response()->json(['set_attributes'=>["subscription_status"=>"TRUE"]]);
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
          return redirect()->route('log.index')
            ->with('message',
             'not found.');
        }

        return redirect()->route('log.index')
            ->with('message',
             'Log successfully edited.');
      
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
