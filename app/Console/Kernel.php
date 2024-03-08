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
        'App\Console\Commands\ExpireCode',
        'App\Console\Commands\DatabaseBackUp',
        'App\Console\Commands\CreateBalance',
        'App\Console\Commands\ExpireBalance'
    
        //'App\Console\Commands\ProcessPayment'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('expire:code')->everyTenMinutes();
        $schedule->command('expire:balance')->daily();
        $schedule->command('create:balance')->daily();
        $schedule->command('database:backup')->weekly();
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
