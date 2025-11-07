<?php

use App\Http\Controllers\Auth\ManualRegisteredUserController;
use App\Http\Controllers\Auth\ManualSessionController;
use Illuminate\Support\Facades\Route;

// Manual Authentication Routes
Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register-manual', [ManualRegisteredUserController::class, 'create'])
        ->name('register.manual');
    Route::post('/register-manual', [ManualRegisteredUserController::class, 'store']);

    // Login
    Route::get('/login-manual', [ManualSessionController::class, 'create'])
        ->name('login.manual');
    Route::post('/login-manual', [ManualSessionController::class, 'store']);
});

// Logout (requires authentication)
Route::middleware('auth')->group(function () {
    Route::post('/logout-manual', [ManualSessionController::class, 'destroy'])
        ->name('logout.manual');
});