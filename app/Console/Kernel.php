<?php

namespace App\Console;

use App\Console\Commands\CreateUser;
use App\Console\Commands\FetchFiles;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = array(
        \Laravelista\LumenVendorPublish\VendorPublishCommand::class,
        CreateUser::class,
        FetchFiles::class,
    );

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(FetchFiles::class)->hourly()->unlessBetween('01:00', '04:00');
    }
}
