<?php

use App\Http\Controllers\DashboardController;
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
    Route::get('/dashboard', [DashboardController::class, 'render'])->name('dashboard');
    Route::get('/dashboard/avgSleep', [DashboardController::class, 'calculateAvgSleep'])->name('dashboard.avg.sleep');
    Route::get('/input-data', [SleepController::class, 'renderVIew'])->name('input.data.page');
    Route::get('/journal', [JournalController::class, 'render'])->name('journal');
    Route::get('/reminder', [ReminderController::class, 'index'])->name('reminder');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/input-data/sleep', [SleepController::class, 'saveSleepData'])->name('sleep.data.create');
    Route::post('/input-data/meals', [MealsController::class, 'saveMealsData'])->name('meals.data.create');
    Route::post('/input-data/screen-time', [ScreenTimeController::class, 'saveScreenTimeData'])->name('screen.time.data.create');
    Route::post('/journal/input-data', [JournalController::class, 'createJournal'])->name('journal.create');

    Route::put('/journal/{id}', [JournalController::class, 'editJournal'])->name('journal.update');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', [UserController::class, 'login'])->name('login');

    Route::post('/register', [UserController::class, 'createUser'])->name('register.create');
    Route::post('/login', [UserController::class, 'getUser'])->name('login.validate');
});
