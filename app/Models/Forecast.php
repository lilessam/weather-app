<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * Store forecasts data.
     *
     * @param string $city
     * @param array $data
     * @return void
     */
    public static function store($city, $data)
    {
        foreach ($data as $entry) {
            static::updateOrCreate(
                [
                    'city' => $city,
                    'day' => Carbon::parse($entry['date'])
                ],
                [
                'city' => $city,
                'temperature' => $entry['temp'],
                'day' => Carbon::parse($entry['date'])
            ]);
        }
    }
}
