<?php

namespace App\Services;

use App\Models\Forecast;
use App\Services\Contracts\Service;
use Carbon\Carbon;

class GetWeather extends BaseService implements Service
{
    /**
     * Return the weather forecast entry.
     *
     * @return \App\Models\Forecast
     */
    public function getForecastEntry()
    {
        return Forecast::whereCity($this->city)->where('day', Carbon::parse($this->date))->first();
    }

    /**
     * Return the weather forecast entries.
     *
     * @return \App\Models\Forecast
     */
    public function getForecastEntries()
    {
        return Forecast::whereCity($this->city)->get();
    }

    /**
     * Get weather forecast for a city.
     * @return void
     */
    public function process()
    {
        //
        if ($this->date != null) {
            return $this->getOneDateEntry();
        }
        return $this->getAllDatesEntries();
    }

    /**
     * Return one day forecast.
     *
     * @return float
     */
    public function getOneDateEntry()
    {
        if ($entry = $this->getForecastEntry()) {
            return isset($entry) ? $entry->temperature : null;
        } else {
            app(StoreForecasts::class)->setCity($this->city)->process();
            $entry = $this->getForecastEntry();
            return isset($entry) ? $entry->temperature : null;
        }
    }

    /**
     * Return forecasts entries for a city for all dates.
     *
     * @return array
     */
    public function getAllDatesEntries()
    {
        $entries = $this->getForecastEntries();
        if ($entries->count() != 0) {
            return $entries->pluck('temperature', 'day');
        } else {
            app(StoreForecasts::class)->setCity($this->city)->process();
            $entries = $this->getForecastEntries();
            return $entries->pluck('temperature', 'day');
        }
    }
}
