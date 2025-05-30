<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Route::post('/login', [AuthController::class, 'login']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// // CRUD de clientes, solo accesible estando logueado
// Route::middleware('auth:sanctum')->group(function () {
//   Route::apiResource('clientes', ClienteController::class);
//   // …otras resources: encuestas, preguntas…
// });
