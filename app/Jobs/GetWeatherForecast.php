<?php

namespace App\Jobs;

use App\Services\StoreForecasts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetWeatherForecast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The city which we want to get forecasts for.
     *
     * @var string
     */
    protected $city;

    /**
     * Create a new job instance.
     *
     * @param string $city
     * @return void
     */
    public function __construct(string $city)
    {
        $this->city = $city;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app(StoreForecasts::class)->setCity($this->city)->process();
    }
}
