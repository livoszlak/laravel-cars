<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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

/* Route::get('/', function () {
    return view('index');
}); */

Route::view('/', 'index')->name('login')->middleware('guest');
Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);
Route::get('dashboard', DashboardController::class)->middleware('auth');
