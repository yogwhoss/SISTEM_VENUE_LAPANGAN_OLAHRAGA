<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.proses');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', fn () => redirect()->route('pelanggan.index'));

    Route::resource('pelanggan', PelangganController::class)->only(['index']);

    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('pelanggan', PelangganController::class)
            ->only(['create', 'store', 'edit', 'update']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('pelanggan', PelangganController::class)->only(['destroy']);
    });
});
