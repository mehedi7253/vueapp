<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('authenticated', [AuthController::class, 'checkUserStatus']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('update-profile', [AuthController::class, 'profileUpdate']);
});
