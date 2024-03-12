<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test to register new user
     */
    public function test_register_user(): void
    {
        $this->withoutExceptionHandling();

        $userData = [
            'name' => 'Crash Test Dummy',
            'email' => 'idrivefastcars@example.com',
            'password' => 'Carlover1337'
        ];

        $response = $this->post('/users', $userData);

        $user = User::where('email', $userData['email'])->first();

        $this->assertNotNull($user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertTrue(Hash::check($userData['password'], $user->password));

        $response->assertRedirect('/login');
    }
}
