<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WeatherAPITest extends TestCase
{
    /**
     * Test successful weather forecasts API request.
     *
     * @return void404 
     */
    public function test_weather_api_endpoint()
    {
        $this->createAndAuthenticatedClient();
        $response = $this->get('/api/weather/London/2022-05-07');
        $response->assertStatus(200);
    }

    /**
     * Test weather forecasts API request.
     *
     * @return void
     */
    public function test_404_weather_api_endpoint()
    {
        $this->createAndAuthenticatedClient();
        $response = $this->get('/api/weather/London/2023-05-07');
        $response->assertStatus(404);
    }
}
