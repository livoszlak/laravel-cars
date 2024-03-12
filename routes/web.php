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
    Route::view('/', 'index')->name('index');
    Route::view('register', 'register')->name('register');
    Route::view('login', 'login')->name('login');
    Route::post('login', LoginController::class);
    Route::post('users', [UserController::class, 'create'])->name('users');
});

Route::middleware(['auth', 'throttle:60,1'])->group(function () {
    Route::get('register-car', RegisterCarController::class)->name('register-car');
    Route::get('register-time', RegisterTimeController::class)->name('register-time');
    Route::get('your-cars', YourCarsController::class)->name('your-cars');
    Route::get('your-times', YourTimesController::class)->name('your-times');
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('leaderboard/{track_id?}', LeaderboardController::class)->where('track_id', '[0-9]+')->defaults('track_id', 1)->name('leaderboard');

    Route::post('logout', LogoutController::class)->name('logout');
    Route::post('laptimes', [LaptimeController::class, 'create'])->name('laptimes');
    Route::post('laptimes/update', [LaptimeController::class, 'update'])->name('laptimes/update');
    Route::post('cars', [CarController::class, 'create'])->name('cars');
    Route::post('cars/update', [CarController::class, 'update'])->name('cars/update');
    Route::post('cars/toggleActive', [CarController::class, 'toggleActive'])->name('cars/toggleActive');

    Route::patch('laptimes/{laptime}/delete', [LaptimeController::class, 'destroy'])->name('laptimes/{laptime}/delete');
    Route::patch('cars/{car}/delete', [CarController::class, 'destroy'])->name('cars/{car}/delete');
});
