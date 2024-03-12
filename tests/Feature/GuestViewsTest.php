<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestViewsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test to assert guest views are only accessible when user is not logged in
     */
    public function test_authenticated_user_cannot_view_guest_routes()
    {
        $user = User::factory()->create();

        $postRoutes = [
            'login',
            'users'
        ];

        $viewRoutes = [
            'index',
            'register',
            'login'
        ];

        foreach ($viewRoutes as $route) {
            $response = $this->actingAs($user)->get(route($route));
            $response->assertRedirect('/dashboard');
        }

        foreach ($postRoutes as $route) {
            $response = $this->actingAs($user)->post(route($route));
            $response->assertRedirect('/dashboard');
        }
    }
}
