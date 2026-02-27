<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homePage');
});

// AUTH
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

//LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// MERCHANT
Route::middleware(['auth', 'role:merchant'])->group(function () {
    Route::get('/merchant', [MerchantController::class, 'index']);
    Route::get('/merchant/profile', [MerchantProfileController::class, 'getProfile']);
    Route::get('/merchant/profile/edit', [MerchantProfileController::class, 'edit']);
    Route::post('/merchant/profile', [MerchantProfileController::class, 'update']);

    //menu CRUD 
    Route::get('/merchant/menus', [MenuController::class, 'index']);
    Route::get('/merchant/menus/create', [MenuController::class, 'create']);
    Route::post('/merchant/menus', [MenuController::class, 'store']);
    //edit 
    Route::get('/merchant/menus/{menu}/edit', [MenuController::class, 'edit']);
    Route::put('/merchant/menus/{menu}', [MenuController::class, 'update']);
    //delete
    Route::delete('/merchant/menus/{menu}', [MenuController::class, 'destroy']);
});

// CUSTOMER
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer', [CustomerController::class, 'index']);

    //order
    Route::get('/menus', [CustomerController::class, 'getMenu']);
    Route::get('/menus/{menu}/order', [OrderController::class, 'create']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/invoice/{order}', [InvoiceController::class, 'show']);
});
