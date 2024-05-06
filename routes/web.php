<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\Categorycontroller;
use \App\Http\Controllers\UserController;

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
    Route::get('/dashboard/products/{id}', ProductController::class. '@edit')->name('product.edit');
    Route::put('/dashboard/products/{id}', ProductController::class. '@update')->name('product.update');
    Route::delete('/dashboard/products/{id}', ProductController::class. '@destroy')->name('product.destroy');
    Route::get('/dashboard/category', Categorycontroller::class. '@index')->name('category');
    Route::post('/dashboard/category', Categorycontroller::class. '@store')->name('category.store');
    Route::get('/dashboard/category/{id}', Categorycontroller::class. '@edit')->name('category.edit');
    Route::put('/dashboard/category/{id}', Categorycontroller::class. '@update')->name('category.update');
    Route::delete('/dashboard/category/{id}', Categorycontroller::class. '@destroy')->name('category.destroy');
    Route::get('/dashboard/users', UserController::class. '@index')->name('users');
    Route::get('/dashboard/users/create', UserController::class. '@create')->name('user.create');
    Route::post('/dashboard/users/create', UserController::class. '@store')->name('user.store');
    Route::get('/dashboard/users/{id}', UserController::class. '@edit')->name('user.edit');
    Route::put('/dashboard/users/{id}', UserController::class. '@update')->name('user.update');
    Route::delete('dashboard/users/{id}', UserController::class. '@destroy')->name('user.destroy');
});
