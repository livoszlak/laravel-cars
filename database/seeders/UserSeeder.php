<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use App\Models\Laptime;
use App\Models\Track;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        /* $faker = \Faker\Factory::create();
        User::factory()->count(10)->create()->each(function ($user) use ($faker) {
            $cars = Car::factory()->count(5)->create(['user_id' => $user->id]);
            foreach ($cars as $car) {
                $tracks = Track::all();


                foreach ($tracks as $track) {
                    $randomHour = rand(0, 23);
                    $randomMinute = rand(0, 59);
                    $randomSecond = rand(0, 59);
                    $randomTime = Carbon::createFromTime($randomHour, $randomMinute, $randomSecond);
                    $formattedTime = $randomTime->format('i:s');

                    Laptime::factory()->create([
                        'user_id' => $user->id,
                        'car_id' => $car->id,
                        'track_id' => $track->id,
                        'date' => $faker->date(),
                        'time' => $formattedTime
                    ]);
                }
            }
        }); */
    }
}
