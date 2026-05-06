<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\ReservationController;

Route::get('/', [ServiceController::class, 'index']);
Route::get('/reserver', [ServiceController::class, 'choisir']);
Route::get('/reserver/creneaux', [CreneauController::class, 'index']);
Route::get('/reserver/formulaire', [ReservationController::class, 'create']);
Route::post('/reserver/formulaire', [ReservationController::class, 'store']);
