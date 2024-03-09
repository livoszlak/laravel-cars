<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CreateCarController;
use App\Http\Controllers\CreateLaptimeController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteCarController;
use App\Http\Controllers\DeleteLaptimeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileShowController;
use App\Http\Controllers\RegisterCarController;
use App\Http\Controllers\RegisterTimeController;
use App\Http\Controllers\UpdateCarController;
use App\Http\Controllers\UpdateLaptimeController;
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

Route::view('/', 'index')->name('login')->middleware('guest');
Route::view('register', 'register')->name('register')->middleware('guest');
Route::view('login', 'login')->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('register-car', RegisterCarController::class);
    Route::get('register-time', RegisterTimeController::class);
    Route::get('your-cars', YourCarsController::class);
    Route::get('your-times', YourTimesController::class);
    Route::get('dashboard', DashboardController::class);
    Route::get('profile', ProfileController::class);
    Route::get('leaderboard/{track_id?}', LeaderboardController::class)->where('track_id', '[0-9]+')->defaults('track_id', 1);
});

Route::get('profile', ProfileShowController::class)->name('profile');

Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);
Route::post('users', CreateUserController::class);
Route::post('laptimes', CreateLaptimeController::class);
Route::post('laptimes/update', UpdateLaptimeController::class);
Route::patch('laptimes/{laptime}/delete', DeleteLaptimeController::class);

Route::post('cars', [CarController::class, 'create']);
Route::post('cars/update', [CarController::class, 'update']);
Route::patch('cars/{car}/delete', [CarController::class, 'destroy']);
Route::post('cars/toggleActive', [CarController::class, 'toggleActive']);
