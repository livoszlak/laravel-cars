<?php

use App\Http\Controllers\CreateCarController;
use App\Http\Controllers\CreateLaptimeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileShowController;
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
Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);
Route::get('dashboard', DashboardController::class)->middleware('auth');
Route::get('leaderboard', LeaderboardController::class)->middleware('auth');
Route::get('profile', ProfileController::class)->middleware('auth');
Route::post('cars', CreateCarController::class);
Route::post('laptimes', CreateLaptimeController::class);
Route::get('profile', ProfileShowController::class)->name('profile');
