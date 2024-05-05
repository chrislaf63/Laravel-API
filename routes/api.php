<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Auth\Middleware\Authenticate;
use \App\Http\Controllers\Api\Categorycontroller;


Route::prefix('v1')->group(function () {
    Route::post('/user/register', UserController::class . '@store')->name('api_register');
    Route::post('/user/login', UserController::class . '@login')->name('api_login');
});
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/user', UserController::class . '@index')->name('user');
    Route::put('/user/{id}', UserController::class . '@update')->name('update');
    Route::delete('/user/{id}', UserController::class . '@destroy')->name('delete');
    Route::apiResource('products', ProductController::class);
    Route::apiResource('category', Categorycontroller::class);
});


