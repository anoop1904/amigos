<?php
function singledata($table,$colo,$val) {

$data = \DB::table($table)
        ->where($colo, $val)
        ->first();
    return $data;

}
function multipledata($table,$condition) {

$data = \DB::table($table)
        ->where($condition)
        ->get();
    return $data;

}

// get order start and end time
function getOrderTime($school_id)
{
     $time = \DB::table('school_info')
      ->where('id', $school_id)
      ->select(\DB::raw('start_order_time,last_order_time'))
      ->first();
      return $time;
}

// get order status
function getOrderStatus($key)
{
  //0=Pending,1=Approve,2=Canceled,3=Delivered
  $statusList=array(1=>'Pending',2=>'Preparing',3=>'Picked',4=>'Canceled',5=>'Delivered',6=>'Delayed');
 return $statusList[$key];
}

// get order status
function getMonthName($key)
{
  //0=Pending,1=Approve,2=Canceled,3=Delivered
  $statusList=array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
 return $statusList[$key];
}
// get use order items
function getUserOrderItems($order_id)
{
  
   $itemarray=array();
   $ordersdetail = \DB::table('orders_detail')
    ->where(['order_id'=>$order_id])
    ->get();
    foreach ($ordersdetail as $key => $value)
    {
      $itemname = \DB::table('kitchen_food_items')
      ->where('id', $value->order_item)
      ->select(\DB::raw('name,price,description,image'))
      ->first();
      array_push($itemarray, $itemname);
    }
 return $itemarray;
}
// get total items according school
function getTotalItems($data,$date) {
   $temparray=array();
       $itemarray=array();
  foreach ($data as $value) {
      $orderlist = \DB::table('orders')
        ->where(['vendor_id'=>$value->vendor_id,'school_id'=>$value->school_id,'order_status'=>0])
        ->whereDate('created_at', '=', $date)
        ->get();
        foreach ($orderlist as  $order) 
        {
           $ordersdetail = \DB::table('orders_detail')
              ->where(['order_id'=>$order->id])
              ->whereDate('created_at', '=', $date)
              ->get();
              foreach ($ordersdetail as $key => $value) {
                $itemname = \DB::table('kitchen_food_items')
            ->where('id', $value->order_item)
            ->select(\DB::raw('name'))
            ->first();
            if (array_key_exists($itemname->name, $temparray))
            {
               $temparray[$itemname->name]=$temparray[$itemname->name]+$value->quantity;
            }
            else
            {
              $temparray[$itemname->name]=$value->quantity;
            }
           
              }
        }
  }
  $total=0;
  foreach ($temparray as $key => $value) 
    {
      $total=$total+$value;
    }
    echo $total;
  }
// get order items according school
function getOrderItems($vendor_id,$school_id,$date) {
$orderlist = \DB::table('orders')
        ->where(['vendor_id'=>$vendor_id,'school_id'=>$school_id,'order_status'=>0])
        ->whereDate('created_at', '=', $date)
        ->get();
       $temparray=array();
       $itemarray=array();
        foreach ($orderlist as  $order) 
        {
        	 $ordersdetail = \DB::table('orders_detail')
              ->where(['order_id'=>$order->id])
              ->whereDate('created_at', '=', $date)
              ->get();
              foreach ($ordersdetail as $key => $value) {
              	$itemname = \DB::table('kitchen_food_items')
		        ->where('id', $value->order_item)
		        ->select(\DB::raw('name'))
		        ->first();
		        if (array_key_exists($itemname->name, $temparray))
		        {
		        	 $temparray[$itemname->name]=$temparray[$itemname->name]+$value->quantity;
		        }
		        else
		        {
		        	$temparray[$itemname->name]=$value->quantity;
		        }
		       
              }
        }
		foreach ($temparray as $key => $value) 
		{
      $span='<span class="label label-danger label-inline">'.$value.'</span>';
			array_push($itemarray, $span.' '.$key);
		}
		    return $itemarray;

}

