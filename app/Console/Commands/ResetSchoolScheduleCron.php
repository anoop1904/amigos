<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetSchoolScheduleCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:school';

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
    	date_default_timezone_set(config('constants.TIME_ZONE'));
        $time = date('Y-m-d h:i:s',time());
        $myfile = fopen("reset_file.txt", "a+") or die("Unable to open file!");
        $txt = "---Reset School for cron job---\n";
        $txt .= "Time".$time."\n";
        fwrite($myfile, $txt);
        $schools = \App\School::with('student_detail')->get(); // get all school
        $txt .= "reset school Count ".$schools->count()."\n";
        foreach ($schools as $key => $school) {
            $school->cron_status = 0;
                $school->save();
        }
        $txt .= "---***End***---\n";
        fclose($myfile);
    }
}
