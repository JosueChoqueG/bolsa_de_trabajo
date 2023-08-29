<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
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
        // Log::info('schudule inicio ');
        // $schedule->command('queue:work --tries=3')
        // //->everyMinute()
        // ->cron('* * * * *')
        // ->withoutOverlapping();
    //     // //->emailOutputOnFailure('danielbq111144@gmail.com')
    //  ->before(function () {
    //        Log::info('Se esta iniciando el schudule '.date('Y-m-d'));
    //  })
    //     ->after(function () {
    //         Log::info('Culmino el schudule '.date('Y-m-d'));
    //      });
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
