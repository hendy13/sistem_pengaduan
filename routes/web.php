<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman utama redirect ke form pengaduan
Route::get('/', function () {
    return redirect()->route('pengaduan.create');
});

// Routes untuk pengaduan (tanpa login)
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/buat', [PengaduanController::class, 'index'])->name('create');
    Route::post('/buat', [PengaduanController::class, 'store'])->name('store');
    Route::get('/sukses/{kode_unik}', [PengaduanController::class, 'success'])->name('success');
    Route::get('/lacak', [PengaduanController::class, 'track'])->name('track');
    Route::post('/lacak', [PengaduanController::class, 'checkStatus'])->name('check-status');
});

// Routes untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pengaduan/{pengaduan}', [DashboardController::class, 'show'])->name('pengaduan.show');
        Route::patch('/pengaduan/{pengaduan}/status', [DashboardController::class, 'updateStatus'])->name('pengaduan.update-status');
        Route::delete('/pengaduan/{pengaduan}', [DashboardController::class, 'destroy'])->name('pengaduan.destroy');
    });
});
