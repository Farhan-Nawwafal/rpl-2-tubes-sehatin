<?php

use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/input-data', function() {
    return view ('app.input-data');
})->name('input.data');

Route::get('/journal', [JournalController::class, 'index'])->name('journal');
Route::get('/reminder', [ReminderController::class, 'index'])->name('reminder');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/register', [UserController::class, 'createUser'])->name('register.create');
Route::post('/login', [UserController::class, 'getUser'])->name('login.validate');
