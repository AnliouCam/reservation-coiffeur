<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CreneauController;

Route::get('/', [ServiceController::class, 'index']);
Route::get('/reserver', [ServiceController::class, 'choisir']);
Route::get('/reserver/creneaux', [CreneauController::class, 'index']);
