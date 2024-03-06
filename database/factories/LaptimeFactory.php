<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laptime>
 */
class LaptimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'car_id' => null,
            'track_id' => null,
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
        ];
    }
}
