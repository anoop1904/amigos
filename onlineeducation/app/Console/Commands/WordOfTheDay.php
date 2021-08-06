<?php

namespace App\Console\Commands;
use App\Student;
use App\School;
use Illuminate\Console\Command;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public static function callCurlRequest($postFields = array(), $timeout = 2000, $asynch = false, $postAsBodyParam = false)
    {


        $account_sid = config('constants.TWILIO_SID');
        $auth_token = config('constants.TWILIO_TOKEN');
        $twilio_number = config('constants.SENDER_NUMBER');
        $url = "https://api.twilio.com/2010-04-01/Accounts/" . $account_sid . "/Messages.json";
        $postFields['From'] = "+" .$twilio_number;

        $headers = ['Content-Type:application/x-www-form-urlencoded'];
        $userPass = $account_sid . ":" . $auth_token;

           $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            if (is_array($postFields) && count($postFields)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            if ($postAsBodyParam === true) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, @json_encode($postFields));
            } elseif ($postAsBodyParam === 5) {
                // $postAsBodyParam = 5 means put as it is
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
           if ($userPass) {
                curl_setopt($ch, CURLOPT_USERPWD, $userPass);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if (is_array($headers) && count($headers)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            } else {
                $headers = array("Content-Type: application/json");
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
            // Asynchronous Request
            if ($asynch === true) {
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            } else {
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $result = curl_getinfo($ch);
            curl_close($ch);
            if ($asynch || (isset($result['http_code']) && in_array($result['http_code'], [200, 201, 202, 204]))) {
                return $response;
            } else {
                return false;
            }
    } 
    public function sendMessage($userId){
			$BOT_ID = '5f1c0ea4038a195563726ac7';
			$USER_ID = $userId;
			$TOKEN = 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
			$BLOCK_NAME = 'Notification Welcome message 1';

    		$post['chatfuel_token']=$TOKEN;
			$post['chatfuel_message_tag']="POST_PURCHASE_UPDATE";
			$post['chatfuel_block_name']=$BLOCK_NAME;

			$url = 'https://api.chatfuel.com/bots/'.$BOT_ID.'/users/'.$USER_ID.'/send?'.http_build_query($post);
			$post =array();
			
			

			// $url ="https://api.chatfuel.com/bots/5f1c0ea4038a195563726ac7/users/5f2a3e8cf14eaf1c19824c5f/send?".http_build_query($post);
			// $headers = ['Content-Type:application/x-www-form-urlencoded'];
			$postFields = [];
			$ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array("Content-Type: application/json");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $server_output  = curl_exec($ch);
            $result = curl_getinfo($ch);
            curl_close($ch);
            if ($server_output == "OK") {return true; } else {return false; }

    }
    public function handle()
    {

        date_default_timezone_set("Europe/Copenhagen");
        // date_default_timezone_set("Asia/Kolkata");
        $myfile = fopen("student.txt", "a+") or die("Unable to open file!");
        
        $time = date('H:i:s',time());
        $txt = "---Message Trigger in chatbot ".$time."---\n";
        
        $schools = School::with('student_detail')->where('last_order_time', '>', $time)->where('last_order_time', '>', $time)->whereIn('cron_status',[0,1])->get();
        $txt .= 'count '.$schools->count()."---\n";
        if($schools->count() && !empty($schools)){
            foreach ($schools as $key => $value) {
                $value->cron_status = $value->cron_status+1;
                $value->save();
                if($value->student_detail->count()){
                    $txt .= "Student Name:  ".$value->name."\n";
                    foreach ($value->student_detail as $k => $student) {
                        if($student->plan_id){
                            if($student->messenger_id){
                                // hit message to chatbot
                               
                                $orderCount = \App\Order::whereDay('created_at', now()->day)->where('user_id',$student->id)->get()->count();
                                // hit message to chatbot
                                if(!$orderCount){
                                     $txt .= $student->messenger_id.',';
                                    // echo "string";
                                    $this->sendMessage($student->messenger_id);
                                }
                            }
                        }
                    }
                }
            }
            $txt .= "---***End***---\n";
        }
        // echo $txt;
    	fwrite($myfile, $txt);
        fclose($myfile);
        $this->info('word:day Cummand Run successfully!');
    }
}
// */5 9-11 * * * cd /home/ubuntu/deployment/mealticket-webapp && php artisan schedule:run >> /dev/null 2>&1
// /home/ubuntu/deployment/mealticket-webapp