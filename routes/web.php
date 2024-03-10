<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptimeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterCarController;
use App\Http\Controllers\RegisterTimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YourCarsController;
use App\Http\Controllers\YourTimesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest', 'throttle:60,1'])->group(function () {
    Route::view('/', 'index')->name('login');
    Route::view('register', 'register')->name('register');
    Route::view('login', 'login')->name('login');
    Route::post('login', LoginController::class);
    Route::post('users', [UserController::class, 'create']);
});

Route::middleware(['auth', 'throttle:60,1'])->group(function () {
    Route::get('register-car', RegisterCarController::class);
    Route::get('register-time', RegisterTimeController::class);
    Route::get('your-cars', YourCarsController::class);
    Route::get('your-times', YourTimesController::class);
    Route::get('dashboard', DashboardController::class);
    Route::get('leaderboard/{track_id?}', LeaderboardController::class)->where('track_id', '[0-9]+')->defaults('track_id', 1);

    Route::post('logout', LogoutController::class);
    Route::post('laptimes', [LaptimeController::class, 'create']);
    Route::post('laptimes/update', [LaptimeController::class, 'update']);
    Route::patch('laptimes/{laptime}/delete', [LaptimeController::class, 'destroy']);
    Route::post('cars', [CarController::class, 'create']);
    Route::post('cars/update', [CarController::class, 'update']);
    Route::patch('cars/{car}/delete', [CarController::class, 'destroy']);
    Route::post('cars/toggleActive', [CarController::class, 'toggleActive']);
});
