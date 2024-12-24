<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'post_login'])->name('login.post');
});


Route::middleware(['admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/info', [AdminController::class, 'edit'])->name('info.edit');
    Route::patch('/info/update', [AdminController::class, 'update'])->name('info.update');
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('products', ProductController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('orders', OrderController::class)->only('index', 'show');
    Route::resource('contactmessages', ContactUsController::class)->only('index', 'destroy');
    
});
