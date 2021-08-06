<?php



   function sendPushNotificationToFCMSever($notification_for_user,$message,$notification_type) {



    //$regID = $notification_for_user->device_id;
    $regID = 'cAw2vIOTtEM4pjDUJAKNWO:APA91bH7KYI7iz2JSpyrrrxQkVseqMnw0Xxtk-3JcxDMIlwOvQZRZS3Vw2QBniodyXnHM_jRTLFQhKdAY8yvTkelnimBnCmOZg8nbwwBCuLGmpk0lz9H0qW86g2tMc817fod7RpS4hba';

    if(!empty($regID))

    {

        //$regID = $notification_for_user->device_id;   
        $regID = 'cAw2vIOTtEM4pjDUJAKNWO:APA91bH7KYI7iz2JSpyrrrxQkVseqMnw0Xxtk-3JcxDMIlwOvQZRZS3Vw2QBniodyXnHM_jRTLFQhKdAY8yvTkelnimBnCmOZg8nbwwBCuLGmpk0lz9H0qW86g2tMc817fod7RpS4hba';   

    } else {

        $regID = 'esNNOVzSJkJ2oVgvHPYl3e:APA91bE5sDFvv3YW3Gd9t9bUygKwljHP9d2YfffR9a0neEFb8IdtsuZ-yr7MafYfsU_Alai6es0ab0HW4zy1rkrjuFc4vqtlXEQHTp2JCzY51yvw2QH9U3K-Zr4mhfiPpJfgWq94sPed'; 

    }





    $registrationIds = array($regID);


        define('API_ACCESS_KEY', 'AAAAaDvdMsY:APA91bH_GQhv85-vJquOnjs0IU5SMh5-ImwtGLoitTjwcMephUmjVKhNdeZFszrBUYifsqtHBg7IBkfsNAaQ4B3uzjs4htNZjXtTWPxcPilRSz_d3RtuF5clEgzlA2j50IpGoHEF65sf');





   

$fields = array(

        'registration_ids' => $registrationIds,

        "content_available" => true,

          // "mutable_content"=> true,

        'data' => array(       



          

                            'message' => $message,

                           // 'click_action' => "FCM_PLUGIN_ACTIVITY",

                            'sound'=>'default',

                            'vibrate' => 1,

                            "time_to_live"  => 10,

                            'sound' => 1,

                            "priority" => "high",

                            "title" => $message,                

                            'noti_type' => $notification_type,

                            "sound" => "default",

                            "icon" => "https://mealticketweb.rampwin.com/public/assets/img/mealtkt.png",

                            "show_in_foreground" => true,   

                      ),

        'notification'=>array(

                            'message' => $message,

                           // 'click_action' => "FCM_PLUGIN_ACTIVITY",

                            'sound'=>'default',

                            'vibrate' => 1,

                            "time_to_live"  => 10,

                            'sound' => 1,

                            "priority" => "high",

                            "title" => $message,              

                            'noti_type' => $notification_type,

                            "sound" => "default",

                            "icon" => "http://roomdaddy.ae/admin/img/room.png'",

                            "show_in_foreground" => false,    

                          ),

        'priority'=> "high"

    );

    $headers = array

    (

        'Authorization: key=' . API_ACCESS_KEY,

        'Content-Type: application/json'

    );







    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

   // print_r($result);

    curl_close($ch);

    return 'Sent';

  }

?>