// get total earning of student
function getTotalErning($student_id) {
$total=0;
$referredby=0;
$referredto=0;
// calculate total referred_by
        $referred_by = \DB::table('referred_map')
        ->where('referred_by', $student_id)
        ->select(\DB::raw('referred_by_credit,referred_to_credit'))
        ->get();
      if(!empty($referred_by))
        {
          foreach ($referred_by as  $value) 
          {
            $referredby=$referredby+$value->referred_by_credit; 
          }
          
        }
// calculate total referred_to
        $referred_to = \DB::table('referred_map')
        ->Where('referred_to', $student_id)
        ->select(\DB::raw('referred_by_credit,referred_to_credit'))
        ->get();
        if(!empty($referred_to))
        {
          foreach ($referred_to as  $value) 
          {
            $referredto=$referredto+$value->referred_to_credit; 
          }
  
        }
     $total=$referredby+$referredto;
     return $total;
}


// validate user plan
function getUserPlan($user_id)
{
    $plans = \DB::table('student')
            ->where('id', $user_id)
            ->select(\DB::raw('plan_id'))
            ->first();
    return $plans->plan_id;
}
// earning total
function getsubscriptionTotal()
{
    $total = \DB::table('subscription')
            ->where('created_at','!=','')
            ->whereNull('deleted_at')
            ->select(\DB::raw('SUM(price) as total'))
            ->first();
    return $total->total;
}
// subscription expired in this week
function getsubscriptionExpire()
{
   $startdate = date('Y-m-d'.' 23:59:59',strtotime('monday this week'));
   $enddate = date('Y-m-d'.' 23:59:59',strtotime("sunday this week"));      
   $list = \DB::table('subscription')
        ->whereBetween('next_period_start', [$startdate, $enddate])
        ->whereNull('deleted_at')
        ->select(\DB::raw('next_period_start'))
        ->get(); 
        return $list; 
}

// function for chartdata

function getChartData()
{
  $data=array();
  for ($m=1; $m<=12; $m++)
   {
      $month = date('M', mktime(0,0,0,$m, 1, date('Y')));
      $date = date('Y').'-'.date('m', mktime(0,0,0,$m, 1, date('Y')));
      // $results = \DB::table('orders')
      // ->where('order_status','=',3)
      // ->where('created_at','LIKE',''.$date.'%')
      // ->get()
      // ->sum("order_total");  
      $results = \DB::table('subscription')
      ->where('created_at','LIKE',''.$date.'%')
      ->whereNull('deleted_at')
      ->get()
      ->sum("price"); 
      $data[$month]=$results;
    }
     $str='';
     foreach ($data as $key => $value) {
        if($key=='Jan')
        {
           $str='["'.$key.'", '.$value.', "color:#344af1"]';
        }
        else
        {
          $str=$str.','.'["'.$key.'", '.$value.', "color:#344af1"]';
        }
     }
     return $str;
}

// get country list

function getCountry()
{
  $countries = \DB::table('countries')
        ->select(\DB::raw('countries_name,countries_isd_code'))
        ->get(); 
        return $countries; 
}

function sendNotification($student_id,$message,$status=1){
    $student = \App\Student::with(['device_detail','plan_name','school_detail'])->where('id',$student_id)->firstOrFail();

    if($student->device_detail){
        $result['token'] = $student->device_detail->device_token;
        $result['type'] = $student->device_detail->device_type;
        $notification_type = 'message';
        $fcm = notificationSend($result,$message);
        // return $fcm;
    }
    \App\Notification::create(['sent_to'=>$student->id,'message'=>$message,'status'=>$status]);
}

function notificationSend($result,$message)
    {
        $token = $result['token'];
        $type = $result['type'];
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        // $token='dhWLCgOXSraeYICauSML_N:APA91bEacXF96n2qYk8IhHbGT4ZUc12uOtBcT6jgorKrdionryG8W1D6qbawsEZMR07lklzsuSNl';
        
        // $description = "description";
        $title = "test";
        $notification = [
                'sound' => true,
                'notificationDateStr'=>date('d M Y'),
                'status'=>true,
                // 'message' => $message,
                'sound'=>'default',
                'vibrate' => 1,
                "time_to_live"  => 10,
                'sound' => 1,
                "priority" => "high",
                // "title" => $message,              
                "sound" => "default",
                "icon" => "https://mealticketweb.rampwin.com/public/assets/img/mealtkt.png",
                "show_in_foreground" => false,
        ];
        if($type == 'android'){
           $notification['body']=$message; 
        }
        if($type == 'ios'){
           $notification['title']=$message; 
        }
        $extraNotificationData = [
                                'message' => $message,
                                // 'click_action' => "FCM_PLUGIN_ACTIVITY",
                                'sound'=>'default',
                                'vibrate' => 1,
                                "time_to_live"  => 10,
                                'sound' => 1,
                                "priority" => "high",
                                "title" => $message,                
                                // 'noti_type' => $notification_type,
                                "sound" => "default",
                                "icon" => "https://mealticketweb.rampwin.com/public/assets/img/mealtkt.png",
                                "show_in_foreground" => true,  
                            ]; 

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAAaDvdMsY:APA91bH_GQhv85-vJquOnjs0IU5SMh5-ImwtGLoitTjwcMephUmjVKhNdeZFszrBUYifsqtHBg7IBkfsNAaQ4B3uzjs4htNZjXtTWPxcPilRSz_d3RtuF5clEgzlA2j50IpGoHEF65sf',
            'Content-Type: application/json'
        ];

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        // return $result;
        curl_close($ch);
}

