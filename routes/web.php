<?php

use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminVerificationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HirerApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkerDashboardController;
use App\Http\Controllers\WorkerJobController;
use App\Http\Controllers\WorkerProfileController;
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
            'hirer'  => redirect()->route('hirer.dashboard'),
            'worker' => redirect()->route('worker.dashboard'),
            'admin'  => redirect()->route('admin.dashboard'),
            default  => abort(403),
        };
    })->name('dashboard');

    Route::get('/hirer/dashboard', [JobController::class, 'dashboard'])
        ->middleware('role:hirer')
        ->name('hirer.dashboard');

    Route::middleware('role:hirer')->group(function () {
        Route::get('/hirer/jobs', [JobController::class, 'index'])
            ->name('hirer.jobs.index');

        Route::get('/hirer/jobs/create', [JobController::class, 'create'])
            ->name('hirer.jobs.create');

        Route::post('/hirer/jobs', [JobController::class, 'store'])
            ->name('hirer.jobs.store');

        Route::get('/hirer/jobs/{job}', [JobController::class, 'show'])
            ->name('hirer.jobs.show');

        Route::get('/hirer/jobs/{job}/applications', [HirerApplicationController::class, 'index'])
            ->name('hirer.applications.index');

        Route::post('/hirer/jobs/{job}/select-worker/{workerId}', [HirerApplicationController::class, 'select'])
            ->name('hirer.applications.select');

        Route::get('/hirer/assigned-work', [WorkController::class, 'hirerIndex'])
            ->name('hirer.work.index');

        Route::post('/hirer/jobs/{job}/complete', [WorkController::class, 'complete'])
            ->name('hirer.jobs.complete');

        Route::get('/hirer/jobs/{job}/review', [ReviewController::class, 'create'])
            ->name('hirer.reviews.create');

        Route::post('/hirer/jobs/{job}/review', [ReviewController::class, 'store'])
            ->name('hirer.reviews.store');
    });

    Route::get('/worker/dashboard', [WorkerDashboardController::class, 'index'])
        ->middleware('role:worker')
        ->name('worker.dashboard');

    Route::middleware('role:worker')->group(function () {
        Route::get('/worker/profile/create', [WorkerProfileController::class, 'create'])
            ->name('worker.profile.create');

        Route::post('/worker/profile', [WorkerProfileController::class, 'store'])
            ->name('worker.profile.store');

        Route::get('/worker/profile/edit', [WorkerProfileController::class, 'edit'])
            ->name('worker.profile.edit');

        Route::put('/worker/profile', [WorkerProfileController::class, 'update'])
            ->name('worker.profile.update');

        Route::get('/worker/jobs', [WorkerJobController::class, 'index'])
            ->name('worker.jobs.index');

        Route::get('/worker/jobs/{job}', [WorkerJobController::class, 'show'])
            ->name('worker.jobs.show');

        Route::get('/worker/applications', [ApplicationController::class, 'index'])
            ->name('worker.applications.index');

        Route::get('/worker/jobs/{job}/apply', [ApplicationController::class, 'create'])
            ->name('worker.applications.create');

        Route::post('/worker/jobs/{job}/apply', [ApplicationController::class, 'store'])
            ->name('worker.applications.store');

        Route::get('/worker/assigned-work', [WorkController::class, 'workerIndex'])
            ->name('worker.work.index');
    });

    Route::middleware('role:admin')->group(function () {

        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/admin/users', [AdminUserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])
            ->name('admin.users.show');

        Route::patch('/admin/users/{user}/status', [AdminUserController::class, 'toggleStatus'])
            ->name('admin.users.status');

        Route::get('/admin/jobs', [AdminJobController::class, 'index'])
            ->name('admin.jobs.index');

        Route::get('/admin/jobs/{job}', [AdminJobController::class, 'show'])
            ->name('admin.jobs.show');

        Route::get('/admin/applications', [AdminApplicationController::class, 'index'])
            ->name('admin.applications.index');

        Route::get('/admin/applications/{application}', [AdminApplicationController::class, 'show'])
            ->name('admin.applications.show');

        Route::get('/admin/reviews', [AdminReviewController::class, 'index'])
            ->name('admin.reviews.index');

        Route::get('/admin/reviews/{review}', [AdminReviewController::class, 'show'])
            ->name('admin.reviews.show');

        Route::get('/admin/verification', [AdminVerificationController::class, 'index'])
            ->name('admin.verification.index');

        Route::patch('/admin/verification/{workerProfile}', [AdminVerificationController::class, 'update'])
            ->name('admin.verification.update');

    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
