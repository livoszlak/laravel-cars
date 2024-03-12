<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 
     */
    public function test_register_car(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $carData = [
            'registration_number' => 'ABC123',
            'model' => 'Tesla Model S'
        ];

        $response = $this->post(route('cars'), $carData);

        $car = Car::where('registration_number', $carData['registration_number'])->first();

        $this->assertNotNull($car);
        $this->assertEquals($carData['registration_number'], $car->registration_number);
        $this->assertEquals($carData['model'], $car->model);
        $this->assertEquals($user->id, $car->user_id);

        $response->assertRedirect('your-cars');
    }

    public function test_create_car_with_invalid_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $carData = [
            'registration_number' => 'A',
            'model' => ''
        ];

        $response = $this->post(route('cars'), $carData);

        $response->assertSessionHasErrors(['registration_number', 'model']);
    }

    public function test_update_car(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $updatedCarData = [
            'id' => $car->id,
            'registration_number' => 'XYZ789',
            'model' => 'Ford Fast & Furious'
        ];

        $response = $this->post(route('cars/update'), $updatedCarData);

        $updatedCar = Car::findOrFail($car->id);

        $this->assertEquals($updatedCarData['registration_number'], $updatedCar->registration_number);
        $this->assertEquals($updatedCarData['model'], $updatedCar->model);

        $response->assertRedirect('your-cars');
    }

    public function test_delete_car(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->patch(route('cars/{car}/delete', ['car' => $car->id]));

        $this->assertDatabaseMissing('cars', ['id' => $car->id]);

        $response->assertRedirect('your-cars');
    }

    public function test_toggle_active_car(): void
    {
    }
}
