<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [// Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
         $schedule->command('inspire')
                  ->everyMinute();
//        $schedule->call(function () {
//            file_put_contents('myTest.text',time(),"FILE_APPEND");
//        })->everyMinute()->when(function () {
//            return true;
//        });

    }
}
