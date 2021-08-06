<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\InterviewscheduleCron::class,
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        // $schedule->command('word:day')->dailyAt('17')->timezone('Europe/Copenhagen');

        // $schedule->command('test:cron')->dailyAt('14:55')->timezone('Europe/Copenhagen');
        $schedule->command('test:cron')->twiceDaily(12, 13)->timezone('Europe/Copenhagen');
        $schedule->command('test:cron')->twiceDaily(10, 11)->timezone('Europe/Copenhagen');
        $schedule->command('word:day')->twiceDaily(14, 17)->timezone('Europe/Copenhagen');
        $schedule->command('reset:school')->dailyAt('23:00')->timezone('Europe/Copenhagen');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
