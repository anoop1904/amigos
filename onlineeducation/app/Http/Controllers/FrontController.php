<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\School;
use App\KitchenFood;
use App\SchoolVendorMapping;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class FrontController extends Controller
{
   
    
    
    public function index(Request $request)
    {
        
        $school = School::get();
        if($studentId = Auth::guard('student')->user())
        {
            $users =array();
            $kitchenFood=$this->getMenuUser();
            $vendors = SchoolVendorMapping::with('vendors')->where('school_id',Auth::guard('student')->user()->school_id)->get();
             foreach ($vendors as $key => $vendor) {
              $users[]=$vendor->vendors[0];
             }
             
        }
        else
        {
            $users = User::where('user_type',config('constants.VENDOR'))->get();
            $kitchenFood = KitchenFood::with(['vendor'])->get();
            if($request->has('vendor') && $request->has('school'))
            {
              $con=array();
              if($request->school!='all')
              {
                $con['school_info.id']=$request->school;
              }
              if($request->vendor!='')
              {
                $con['vendorId']=$request->vendor;
              }
              $kitchenFood = KitchenFood::select('kitchen_food_items.name','kitchen_food_items.price','kitchen_food_items.image')

                                ->join('users','users.id','=','kitchen_food_items.vendorId')
                                 ->join('school_vendor_mapping','users.id','=','school_vendor_mapping.vendor_id')
                                 ->where($con)
                                 ->join('school_info','school_info.id','=','school_vendor_mapping.school_id')
                                 ->orderBy('kitchen_food_items.id','DESC')->get();

             }elseif($request->has('vendor'))
               {
                 $kitchenFood = KitchenFood::where('vendorId',$request->vendor)->orderBy('id','DESC')->get();
               } elseif($request->has('school'))
                {
                  $kitchenFood = KitchenFood::select('kitchen_food_items.name','kitchen_food_items.price','kitchen_food_items.image')
                                ->join('users','users.id','=','kitchen_food_items.vendorId')
                                 ->join('school_vendor_mapping','users.id','=','school_vendor_mapping.vendor_id')
                                 // ->join('school_vendor_mapping','users.id','=','school_vendor_mapping.vendor_id')
                                 ->join('school_info','school_info.id','=','school_vendor_mapping.school_id')
                                 ->where('school_info.id',$request->school)
                                 ->orderBy('kitchen_food_items.id','DESC')
                                 ->get();
                        // return $kitchenFood;
                 }


         }

          


         if ($request->ajax()) {
          
           
          return view('homefilter',compact('kitchenFood','users','school'));
         }

        return view('home',compact('kitchenFood','users','school'));
    }

public function getMenuUser()
{
       $userId = Auth::guard('student')->user()->id;
       $api = new ApiController;
       try{
            $student = Student::with(['plan_name'])->where('id',$userId)->firstOrFail();
            // return response()->json($student);
            $ids=[];
            $ids = $api->getVendors($student->school_id);
            
            // return $ids;
            $final = array();
            if(count($ids) && !empty($ids)){   
                $subscription = new SubscriptionController;
                // return "manish"; 
                
                $sessionData = $subscription->createChargeSession($student->id);
                // return response()->json($res = ['set_attributes'=>['registered_user'=>"FALSE",'message'=>$sessionData]]); 
                if($sessionData['status']){
                    $session_id = $sessionData['session_id'];
                    $handle = $sessionData['handle'];
                }
                $items = KitchenFood::with('vendor')->whereIn('vendorId',$ids)->get();
                // return $items;
                $menu_list = [];
                foreach ($items as $key => $value) {
                    $user_id = $student->id;
                    $item_id = $value->id;
                    $web_url = '';
                    if($sessionData['status']){
                        $web_url = URL('/')."/onetime_web_view?user_id=".$user_id."&item_id=".$item_id."&session_id=".$session_id."&handle=".$handle;
                    }
                    

                    if($student->plan_name){
                        // echo "string".$value->price .' : '. $student->plan_name->max_amount_per_meal;
                        if((int)$value->price <= (int)$student->plan_name->max_amount_per_meal){
                        // echo "inside"; 
                            $value->image = $value->image;     
                            $value->menu_item_status = 'FREE';
                            $menu_list[] = $value;
                        }else{
                            // $list['buttons'] = [[
                            //     "set_attributes"=>[
                            //         "menu_item_id"=>$value->id,
                            //         "menu_item_name"=>$value->name,
                            //         "menu_item_status"=>'PAID',
                            //     ],
                            //     "type"=>"web_url",
                            //     "url"=>$web_url,
                            //     'title' => "Pay"
                            // ]];
                        }
                    }else{
                        // $list['buttons'] = [[
                        //     "set_attributes"=>[
                        //         "menu_item_id"=>$value->id,
                        //         "menu_item_name"=>$value->name,
                        //         "menu_item_status"=>'PAID',
                        //     ],
                        //     "type"=>"web_url",
                        //     "url"=>$web_url,
                        //     'title' => "Pay"
                        // ]];
                    }
                    // $final[]=$list;
                }
            }else{  
              return $menu_list =array(); 
            }
            if(!empty($menu_list)){
                return $menu_list; 
            }else{
            return $menu_list =array(); 
            }
            
        }catch (ModelNotFoundException $ex) {  
          return $menu_list =array();      
                
        }   
}

   
}
