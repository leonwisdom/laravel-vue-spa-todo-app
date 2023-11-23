<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware(['guest'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/auth/register', 'register')->name('register');
        Route::get('/auth/login', 'login')->name('login');
        Route::get('/auth/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::post('/auth/authenticate', 'authenticate')->name('authenticate');
        Route::post('/auth/store', 'store')->name('store');
    });
});

// Other routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
});
