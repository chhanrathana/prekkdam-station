<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\CustomerController;
use App\Http\Controllers\MasterData\ProductTypeController;
use App\Http\Controllers\MasterData\ProductController;
use App\Http\Controllers\MasterData\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});


Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('',          [DashboardController::class, 'index'])->name('index');  
});

Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function () {

    Route::group(['prefix' => 'product-type', 'as' => 'product-type.'], function () {
        Route::get('',          [ProductTypeController::class, 'index'])->name('index');  
        Route::get('create',    [ProductTypeController::class, 'create'])->name('create');  
        Route::post('',         [ProductTypeController::class, 'store'])->name('store');  
        Route::get('{id}/edit', [ProductTypeController::class, 'edit'])->name('edit');  
        Route::patch('{id}',    [ProductTypeController::class, 'update'])->name('update');  
        Route::delete('{id}',   [ProductTypeController::class, 'destroy'])->name('destroy');  
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('',          [ProductController::class, 'index'])->name('index');  
        Route::get('create',    [ProductController::class, 'create'])->name('create');  
        Route::post('',         [ProductController::class, 'store'])->name('store');  
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');  
        Route::patch('{id}',    [ProductController::class, 'update'])->name('update');  
        Route::delete('{id}',   [ProductController::class, 'destroy'])->name('destroy');  
    }); 
    
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('',          [CustomerController::class, 'index'])->name('index');  
        Route::get('create',    [CustomerController::class, 'create'])->name('create');  
        Route::post('',         [CustomerController::class, 'store'])->name('store');  
        Route::get('{id}/edit', [CustomerController::class, 'edit'])->name('edit');  
        Route::patch('{id}',    [CustomerController::class, 'update'])->name('update');  
        Route::delete('{id}',   [CustomerController::class, 'destroy'])->name('destroy');  
    }); 

    Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
        Route::get('',          [VendorController::class, 'index'])->name('index');  
        Route::get('create',    [VendorController::class, 'create'])->name('create');  
        Route::post('',         [VendorController::class, 'store'])->name('store');  
        Route::get('{id}/edit', [VendorController::class, 'edit'])->name('edit');  
        Route::patch('{id}',    [VendorController::class, 'update'])->name('update');  
        Route::delete('{id}',   [VendorController::class, 'destroy'])->name('destroy');  
    }); 
});
