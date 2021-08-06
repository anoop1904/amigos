<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Auth;
use Session;
use App\Websitesetting;
use Mail;


class InterviewscheduleCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'interviewschedule:cron';

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
    public function handle()
    {
                        /////////////// mail////////////////
        
     
        date_default_timezone_set("Europe/Copenhagen");
        // date_default_timezone_set("Asia/Kolkata");
        $myfile = fopen("testing.txt", "a+") or die("Unable to open file!");
        
        $time = date('H:i:s',time());
        $txt = "---Message Trigger in chatbot ".$time."---\n";
        
        fwrite($myfile, $txt);
        fclose($myfile);
        $this->info('InterviewscheduleCron:cron Cummand Run successfully!');
    }
}
