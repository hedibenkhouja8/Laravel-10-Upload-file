<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/profil', [ProfileController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/profil/{id}', [ProfileController::class, 'update']);
    Route::delete('/profil/{id}', [ProfileController::class, 'destroy']);
});

Route::get('/profils/actifs', [ProfileController::class, 'profils_actifs'])
    ->middleware('auth.optional:sanctum');