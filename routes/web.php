
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LapanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Semua halaman yang membutuhkan login
Route::middleware('auth')->group(function () {

    // Dashboard bawaan Breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Dashboard khusus Admin
    Route::get('/admin/dashboard', function () {
        return 'Halo Admin! Ini halaman khusus admin.';
    })->middleware('admin');

    // Dashboard khusus Pelanggan
    Route::get('/pelanggan/dashboard', function () {
        if (auth()->user()->role !== 'pelanggan') {
            abort(403, 'Unauthorized. Khusus Pelanggan!');
        }

        return 'Halo Pelanggan! Selamat datang di Sistem Venue.';
    });

    // CRUD Lapangan khusus Admin
    Route::middleware('admin')->group(function () {
        Route::resource('lapangan', LapanganController::class)
            ->except(['index', 'show']);
    });

    // Admin dan Pelanggan boleh melihat daftar lapangan
    Route::get('/lapangan', [LapanganController::class, 'index'])
        ->name('lapangan.index');

    // Admin dan Pelanggan boleh melihat detail lapangan
    Route::get('/lapangan/{lapangan}', [LapanganController::class, 'show'])
        ->name('lapangan.show');

    // Profile Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

// Route login, register, logout, dan autentikasi Breeze
require __DIR__.'/auth.php';
