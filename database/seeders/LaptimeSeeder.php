<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Laptime;
use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LaptimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $cars = Car::all();
        $tracks = Track::all();

        foreach ($cars as $car) {
            foreach ($tracks as $track) {
                Laptime::create([
                    'user_id' => $car->user_id,
                    'car_id' => $car->id,
                    'track_id' => $track->id,
                    'date' => $faker->date(),
                    'time' => $faker->time(),
                ]);
            }
        }
    }
}
