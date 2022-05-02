<?php

namespace App\Http\Controllers;

use App\Services\GetWeather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Return weather forecasts for a city.
     *
     * @param string $city
     * @param string $date
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(string $city, string $date = null)
    {
        //
        $this->weatherService = app(GetWeather::class);
        //
        $temperature = $this->weatherService->setCity($city)->setDate($date)->process();
        //
        if ($temperature) {
            return response()->json(['temperature' => $temperature], 200);
        }
        //
        return response()->json(['error' => 'Cannot get this info.'], 404);
    }
}
