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
Route::post('auth/login', [AuthController::class, 'store'])->name('login.store');
Route::get('auth/register', [RegisterController::class, 'index'])->name('register');
Route::post('auth/register', [RegisterController::class, 'store'])->name('register.store');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('candidato.onboarding')->with('success', 'Tu correo fue verificado correctamente.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.onboarding');
})->middleware('auth')->name('verification.notice');


Route::get('/candidato/home', function () {
    return view('candidato.home');
})->middleware(['auth', 'verified'])->name('candidato.home');

Route::prefix('candidato')->group(function () {
    Route::get('/', [CandidatoController::class, 'index'])->name('dashboard');
    Route::get('/onboarding', [CandidatoController::class, 'onboarding'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding');
    Route::get('/onboarding/fase-1', [CandidatoController::class, 'fase1DatosPersonales'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding.fase1');
    Route::post('/onboarding/fase-1', [CandidatoController::class, 'storeFase1DatosPersonales'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding.fase1.store');
    Route::get('/onboarding/fase-2', [CandidatoController::class, 'fase2PerfilProfesional'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding.fase2');
    Route::post('/onboarding/fase-2', [CandidatoController::class, 'storeFase2PerfilProfesional'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding.fase2.store');
    Route::get('/onboarding/fase-3', [CandidatoController::class, 'fase3PreferenciasLaborales'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding.fase3');
    Route::post('/onboarding/fase-3', [CandidatoController::class, 'storeFase3PreferenciasLaborales'])
        ->middleware(['auth', 'verified'])
        ->name('candidato.onboarding.fase3.store');

});
