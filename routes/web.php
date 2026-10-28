<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\LapanganController;

Route::resource('lapangan', LapanganController::class);
