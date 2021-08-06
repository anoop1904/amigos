<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertise;
use App\Client;
use App\Location;
use App\Schedule;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function __construct()
    {
       // $this->middleware(['auth', 'clearance']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    


    public function getAdvertise(Request $request){
      $data= $request->all();
      $advertiseResult   = Advertise::with(['client','location'])->where('client_id',$data['id'])->get()->toArray();
      $response['advertise']=$advertiseResult;
      echo json_encode($response);

    }

public function getClientByLocation(Request $request){
      $data= $request->all();
      $con = array();
      $response = array();
      if(isset($data['advertiseId'])){
        if($data['advertiseId'] !='0'){
          $con['id']=$data['advertiseId'];  
        }
      }

      if(isset($data['locationId'])){
        if($data['locationId'] !='0'){
          $con['location_id']=$data['locationId'];  
        }
      }
      
      $advertiseResult   = Advertise::with(['client','location'])->where($con)->get()->toArray();
      $response['advertise']=$advertiseResult;
      echo json_encode($response);

}

 public function changeLocation(Request $request){
  $data= $request->all();
  if($data['locationId'] == '0'){
    $advertiseResult   = Advertise::with(['client'])->get()->toArray();
  }else{
    $advertiseResult   = Advertise::with(['client'])->where('location_id',$data['locationId'])->get()->toArray();  
  }
  
  $response['advertise']=$advertiseResult;
  echo json_encode($response);

}
    public function getlocation(Request $request){
      $data= $request->all();
      $advertiseResult   = Advertise::with(['client','location'])->where('id',$data['advertiseId'])->get()->toArray();
      $response['advertise']=$advertiseResult;
      echo json_encode($response);

    }

public function index()
{
      $page_title='Report';
      $clients = Client::all();
      $search = '';
      $condition = array();
      $condition['schedules.IsActive']='1';
      //$condition['schedules.client_id']='1';
      if( isset($_REQUEST['client'])){
        if( $_REQUEST['client']!='' && $_REQUEST['client']!='0'){
            $advertises = Advertise::with(['client','location'])->where('client_id',$_REQUEST['client'])->get();
            $condition['schedules.client_id']=$_REQUEST['client'];
          }
      }else{
          $advertises = Advertise::with(['client','location'])->get();
      }

      if( isset($_REQUEST['advertise'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            $condition['schedules.advertise_id']=$_REQUEST['advertise'];
          }
      }
     

      $from = $to ='';
      if( isset($_REQUEST['startDate'])){
          if( $_REQUEST['startDate']!='' && $_REQUEST['startDate']!='0'){
              //$condition['schedules.fromDate']=$_REQUEST['startDate'];
              $from = date('Y-m-d',strtotime($_REQUEST['startDate']));
            }
            $to = date('Y-m-d');
      }
      if( isset($_REQUEST['toDate'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            //$condition['schedules.toDate']=$_REQUEST['toDate'];
            $to = date('Y-m-d',strtotime($_REQUEST['toDate']));
          }
          if($from==''){
              $from = date('Y-m-d');    
          }         
      }


      // $schedules = Schedule::with(['advertise','client',"advertise.location"])-> whereHas('client', function($query) use ($search){
      //         $query->where('fname','LIKE',$search.'%');
      //     })->orWhereHas('advertise', function($query) use ($search){
      //         $query->where('advertise_name','LIKE',$search.'%');
      //     })->orWhereHas('advertise.location', function($query) use ($search){
      //         $query->where('screen_name','LIKE',$search.'%');
      //     })->where($condition)->orderBy('created_at', 'DESC')->get();


      //$from = date('2018-12-10');

      if($from!='' && $to != ''){
      $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->whereBetween('fromDate', [$from, $to])->orderBy('created_at', 'DESC')->get();
      }else{
          $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->orderBy('created_at', 'DESC')->get();
      } 
      return redirect('admin/clientWiseReport');
      //return view('report.create', compact('advertises','clients','schedules','page_title'));
}


public function clientWiseReport()
{
      $page_title="Client Report";
      $clients = Client::all();
      $search = '';
      $condition = array();
      $condition['schedules.IsActive']='1';
      //$locationCondition['IsActive']='1';
      $locationCondition['advertises.IsActive']=1;
      //$condition['schedules.client_id']='1';
      if( isset($_REQUEST['client'])){
        if( $_REQUEST['client']!='' && $_REQUEST['client']!='0'){
            $locationCondition['advertises.client_id']=$_REQUEST['client'];
            $condition['schedules.client_id']=$_REQUEST['client'];
          }
      }

      if( isset($_REQUEST['advertise'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            $condition['schedules.advertise_id']=$_REQUEST['advertise'];
          }
      }
      if( isset($_REQUEST['location'])){
        if( $_REQUEST['location']!='' && $_REQUEST['location']!='0'){
            //$condition['schedules.location_id']=$_REQUEST['location'];
            $locationCondition['advertises.location_id']=$_REQUEST['location'];
            $condition['schedules.location_id']=$_REQUEST['location'];
          }
      }
      $from = $to ='';
      if( isset($_REQUEST['startDate'])){
          if( $_REQUEST['startDate']!='' && $_REQUEST['startDate']!='0'){
              $from = date('Y-m-d',strtotime($_REQUEST['startDate']));
              $to = date('Y-m-d');
            }
      }
      if( isset($_REQUEST['endDate'])){
        if( $_REQUEST['endDate']!='' && $_REQUEST['endDate']!='0'){
            //$condition['schedules.toDate']=$_REQUEST['toDate'];
            $to = date('Y-m-d',strtotime($_REQUEST['endDate']));
            if($from==''){
              $from = date('Y-m-d');    
            } 
          }
                  
      }

   
//$advertises = Advertise::with(['client','location'])->where($locationCondition)->get()->groupBy('advertises.advertise_name');
$advertises = Advertise::with(['client','location'])->where($locationCondition)->get();
//dd($advertises);
      if($from!='' && $to != ''){
        $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->where(function ($query) use ($from,$to) {
          $query->whereBetween('fromDate', [$from, $to]);
          $query->orWhereBetween('toDate', [$from, $to]);
        })->orderBy('created_at', 'DESC')->get();
      }else{
          $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->orderBy('created_at', 'DESC')->get();
      } 
      return view('report.clientWiseReport', compact('advertises','clients','schedules','page_title'));
}

public function locationWiseReport()
{
      $page_title="Location Report";
      //$clients = Client::all();
      $locations = Location::all();
      $search = '';
      $condition = array();
      $condition['schedules.IsActive']='1';
      $locationCondition['advertises.IsActive']='1';
      //$condition['schedules.client_id']='1';


      if( isset($_REQUEST['location'])){
        if( $_REQUEST['location']!='' && $_REQUEST['location']!='0'){            
            $locationCondition['advertises.location_id']=$_REQUEST['location'];
            $condition['schedules.client_id']=$_REQUEST['location'];
          }
      }


      if( isset($_REQUEST['client'])){
        if( $_REQUEST['client']!='' && $_REQUEST['client']!='0'){
            $locationCondition['advertises.client_id']=$_REQUEST['client'];
            $condition['schedules.client_id']=$_REQUEST['client'];
          }
      }

      if( isset($_REQUEST['advertise'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            $condition['schedules.advertise_id']=$_REQUEST['advertise'];
          }
      }

      $from = $to ='';
      if( isset($_REQUEST['startDate'])){
          if( $_REQUEST['startDate']!='' && $_REQUEST['startDate']!='0'){
              //$condition['schedules.fromDate']=$_REQUEST['startDate'];
              $from = date('Y-m-d',strtotime($_REQUEST['startDate']));
            }
            $to = date('Y-m-d');
      }
      if( isset($_REQUEST['toDate'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            //$condition['schedules.toDate']=$_REQUEST['toDate'];
            $to = date('Y-m-d',strtotime($_REQUEST['toDate']));
          }
          if($from==''){
              $from = date('Y-m-d');    
          }         
      }

      $advertises = Advertise::with(['client','location'])->where($locationCondition)->get();
      if($from!='' && $to != ''){
          $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->whereBetween('fromDate', [$from, $to])->orderBy('created_at', 'DESC')->get();
      }else{
          $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->orderBy('created_at', 'DESC')->get();
      } 
      return view('report.locationWiseReport', compact('advertises','schedules','page_title','locations'));
}

public function advertiseWiseReport()
{
      $page_title="Advertise Report";
      $clients = Client::all();
      $search = '';
      $condition = array();
      $condition['schedules.IsActive']='1';
      //$condition['schedules.client_id']='1';
      if( isset($_REQUEST['client'])){
        if( $_REQUEST['client']!='' && $_REQUEST['client']!='0'){
            $advertises = Advertise::with(['client','location'])->where('client_id',$_REQUEST['client'])->get();
            $condition['schedules.client_id']=$_REQUEST['client'];
          }
      }else{
          $advertises = Advertise::with(['client','location'])->get();
      }

      if( isset($_REQUEST['advertise'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            $condition['schedules.advertise_id']=$_REQUEST['advertise'];
          }
      }

      $from = $to ='';
      if( isset($_REQUEST['startDate'])){
          if( $_REQUEST['startDate']!='' && $_REQUEST['startDate']!='0'){
              //$condition['schedules.fromDate']=$_REQUEST['startDate'];
              $from = date('Y-m-d',strtotime($_REQUEST['startDate']));
            }
            $to = date('Y-m-d');
      }
      if( isset($_REQUEST['toDate'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            //$condition['schedules.toDate']=$_REQUEST['toDate'];
            $to = date('Y-m-d',strtotime($_REQUEST['toDate']));
          }
          if($from==''){
              $from = date('Y-m-d');    
          }         
      }


      // $schedules = Schedule::with(['advertise','client',"advertise.location"])-> whereHas('client', function($query) use ($search){
      //         $query->where('fname','LIKE',$search.'%');
      //     })->orWhereHas('advertise', function($query) use ($search){
      //         $query->where('advertise_name','LIKE',$search.'%');
      //     })->orWhereHas('advertise.location', function($query) use ($search){
      //         $query->where('screen_name','LIKE',$search.'%');
      //     })->where($condition)->orderBy('created_at', 'DESC')->get();


      //$from = date('2018-12-10');

      if($from!='' && $to != ''){
      $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->whereBetween('fromDate', [$from, $to])->orderBy('created_at', 'DESC')->get();
      }else{
          $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->orderBy('created_at', 'DESC')->get();
      } 
      return view('report.advertiseWiseReport', compact('advertises','clients','schedules','page_title'));
}

public function scheduleWiseReport()
{
      $page_title="Schedule Report";
      $clients = Client::all();
      $search = '';
      $condition = array();
      $condition['schedules.IsActive']='1';
      //$condition['schedules.client_id']='1';
      if( isset($_REQUEST['client'])){
        if( $_REQUEST['client']!='' && $_REQUEST['client']!='0'){
            $advertises = Advertise::with(['client','location'])->where('client_id',$_REQUEST['client'])->get();
            $condition['schedules.client_id']=$_REQUEST['client'];
          }
      }else{
          $advertises = Advertise::with(['client','location'])->get();
      }

      if( isset($_REQUEST['advertise'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            $condition['schedules.advertise_id']=$_REQUEST['advertise'];
          }
      }

      $from = $to ='';
      if( isset($_REQUEST['startDate'])){
          if( $_REQUEST['startDate']!='' && $_REQUEST['startDate']!='0'){
              //$condition['schedules.fromDate']=$_REQUEST['startDate'];
              $from = date('Y-m-d',strtotime($_REQUEST['startDate']));
            }
            $to = date('Y-m-d');
      }
      if( isset($_REQUEST['toDate'])){
        if( $_REQUEST['advertise']!='' && $_REQUEST['advertise']!='0'){
            //$condition['schedules.toDate']=$_REQUEST['toDate'];
            $to = date('Y-m-d',strtotime($_REQUEST['toDate']));
          }
          if($from==''){
              $from = date('Y-m-d');    
          }         
      }


      // $schedules = Schedule::with(['advertise','client',"advertise.location"])-> whereHas('client', function($query) use ($search){
      //         $query->where('fname','LIKE',$search.'%');
      //     })->orWhereHas('advertise', function($query) use ($search){
      //         $query->where('advertise_name','LIKE',$search.'%');
      //     })->orWhereHas('advertise.location', function($query) use ($search){
      //         $query->where('screen_name','LIKE',$search.'%');
      //     })->where($condition)->orderBy('created_at', 'DESC')->get();


      //$from = date('2018-12-10');

      if($from!='' && $to != ''){
      $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->whereBetween('fromDate', [$from, $to])->orderBy('created_at', 'DESC')->get();
      }else{
          $schedules = Schedule::with(['advertise','client',"advertise.location"])->where($condition)->orderBy('created_at', 'DESC')->get();
      } 
      return view('report.scheduleWiseReport', compact('advertises','clients','schedules','page_title'));
}

}
