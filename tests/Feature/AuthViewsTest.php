<?php

namespace Tests\Feature;

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
}
