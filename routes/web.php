<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\InstrukturController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| A. ROUTE PUBLIK (tanpa middleware)
|--------------------------------------------------------------------------
| Hanya pintu masuk: diteruskan ke dashboard (yang sendiri dilindungi auth).
*/
Route::get('/', fn () => redirect()->route('dashboard'));

/*
|--------------------------------------------------------------------------
| B. ROUTE GUEST (hanya untuk yang BELUM login)
|--------------------------------------------------------------------------
| Fitur register tidak ada di aplikasi asli, jadi tidak dibuat.
| throttle:login = rate limiter "login" di AppServiceProvider.
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('login.proses');
});

/*
|--------------------------------------------------------------------------
| C. ROUTE AUTH (wajib login, semua role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Pintu dashboard: meneruskan admin ke dashboard admin, user ke dashboard user.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | D. ROUTE ADMIN (role:admin) - pengelolaan data (CRUD)
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        Route::resource('alat', AlatController::class)->except('show')->parameters(['alat' => 'alat']);
        Route::resource('instruktur', InstrukturController::class)->except('show')->parameters(['instruktur' => 'instruktur']);
        Route::resource('lapangan', LapanganController::class)->except('show')->parameters(['lapangan' => 'lapangan']);
        Route::resource('pelanggan', PelangganController::class)->except('show')->parameters(['pelanggan' => 'pelanggan']);
        Route::resource('users', UserController::class)->except('show')->parameters(['users' => 'user']);
    });

    /*
    |----------------------------------------------------------------------
    | E. ROUTE USER (role:user) - dashboard + informasi (hanya baca)
    |----------------------------------------------------------------------
    */
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
        Route::get('/lapangan', [InformasiController::class, 'lapangan'])->name('lapangan');
        Route::get('/instruktur', [InformasiController::class, 'instruktur'])->name('instruktur');
        Route::get('/alat', [InformasiController::class, 'alat'])->name('alat');
    });
});
