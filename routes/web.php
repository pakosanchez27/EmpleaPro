<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth/login', [AuthController::class, 'index'])->name('login');
Route::get('auth/register', [RegisterController::class, 'index'])->name('register');
