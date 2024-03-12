<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to log out user
     */
    public function test_logout_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertTrue(Auth::check());

        $response = $this->post('/logout');

        $this->assertFalse(Auth::check());

        $response->assertRedirect('/');
    }
}
