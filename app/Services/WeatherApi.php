<?php

namespace App\Services;

use OpenWeather;
use App\Services\Contracts\Service;

class WeatherApi extends BaseService implements Service
{
    /**
     * Get weather forecast for a city.
     * @return void
     */
    public function process()
    {
        //
        $weather = new OpenWeather;
        $forecasts = $weather->getForecastWeatherByCityName($this->city);
        $this->forecasts = isset($forecasts) && key_exists('forecast', $forecasts) ? $forecasts['forecast'] : [];
        return $this;
    }
}
