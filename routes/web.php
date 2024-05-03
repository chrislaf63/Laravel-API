<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard/products', ProductController::class. '@index')->name('products');
    Route::get('/dashboard/products/create', ProductController::class. '@create')->name('product.create');
    Route::post('/dashboard/product/create', ProductController::class. '@store')->name('product.store');
    Route::get('/products/{id}', ProductController::class. '@edit')->name('product.edit');
    Route::put('/products/{id}', ProductController::class. '@update')->name('product.update');
    Route::delete('/products/{id}', ProductController::class. '@destroy')->name('product.destroy');

});
