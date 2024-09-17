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



//API de connéxion
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //API creéation de profil
    Route::post('/profil', [ProfileController::class, 'store']);
    //API de déconnexion
    Route::post('/logout', [AuthController::class, 'logout']);
    //API de supression ou modification
    Route::put('/profil/{id}', [ProfileController::class, 'update']);
    Route::delete('/profil/{id}', [ProfileController::class, 'destroy']);
});

//API liste profils actifs
Route::get('/profils/actifs', [ProfileController::class, 'profils_actifs'])
    ->middleware('auth.optional:sanctum');