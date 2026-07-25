<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'hirer' => redirect()->route('hirer.dashboard'),
            'worker' => redirect()->route('worker.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => abort(403),
        };
    })->name('dashboard');

    Route::get('/hirer/dashboard', function () {
        return 'Hirer Dashboard';
    })->middleware('role:hirer')->name('hirer.dashboard');

    Route::get('/worker/dashboard', function () {
        return 'Worker Dashboard';
    })->middleware('role:worker')->name('worker.dashboard');

    Route::get('/admin/dashboard', function () {
        return 'Admin Dashboard';
    })->middleware('role:admin')->name('admin.dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});