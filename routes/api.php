<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SocialAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function() {
    Route::get('authenticated', [AuthController::class, 'checkUserStatus']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('update-profile', [AuthController::class, 'profileUpdate']);

    //product
    Route::resource('products', ProductController::class);

    //cart
    // Route::get('cart-item', [CartController::class, 'item']);
    // Route::post('add-to-cart', [CartController::class, 'addToCart']);
    // Route::post('remove-cart', [CartController::class, 'remove']);

    Route::get('cart-item', [CartController::class, 'item']);
    Route::post('add-to-cart', [CartController::class, 'addToCart']);
    Route::post('remove-cart', [CartController::class, 'remove']);
    Route::post('update-cart', [CartController::class, 'updateCart']);
    Route::post('decrement-quantity', [CartController::class, 'decrementQuantity']);

    //role permission
    Route::post('assign-role', [RoleController::class, 'assignRole']);
    Route::get('user-permissions', [RoleController::class, 'getUserPermissions']);
});
