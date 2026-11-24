<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/dashboard', function () {
        return 'Halo Admin! Ini halaman khusus admin.';
    })->middleware('admin');

    Route::get('/pelanggan/dashboard', function () {
        if (auth()->user()->role !== 'pelanggan') {
            abort(403, 'Unauthorized. Khusus Pelanggan!');
        }

        return 'Halo Pelanggan! Selamat datang di Sistem Venue.';
    });

    Route::middleware('admin')->group(function () {
        Route::resource('lapangan', LapanganController::class)
            ->except(['index', 'show']);
    });

    Route::get('/lapangan', [LapanganController::class, 'index'])
        ->name('lapangan.index');

    Route::get('/lapangan/{lapangan}', [LapanganController::class, 'show'])
        ->name('lapangan.show');

    Route::resource('pelanggan', PelangganController::class);
    Route::resource('instruktur', InstrukturController::class);
    Route::resource('alat', AlatController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';
