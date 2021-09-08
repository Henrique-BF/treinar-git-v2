<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Flight;

class FligthTest extends TestCase
{
    use RefreshDatabase;

    protected Flight $flight;

    public function setUp(): void
    {
        parent::setUp();
        $this->flight = Flight::factory()->create();
        //dump($this->flight);
    }
    
    public function test_api_flights_index()
    {
        $response = $this->json('GET','/flights');
        //dd($response);
        $response->assertJsonCount(1);
        $response->assertJsonFragment(([
            [
                'id' => $this->flight->id,
                'departure_at' => $this->flight->departure_at,
                'destination' => $this->flight->destination,
                'from' => $this->flight->from,
            ]
        ])); 
    }

    public function test_api_flights_store()
    {
        $payload = Flight::factory()->make()->toArray();
        //$payload['departure_at'] = $payload['departure_at']->format('Y-m-d H:i:s');
        $response = $this->postJson('/flights', $payload);
        $response->assertCreated();
        $this->assertDatabaseCount('flights', 2);
    }

    public function test_api_flights_show()
    {
        // act
        $response = $this->getJson('/flights/' . $this->flight->id );

        // assert
        $response->assertSuccessful();
        $response->assertJsonFragment([
            'id' => $this->flight->id,
            'departure_at' => $this->flight->departure_at,
            'destination' => $this->flight->destination,
            'from' => $this->flight->from,
        ]);
    }

    public function test_api_flights_update()
    {
        $payload = Flight::factory()->make()->toArray();
        //$payload['departure_at'] = $payload['departure_at']->format('Y-m-d H:i:s');
        $response = $this->patchJson('/flights/' . $this->flight->id, $payload);
        $response->assertSuccessful();
    }
    
    public function test_api_flights_destroy()
    {
        $this->assertDatabaseCount('flights', 1);
        $response = $this->deleteJson('/flights/' . $this->flight->id );
        $this->assertDatabaseCount('flights', 0);
        $response->assertSuccessful();
        $this->assertDeleted($this->flight);

        // $user = User::find(1);
        // $user->delete();
        // $this->assertDeleted($user);

    }
}
