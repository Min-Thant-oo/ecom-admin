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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home.home');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/admin/login', [AuthController::class, 'login'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'post_login']);
});



Route::middleware(['admin'])->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout']);

    Route::get('/admin/home', [HomeController::class, 'home']);

    Route::get('/admin/products', [ProductController::class, 'products']);
    Route::get('/admin/products/create', [ProductController::class, 'productCreate']);
    Route::post('/admin/products/store', [ProductController::class, 'productStore']);
    Route::get('/admin/products/{product:id}/edit', [ProductController::class, 'productEdit']);
    Route::patch('/admin/products/{product:id}/update', [ProductController::class, 'productUpdate']);
    Route::delete('/admin/products/{product:id}/delete', [ProductController::class, 'productDestroy']);

    Route::get('/admin/categories', [CategoryController::class, 'category']);
    Route::get('/admin/categories/create', [CategoryController::class, 'categoryCreate']);
    Route::post('/admin/categories/store', [CategoryController::class, 'categoryStore']);
    Route::get('/admin/categories/{category:id}/edit', [CategoryController::class, 'categoryEdit']);
    Route::patch('/admin/categories/{category:id}/update', [CategoryController::class, 'categoryUpdate']);
    Route::delete('/admin/categories/{category:id}/delete', [CategoryController::class, 'categoryDestory']);

    Route::get('/admin/users', [UserController::class, 'user']);

    Route::get('/admin/orders', [OrderController::class, 'order']);
    Route::get('/admin/orders/{order:id}/viewreceipt', [OrderController::class, 'viewReceipt']);

    Route::get('/admin/contactmessages', [ContactUsController::class, 'contactMessages']);
    Route::delete('/admin/contactmessages/{contactmessage:id}/delete', [ContactUsController::class, 'contactMessagesDestroy']);

    Route::get('/admin/info', [AdminController::class, 'admin_info']);
    Route::patch('/admin/info/{user:id}/update', [AdminController::class, 'admin_info_update']);
});
