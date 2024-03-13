<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Laptime;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthViewsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that auth middleware blocks guest users from all auth routes
     */

    public function test_auth_routes_are_protected()
    {
        $getRoutes = [
            'register-car',
            'register-time',
            'your-cars',
            'your-times',
            'dashboard',
            'leaderboard',
        ];

        $postRoutes = [
            'logout',
            'laptimes',
            'cars',
            'cars/update',
            'cars/toggleActive',
        ];

        $patchRoutes = [
            'laptimes/update',
            'laptimes/{laptime}/delete',
            'cars/{car}/delete',
        ];

        foreach ($getRoutes as $route) {
            $response = $this->get(route($route));
            $response->assertRedirect(route('login'));
        }

        foreach ($postRoutes as $route) {
            $response = $this->post(route($route));
            $response->assertRedirect(route('login'));
        }

        foreach ($patchRoutes as $route) {
            $response = $this->patch(route($route, ['laptime' => 1, 'car' => 1]));
            $response->assertRedirect(route('login'));
        }
    }

    public function test_auth_users_can_view_auth_routes(): void
    {
        /**
         * Temp seed of database after refresh necessary because leaderboard view displays a calculation based on the laptimes table being filled
         */
        $tracks = Track::factory(10)->create();
        $users = User::factory(10)->create();
        $cars = Car::factory(5)->make()->each(function ($car) use ($users) {
            $car->user_id = $users->random()->id;
            $car->save();
        });

        $laptimes = Laptime::factory(10)->make()->each(function ($laptime) use ($users, $cars, $tracks) {
            $laptime->user_id = $users->random()->id;
            $laptime->car_id = $cars->random()->id;
            $laptime->track_id = $tracks->random()->id;
            $laptime->save();
        });

        $user = User::factory()->create();
        /**
         * Tests if authorized user can see auth views through get request
         */
        $response = $this->actingAs($user)->get(route('your-cars'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('your-times'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('your-cars'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('leaderboard', ['laptimes' => $laptimes, 'track_id' => 1]));
        $response->assertStatus(200);
    }
}
