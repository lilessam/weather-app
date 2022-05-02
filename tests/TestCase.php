<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create a client and authenticate the request.
     *
     * @param string|null $name
     * @return \App\Models\Client
     */
    public function createAndAuthenticatedClient($name = null)
    {
        $client = Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
        $newToken = $client->createToken('Default');
        $client->tokens()->first()->update(['plain_token' => $newToken->plainTextToken]);
        $client->withAccessToken($client->tokens()->first());

        return $client;
    }
}
