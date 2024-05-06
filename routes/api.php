<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Auth\Middleware\Authenticate;
use \App\Http\Controllers\Api\Categorycontroller;

/**
 * @OA\Get(
 *     path="/api/v1/welcome",
 *     tags={"Welcome"},
 *     summary="Welcome message",
 *     @OA\Response( response=200, description="Success"),
 *     @OA\Response( response=401, description="Unauthorized"),
 *     @OA\Response( response=403, description="Forbidden"),
 *     @OA\Response( response=500, description="Internal Server Error"),
 *     @OA\Response( response=404, description="Not Found"),
 *     @OA\Response( response=422, description="Unprocessable Entity"),
 *     )
 */
Route::prefix('v1')->group(function () {
    Route::post('/user/register', UserController::class . '@store')->name('api_register');
    Route::post('/user/login', UserController::class . '@login')->name('api_login');
    Route::get('/welcome', function () {
        return response()->json(['message' => 'Bienvenue sur notre API de gestion de produits']);
    });
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/user', UserController::class . '@index')->name('user');
    Route::get('/user/{id}', UserController::class . '@show')->name('show');
    Route::put('/user/{id}', UserController::class . '@update')->name('update');
    Route::delete('/user/{id}', UserController::class . '@destroy')->name('delete');
    Route::apiResource('products', ProductController::class);
    Route::get('/category/{id}/products', Categorycontroller::class . '@productsByCategory')->name('productsByCategory');
    Route::apiResource('category', Categorycontroller::class);
});


