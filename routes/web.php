<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth/login', [AuthController::class, 'index'])->name('login');
Route::get('auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('auth/register', [RegisterController::class, 'store'])->name('register.store');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('candidato/onboarding')->with('success', 'Tu correo fue verificado correctamente.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.onboarding');
})->middleware('auth')->name('verification.notice');


Route::get('/candidato/home', function () {
    return view('candidato.home');
})->middleware(['auth', 'verified'])->name('candidato.home');

Route::prefix('candidato')->group(function () {
    Route::get('/', [CandidatoController::class, 'index'])->name('dashboard');

});
