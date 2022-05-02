<?php

namespace App\Listeners;

use App\Events\ForecastsUpdated;
use App\Models\Forecast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateForecastsTable
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ForecastsUpdated  $event
     * @return void
     */
    public function handle(ForecastsUpdated $event)
    {
        //
        Forecast::store($event->city, $event->forecasts);
    }
}
