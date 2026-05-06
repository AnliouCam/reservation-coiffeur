<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

Route::get('/', [ServiceController::class, 'index']);
Route::get('/reserver', [ServiceController::class, 'choisir']);
Route::get('/reserver/creneaux', [CreneauController::class, 'index']);
Route::get('/reserver/formulaire', [ReservationController::class, 'create']);
Route::post('/reserver/formulaire', [ReservationController::class, 'store']);
Route::get('/reserver/confirmation', [ReservationController::class, 'confirmation']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::patch('/admin/reservations/{reservation}/statut', [AdminController::class, 'updateStatut']);
    Route::get('/admin/creneaux', [AdminController::class, 'creneaux']);
    Route::post('/admin/creneaux', [AdminController::class, 'storeCreneau']);
    Route::patch('/admin/creneaux/{creneau}/toggle', [AdminController::class, 'toggleCreneau']);
});

require __DIR__.'/auth.php';