// get country list

function getSubscribers($school_id)
{
   $count=0;
   $studentList = \DB::table('student')
        ->select(\DB::raw('id'))
        ->where('school_id','=',$school_id)
        ->whereNull('deleted_at')
        ->get();
        foreach ($studentList as $key => $value)
         {
           $subscribers = \DB::table('subscription')
            ->where('student_id', $value->id)
            ->whereNull('deleted_at')
           ->whereDate('next_period_start', '>=',date('Y-m-d', strtotime(now())))
            ->select(\DB::raw('id'))
            ->first(); 
            if(!empty($subscribers))
            {
               $count++;
            }
         } 
         return $count;
       
}
function getSubscribers1($school_id)
{
   $count=0;
   $studentList = \DB::table('student')
        ->select(\DB::raw('id'))
        ->whereNull('deleted_at')
        ->where('school_id','=',$school_id)
        ->get();
        foreach ($studentList as $key => $value)
         {
           $subscribers = \DB::table('subscription')
            ->where('student_id', $value->id)
            ->whereNull('deleted_at')
            ->select(\DB::raw('id'))
            ->first(); 
            if(!empty($subscribers))
            {
               $count++;
            }
         } 
         return $count;
       
}
// get vendor school list
function getVendorSchool($vendor_id)
{
   $schoolname=array();
   $schoolList = \DB::table('school_vendor_mapping')
        ->select(\DB::raw('id,school_id'))
        ->whereNull('deleted_at')
        ->where('vendor_id','=',$vendor_id)
        ->get();
        foreach ($schoolList as $key => $value)
         {
           $school_name = \DB::table('school_info')
            ->where('id', $value->school_id)
            ->select(\DB::raw('id,name'))
            ->first(); 
            array_push($schoolname, $school_name->name);
         } 
    return $schoolname;
}

// get unmap school list
function getUnmapSchool()
{
     $unmapschoolarray=array();
     $schoolList = \DB::table('school_info')
        ->select(\DB::raw('id'))
        ->whereNull('deleted_at')
        ->get();
       
        foreach ($schoolList as $key => $value)
         {
           $unmapschoolList = \DB::table('school_vendor_mapping')
           ->select(\DB::raw('id'))
           ->where('school_id',$value->id)
           ->whereNull('deleted_at')
           ->count();
          
           if($unmapschoolList==0)
           {
            array_push($unmapschoolarray, $value->id);
           }
        }
       return $unmapschoolarray;
}
// get vendor school list
function getAllPermissions()
{
      $permissionsList = \DB::table('permissions')
        ->select(\DB::raw('id,name,parent_id,url'))
        ->where('parent_id','=',0)
        ->get();
      
    return $permissionsList;
}
function getAllChildPermissions($parent_id)
{
      $permissionsList = \DB::table('permissions')
        ->select(\DB::raw('id,name,parent_id,url'))
        ->where('parent_id','=',$parent_id)
        ->get();
      
    return $permissionsList;
}
function getRolePermissions($role)
{
      $temarray=array();
      $permissionsList = \DB::table('role_has_permissions')
        ->select(\DB::raw('permission_id'))
        ->where('role_id','=',$role)
        ->get();
      foreach ($permissionsList as $key => $value) {
        $temarray[$key]=$value->permission_id;
      }
    return $temarray;
}
function getCategoryName($category)
{
	$temparray=array();
	foreach($category as $key=>$val)
	{
	$temparray[$key]=$val->category_id;
	}
	//dd($temparray);die;
    $temarray=array();
      $nameList = \DB::table('tbl_category')
        ->select(DB::raw('CONCAT(name) AS names'))
        ->whereIn('id', $temparray)
        ->get()->toArray();
        foreach ($nameList as $key => $value) {
         $temarray[$key]=$value->names;
        }
     return $temarray;
}

