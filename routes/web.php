<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PaymentController::class, 'index'])->name('home');

// Payment routes (public)
Route::prefix('payment')->group(function () {
    Route::get('/', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/track', [PaymentController::class, 'trackStatus'])->name('payment.track');
    Route::get('/check', [PaymentController::class, 'checkPaymentStatus'])->name('payment.check');
    Route::get('/detail/{id}', [PaymentController::class, 'showDetail'])->name('payment.detail');
});

// Dashboard redirect to admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin routes (authenticated)
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Payments management
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/payments/{id}', [AdminController::class, 'show'])->name('payments.show');
    Route::post('/payments/{id}/verify', [AdminController::class, 'verify'])->name('payments.verify');
    Route::post('/payments/{id}/reject', [AdminController::class, 'reject'])->name('payments.reject');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
    
    // Payment Types management
    Route::resource('payment-types', PaymentTypeController::class, ['except' => ['show']]);
    
    // Settings module
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/smtp', [SettingController::class, 'updateSmtp'])->name('settings.smtp.update');
    Route::post('/settings/smtp/test', [SettingController::class, 'testSmtp'])->name('settings.smtp.test');
    
    // Reports module
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/daily', [ReportController::class, 'daily'])->name('daily');
        Route::get('/monthly', [ReportController::class, 'monthly'])->name('monthly');
        Route::get('/yearly', [ReportController::class, 'yearly'])->name('yearly');
        Route::get('/custom', [ReportController::class, 'custom'])->name('custom');
        Route::post('/export', [ReportController::class, 'export'])->name('export');
    });
    
    // User management - accessible by both super admin and finance admin
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
    // User management - accessible by super admin only
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Finance admin can only create/edit/delete finance admin users
    Route::get('/finance-users/create', [UserController::class, 'create'])->name('finance-users.create');
    Route::post('/finance-users', [UserController::class, 'store'])->name('finance-users.store');
    Route::get('/finance-users/{user}/edit', [UserController::class, 'edit'])->name('finance-users.edit');
    Route::put('/finance-users/{user}', [UserController::class, 'update'])->name('finance-users.update');
    Route::delete('/finance-users/{user}', [UserController::class, 'destroy'])->name('finance-users.destroy');
});

// User profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
