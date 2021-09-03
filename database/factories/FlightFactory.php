<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'departure_at' => $this->faker->dateTimeBetween('tomorrow', '+1 year'),
            'destination' => $this->faker->city(),
            'from' => $this->faker->city(),
        ];
    }
}