// send sms
function sendSms($mobile,$message)
 {
//Hello!%20This%20is%20a%20test%20message
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.msg91.com/api/sendhttp.php?authkey=340556Agq8nMSnbrD5f4f5ff3P1&mobiles=".$mobile."&country=91&message=".$message."&sender=amigos&route=4",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;
 } 

 // send pushnotification
 function sendPushNotification($arrNotification,$registatoin_ids,$device_type)
 {

     $url = 'https://fcm.googleapis.com/fcm/send';
      if($device_type == "Android"){
            $fields = array(
                'to' => $registatoin_ids,
                'data' => $arrNotification
            );
      } else {
            $fields = array(
                'to' => $registatoin_ids,
                'notification' => $arrNotification
            );
      }
      // Firebase API Key
      $headers = array('Authorization:key=AAAAunw8WCw:APA91bF5dzsOqJSLEORy594yc7McW0sglofF82DqxLfwmBQ1l5Prbf0Q3ahdXhQ4kp7_vOvRAXA6K6IvIF69B7OICfIuJhWpYqwcvW37M3U3jqw-M25s-2-FLx1aaTvQMtfqFBpbofbZ','Content-Type:application/json');
     // Open connection
      $ch = curl_init();
      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
     // print_r($result);
      if ($result === FALSE) {
          die('Curl failed: ' . curl_error($ch));
      }
      curl_close($ch);
 }

 function getPlan()
 {
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
    return  json_decode($plans);
 }

 function getPlanDetail($plan_id)
 {
        $curl = curl_init();
       curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.razorpay.com/v1/plans/".$plan_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "authorization: Basic cnpwX3Rlc3RfajRRbHkzbHBOV0E2YWk6WjZLQ0tJS2VlQW02UmxINDdQSmJjSGhj",
          "cache-control: no-cache"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        return $err;
      } else {
        return $response;
      }
   
 }
function createCustomers()
 {
          $data=array("plan_id"=>$plan_id,"total_count"=>6,"customer_notify"=>1);
          // echo json_encode($data);
          // return;
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.razorpay.com/v1/subscriptions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            "authorization: Basic cnpwX3Rlc3RfajRRbHkzbHBOV0E2YWk6WjZLQ0tJS2VlQW02UmxINDdQSmJjSGhj",
             "content-type: application/json",
            
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return $err;
        } else {
          return $response;
        }
 }
 function subscriptions($plan_id)
 {
          $data=array("plan_id"=>$plan_id,"total_count"=>6,"customer_notify"=>1);
          // echo json_encode($data);
          // return;
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.razorpay.com/v1/subscriptions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            "authorization: Basic cnpwX3Rlc3RfajRRbHkzbHBOV0E2YWk6WjZLQ0tJS2VlQW02UmxINDdQSmJjSGhj",
             "content-type: application/json",
            
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return $err;
        } else {
          return $response;
        }
 }

 function cancelSubscriptions($subscription_id)
 {
       $data=array("cancel_at_cycle_end"=> 0);
       $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.razorpay.com/v1/subscriptions/".$subscription_id."/cancel",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
          "authorization: Basic cnpwX3Rlc3RfajRRbHkzbHBOV0E2YWk6WjZLQ0tJS2VlQW02UmxINDdQSmJjSGhj"
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
        return $err;
      } else {
        return $response;
      }
 }
function getSubscriptions($subscription_id)
 {
       $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.razorpay.com/v1/subscriptions/'.$subscription_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "authorization: Basic cnpwX3Rlc3RfajRRbHkzbHBOV0E2YWk6WjZLQ0tJS2VlQW02UmxINDdQSmJjSGhj"
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
        return $err;
      } else {
        return $response;
      }
 }
function getRandomNumber($length=7)
{
    $token = "";
    $codeAlphabet= "0123456789";
    $max = strlen($codeAlphabet); 

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}
?>