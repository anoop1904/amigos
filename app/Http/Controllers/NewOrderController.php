<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\KitchenFood;
use App\Order;
use App\OrderDetail;
use App\Student;
use App\School;
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
use Carbon\Carbon;
//use Illuminate\Support\Facades\Hash;

class  NewOrderController extends Controller
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
        //In case of vendor need to show the order item

      $orders =Order::where('order_status',0);
       if(Auth::user()->user_type != 1){
       $orders=$orders->where('vendor_id',Auth::user()->id);
       // get school list
        $schools=SchoolVendorMapping::with('school_list')->where('vendor_id',Auth::user()->id)->get();
        foreach ($schools as $key => $value) {
          $value['name']=$value->school_list->name;
          $value['id']=$value->school_list->id;
          $schoolList[$key]=$value;
        }
        
       } 
       else
       {
         // get school list
         $schoolList=School::where('status',1)->get();
       }
        $con=array();
        $schoolcon=array();
        $start='';
        if(isset($_GET['school']))
        {
          if($_GET['school']!='all')
          {
            $orders->where('student.school_id', '=', $_GET['school']);
          }
          
        }
        if(isset($_GET['vendor']))
        {
          if($_GET['vendor']!='all')
          {
            $con['vendor_id']=$_GET['vendor'];
           
          }
           
        }
        if(isset($_GET['student']))
        {
          if($_GET['student']!='all')
          {
           $con['user_id']=$_GET['student'];
           
          }

        }
        
        if(isset($_GET['date']))
        {
          if($_GET['date']!='')
          {
             $start =$_GET['date'];
             $orders->whereDate('orders.created_at', '=', $start);
          }
           
        }
        if(isset($_GET['date_filter']))
        {
          if($_GET['date_filter']!='')
          {
            $start ='s';
            if($_GET['date']=='')
            {

              $date_filter =explode('-', $_GET['date_filter']);
              $from_date=date('Y-m-d'.' 23:59:59',strtotime(trim($date_filter[0])));
               $to_date=date('Y-m-d'.' 23:59:59',strtotime(trim($date_filter[1])));
              $orders->whereBetween('orders.created_at', [$from_date, $to_date]);
            }
          }

         }
         if(isset($_GET['shortby']))
          {
            $orders->orderBy('orders.created_at',$_GET['shortby']);
          }
          else
          {
            $orders->orderBy('orders.id','DESC'); 
          }
          if($start=='')
          {
           $orders->whereDate('orders.created_at', '=', date('Y-m-d')); 
          }
         $orders=$orders->Join('student', 'orders.user_id', '=', 'student.id')
         ->Join('school_info', 'student.school_id', '=', 'school_info.id')
         ->Join('users', 'orders.vendor_id', '=', 'users.id')
         ->select('student.name as student_name','users.name as user_name','school_info.name as school_name','student.mobile_number', 'orders.*')->where($con)->groupBy('orders.school_id')->paginate(20);

          // get student list
          $studentList=Student::where('status',1)->get();
          // get vendor list
          $vendorList=User::where('user_type',config('constants.VENDOR'))->get();
        
          $pagetitle='New Order';
         return view('order.neworder',compact('orders','vendorList','studentList','schoolList','pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {

    //     if(Auth::user()->RoleID !== 0) return view('errors.401');

    //     $order = Order::findOrFail($id);

    //     $order['order_items']=OrderDetail::where('order_id',$id)->get();

    //     return view('order.show ',compact('order'));
      
    // }

  // get order details
   public function orderdetail(Request $request)
    {
      $orderid=$request->id;
      $orders=OrderDetail::with(['item_detail'])->where('order_id',$orderid)->get();
      $data['orderdetail']=$orders;
      return response()->json($data);
      
    }
    
   
}
