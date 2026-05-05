<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::get('/', [ServiceController::class, 'index']);
Route::get('/reserver', [ServiceController::class, 'choisir']);
