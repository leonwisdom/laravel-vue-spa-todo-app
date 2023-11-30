<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

const PROFILE = '/profile';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('note.index');
    } else {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get(PROFILE, [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch(PROFILE, [ProfileController::class, 'update'])->name('profile.update');
    Route::delete(PROFILE, [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/notes', [NoteController::class, 'index'])->name('note.index');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    Route::patch('/note/{note}', [NoteController::class, 'update'])->name('note.update');
    Route::post('/note/restore', [NoteController::class, 'restore'])->name('note.restore');
    Route::delete('/note/{note}', [NoteController::class, 'destroy'])->name('note.destroy');
});

require __DIR__.'/auth.php';
