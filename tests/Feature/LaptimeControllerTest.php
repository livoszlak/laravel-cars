<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Laptime;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaptimeControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 
     */
    public function test_register_time(): void
    {
        Track::factory()->create();
        $track = Track::all()->first();
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $laptimeData = [
            'car_id' => $car->id,
            'track_id' => $track->id,
            'date' => '2002-11-18',
            'time' => '01:59:999',
        ];

        $this->post('laptimes', $laptimeData);

        $this->assertDatabaseHas('laptimes', $laptimeData);
    }

    public function test_update_time(): void
    {
        Track::factory()->create();
        $track = Track::all()->first();
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $laptimeData = [
            'car_id' => $car->id,
            'track_id' => $track->id,
            'date' => '2002-11-18',
            'time' => '01:59:999',
        ];

        $this->post('laptimes', $laptimeData);

        $laptime = Laptime::where($laptimeData)->first();

        $this->assertDatabaseHas('laptimes', $laptimeData);

        $updatedLaptimeData = [
            'date' => '2022-01-01',
            'time' => '03:55:666',
            'track_id' => $track->id,
        ];

        $this->post(route('laptimes/update', $laptime->id), $updatedLaptimeData);

        /* $updatedLaptime = Laptime::findOrFail($laptime->id);

        $this->assertEquals($updatedLaptimeData['date'], $updatedLaptime->date);
        $this->assertEquals($updatedLaptimeData['time'], $updatedLaptime->time); */

        /* $response->assertRedirect('your-times'); */


        $this->assertDatabaseHas('laptimes', $laptimeData);







        /* Track::factory()->create();
        $track = Track::all()->first();
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $laptimeData = [
            'car_id' => $car->id,
            'track_id' => $track->id,
            'date' => '2002-11-18',
            'time' => '01:59:999',
        ];

        $response = $this->post('laptimes', $laptimeData);

        $laptime = Laptime::where('car_id', $laptimeData['car_id'])->first();

        $updatedLaptimeData = [
            'laptime_id' => $laptime->id,
            'car_id' => $car->id,
            'track_id' => $track->id,
            'date' => '2001-11-14',
            'time' => '01:59:995',
        ];

        $updatedLaptimeData['_method'] = 'PUT';
        $response = $this->post(route('laptimes/update'), $updatedLaptimeData);
        $updatedLaptime = Laptime::findOrFail($laptime->id);

        $this->assertEquals($updatedLaptimeData['car_id'], $updatedLaptime->car_id);
        $this->assertEquals($updatedLaptimeData['date'], $updatedLaptime->date);
        $this->assertEquals($updatedLaptimeData['time'], $updatedLaptime->time);

        $response->assertRedirect('your-times'); */
    }

    private function createLaptime(): Laptime
    {
        $track = Track::factory()->create();
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $laptimeData = [
            'car_id' => $car->id,
            'track_id' => $track->id,
            'date' => '2002-11-18',
            'time' => '01:59:999',
        ];

        $this->post('laptimes', $laptimeData);

        return Laptime::where($laptimeData)->first();
    }
}
