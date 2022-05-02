<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ForecastsUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Forecasts Data.
     *
     * @var array
     */
    public $forecasts;

    /**
     * Forecasts city.
     *
     * @var string
     */
    public $city;

    /**
     * Create a new event instance.
     *
     * @param string $city
     * @param array $forecasts
     * @return void
     */
    public function __construct(string $city, Collection $data)
    {
        $this->city = $city;
        $this->forecasts = $data;
    }
}
