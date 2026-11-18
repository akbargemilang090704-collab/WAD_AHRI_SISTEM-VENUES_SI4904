<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatOlahragaController;

Route::redirect('/', '/alat-olahraga');
Route::resource('alat-olahraga', AlatOlahragaController::class)->only(['index', 'store', 'update', 'destroy']);
