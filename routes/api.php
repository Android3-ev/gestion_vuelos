<?php

use App\Http\Controllers\AsientosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TiposDocumentoController;
use App\Http\Controllers\VuelosController;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::get('aviones', [AvionController::class, 'index']);

Route::get('roles', [RolController::class, 'index']);

Route::get('tipos', [TiposDocumentoController::class, 'index']);

Route::apiResource('vuelos', VuelosController::class);

Route::apiResource('reservas', ReservaController::class);

Route::apiResource('asientos', AsientosController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('logout', [AuthController::class, 'logout']);
});
