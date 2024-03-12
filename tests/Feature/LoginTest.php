<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to view login
     */
    public function test_view_login(): void
    {
        $response = $this->get('/login');

        $response->assertSeeText('Email');

        $response->assertStatus(200);
    }

    /**
     * Test to login user
     */
    public function test_login_user(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->followingRedirects();

        $response->assertRedirect('/dashboard');

        $this->get('/dashboard')->assertSee($user->name);
    }

    /**
     * Test that auth middleware blocks logged in user from visiting login view
     */
    public function test_authenticated_user_cannot_view_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect('/dashboard');
    }
}
