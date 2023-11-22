<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/register', 'register')->name('register');
    Route::get('/auth/login', 'login')->name('login');
    Route::get('/auth/forgot-password', 'forgotPassword')->name('forgotPassword');
    Route::post('/auth/authenticate', 'authenticate')->name('authenticate');
    Route::post('/auth/logout', 'logout')->name('logout');

    Route::get('/dashboard', 'dashboard')->name('dashboard');
});
