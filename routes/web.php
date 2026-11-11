
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('lapangan', LapanganController::class);

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized. Khusus Admin!');
        }

        return "Halo Admin! Ini halaman khusus admin.";
    });

    Route::get('/mahasiswa/dashboard', function () {
        return "Halo Mahasiswa! Ini halaman venue.";
    });

});
