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
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/profil', [ProfileController::class, 'store']);
/*Route::middleware('auth:sanctum')->group(function () {
    Route::post('/profil', [ProfileController::class, 'store']);
});*/
Route::middleware('auth:sanctum')->get('/check-login', function (Request $request) {
    return response()->json([
        'authenticated' => true,
        'user' => $request->user(),
    ], 200);
});
