<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Laptime;
use App\Models\Track;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $models = [
            "Koenigsegg Jesko Absolut",
            "Hennessey Venom F5",
            "Bugatti Chiron Super Sport 300+",
            "SSC Tuatara",
            "Rimac Nevera",
            "McLaren Speedtail",
            "Aston Martin Valkyrie",
            "Koenigsegg Gemera",
            "Koenigsegg Regera",
            "Aspark Owl"
        ];
        return [
            'registration_number' => $this->faker->unique()->bothify('#######'),
            'model' => $this->faker->randomElement($models),
            'user_id' => null
        ];
    }

    /*     public function configure()
    {
        return $this->afterCreating(function (Car $car) {
            $car->laptimes()->saveMany(Laptime::factory(5)->for(Track::all()->random())->make());
        });
    } */
}
