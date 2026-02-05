<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ScreenTimeController;
use App\Http\Controllers\SleepController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('app')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/input-data', function () {
        return view('app.input-data');
    })->name('input.data.page');
    Route::get('/journal', [JournalController::class, 'render'])->name('journal');
    Route::get('/reminder', [ReminderController::class, 'render'])->name('reminder');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/input-data/sleep', [SleepController::class, 'saveSleepData'])->name('sleep.data.create');
    Route::post('/input-data/meals', [MealsController::class, 'saveMealsData'])->name('meals.data.create');
    Route::post('/input-data/screen-time', [ScreenTimeController::class, 'saveScreenTimeData'])->name('screen.time.data.create');
    Route::post('/journal/input-data', [JournalController::class, 'createJournal'])->name('journal.create');

    Route::put('/journal/{id}', [JournalController::class, 'editJournal'])->name('journal.update');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/register', [UserController::class, 'createUser'])->name('register.create');
    Route::post('/login', [UserController::class, 'getUser'])->name('login.validate');
});
