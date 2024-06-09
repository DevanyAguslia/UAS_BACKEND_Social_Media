<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth')->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

