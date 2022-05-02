<?php

namespace App\Console;

use App\Jobs\GetWeatherForecast;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new GetWeatherForecast('New York'))->everySixHours();
        $schedule->job(new GetWeatherForecast('London'))->everySixHours();
        $schedule->job(new GetWeatherForecast('Paris'))->everySixHours();
        $schedule->job(new GetWeatherForecast('Berlin'))->everySixHours();
        $schedule->job(new GetWeatherForecast('Tokyo'))->everySixHours();
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
