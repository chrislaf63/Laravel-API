<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

route::prefix('v1')->group(function () {
    route::apiResource('user', UserController::class);
    Route::apiResource('products', ProductController::class);
});
