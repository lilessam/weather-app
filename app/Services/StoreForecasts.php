<?php

namespace App\Services;

use App\Events\ForecastsUpdated;
use App\Models\Forecast;
use App\Services\Contracts\Service;

class StoreForecasts extends BaseService implements Service
{
    /**
     * Get weather forecast for a city.
     *
     * @return void
     */
    public function process()
    {
        $weatherAPI = app(WeatherApi::class);
        $forecasts = collect($weatherAPI->setCity($this->city)->process()->forecasts);
        $data = $forecasts->values()->map(function ($forecast) {
            if ('12:00 PM' == $forecast['datetime']['formatted_time']) {
                return
                [
                    'date' => $forecast['datetime']['formatted_date'],
                    'temp' => $forecast['forecast']['temp'],
                ];
            }

            return null;
        })->filter(function ($forecast) {
            return null != $forecast;
        });

        ForecastsUpdated::dispatch($this->city, $data);
    }
}
