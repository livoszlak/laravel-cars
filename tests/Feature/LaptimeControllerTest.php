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
}
