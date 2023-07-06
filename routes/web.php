<?php

use App\Http\Controllers\BlankController;
use App\Http\Controllers\Dashboards\OilTypeController as DashboardsOilTypeController;
use App\Http\Controllers\Operations\ExpenseController;
use App\Http\Controllers\Settings\MasterData\ClientController;
use App\Http\Controllers\Operations\PurchaseController;
use App\Http\Controllers\Operations\SaleController;
use App\Http\Controllers\Reports\Operations\PurchaseController as OperationsPurchaseController;
use App\Http\Controllers\Reports\Operations\SaleController as OperationsSaleController;
use App\Http\Controllers\Settings\AddressController;
use App\Http\Controllers\Settings\MasterData\ExpenseTypeController;
use App\Http\Controllers\Settings\MasterData\OilTypeController;
use App\Http\Controllers\Settings\MasterData\StaffController;
use App\Http\Controllers\Settings\MasterData\VendorController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['auth'])->group(function () {

    Route::middleware(['has.menu'])->group(function(){
                        

        Route::get('', function () {
            return redirect()->route('dashboard.oil-type.index');
        })->name('dashboard');

        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('oil-type',      [DashboardsOilTypeController::class, 'index'])->name('oil-type.index');
        });
                
        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            Route::group(['prefix' => 'accounting', 'as' => 'accounting.'], function () {
                Route::get('balancesheet',  [BlankController::class, 'index'])->name('balancesheet.index');
                Route::get('netincome',     [BlankController::class, 'index'])->name('netincome.index');
                Route::get('cashflow',      [BlankController::class, 'index'])->name('cashflow.index');
                Route::get('revenue',       [BlankController::class, 'index'])->name('revenue.index');
                Route::get('expense',       [BlankController::class, 'index'])->name('expense.index');
            });
    
            Route::group(['prefix' => 'operation', 'as' => 'operation.'], function () {
                Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {                    
                    Route::get('',                  [OperationsSaleController::class, 'index'])->name('index');
                    Route::get('download/{type?}',  [OperationsSaleController::class, 'download'])->name('download');
                });

                Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {                    
                    Route::get('',                  [OperationsPurchaseController::class, 'index'])->name('index');
                    Route::get('download/{type?}',  [OperationsPurchaseController::class, 'download'])->name('show');
                });
            });
        });
      
        Route::group(['prefix' => 'operation', 'as' => 'operation.'], function () {
            Route::group(['prefix' => 'sale', 'as' => 'sale.'], function () {
                Route::get('create',            [SaleController::class, 'create'])->name('create');
                Route::post('create',           [SaleController::class, 'store'])->name('store');
                Route::get('list',              [SaleController::class, 'index'])->name('index');
                Route::get('list/{id}',         [SaleController::class, 'show'])->name('show');
                Route::delete('list/{id}',      [SaleController::class, 'destroy'])->name('destroy');
                Route::patch('list/{id}',       [SaleController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [SaleController::class, 'edit'])->name('edit');
            });            
            
            Route::group(['prefix' => 'purchase', 'as' => 'purchase.'], function () {
                Route::get('create',            [PurchaseController::class, 'create'])->name('create');
                Route::post('create',           [PurchaseController::class, 'store'])->name('store');
                Route::get('list',              [PurchaseController::class, 'index'])->name('index');
                Route::get('list/{id}',         [PurchaseController::class, 'show'])->name('show');            
                Route::delete('list/{id}',      [PurchaseController::class, 'destroy'])->name('destroy');
                Route::post('photo/{id}',       [PurchaseController::class, 'updatePhoto'])->name('updatePhoto');
                Route::patch('list/{id}',       [PurchaseController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [PurchaseController::class, 'edit'])->name('edit');
            });                

            Route::group(['prefix' => 'account-receivable', 'as' => 'account-receivable.'], function () {
                Route::get('create',            [BlankController::class, 'create'])->name('create');
                Route::post('create',           [BlankController::class, 'store'])->name('store');
                Route::get('list',              [BlankController::class, 'index'])->name('index');
                Route::get('list/{id}',         [BlankController::class, 'show'])->name('show');
                Route::delete('list/{id}',      [BlankController::class, 'destroy'])->name('destroy');
                Route::patch('list/{id}',       [BlankController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [BlankController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'account-payable', 'as' => 'account-payable.'], function () {
                Route::get('create',            [BlankController::class, 'create'])->name('create');
                Route::post('create',           [BlankController::class, 'store'])->name('store');
                Route::get('list',              [BlankController::class, 'index'])->name('index');
                Route::get('list/{id}',         [BlankController::class, 'show'])->name('show');
                Route::delete('list/{id}',      [BlankController::class, 'destroy'])->name('destroy');
                Route::patch('list/{id}',       [BlankController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [BlankController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
                Route::get('create',            [ExpenseController::class, 'create'])->name('create');
                Route::post('create',           [ExpenseController::class, 'store'])->name('store');
                Route::get('list',              [ExpenseController::class, 'index'])->name('index');
                Route::get('list/{id}',         [ExpenseController::class, 'show'])->name('show');
                Route::delete('list/{id}',      [ExpenseController::class, 'destroy'])->name('destroy');
                Route::patch('list/{id}',       [ExpenseController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [ExpenseController::class, 'edit'])->name('edit');
            });                 
        });
        
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {

            Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function () {                            
                Route::get('oil-type',    [OilTypeController::class, 'index'])->name('oil-type.index');                
                Route::group(['prefix' => 'staff', 'as' => 'staff.'], function () {
                    Route::get('',          [StaffController::class, 'index'])->name('index');
                    Route::post('',         [StaffController::class, 'store'])->name('store');
                    Route::get('create',    [StaffController::class, 'create'])->name('create');
                    Route::delete('{id}',   [StaffController::class, 'destroy'])->name('destroy');
                    Route::patch('{id}',    [StaffController::class, 'update'])->name('update');
                    Route::get('{id}',      [StaffController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [StaffController::class, 'edit'])->name('edit');
                });
             
                Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {    
                    Route::get('',          [VendorController::class, 'index'])->name('index');
                    Route::post('',         [VendorController::class, 'store'])->name('store');
                    Route::get('create',    [VendorController::class, 'create'])->name('create');
                    Route::delete('{id}',   [VendorController::class, 'destroy'])->name('destroy');
                    Route::patch('{id}',    [VendorController::class, 'update'])->name('update');
                    Route::get('{id}',      [VendorController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [VendorController::class, 'edit'])->name('edit');
                });

                Route::group(['prefix' => 'client', 'as' => 'client.'], function () {                  
                    Route::get('',          [ClientController::class, 'index'])->name('index');
                    Route::post('',         [ClientController::class, 'store'])->name('store');
                    Route::get('create',    [ClientController::class, 'create'])->name('create');
                    Route::delete('{id}',   [ClientController::class, 'destroy'])->name('destroy');
                    Route::patch('{id}',    [ClientController::class, 'update'])->name('update');
                    Route::get('{id}',      [ClientController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [ClientController::class, 'edit'])->name('edit');
                });

                Route::group(['prefix' => 'expense-type', 'as' => 'expense-type.'], function () {
                    Route::get('',          [ExpenseTypeController::class, 'index'])->name('index');
                    Route::post('',         [ExpenseTypeController::class, 'store'])->name('store');
                    Route::get('create',    [ExpenseTypeController::class, 'create'])->name('create');
                    Route::delete('{id}',   [ExpenseTypeController::class, 'destroy'])->name('destroy');
                    Route::patch('{id}',    [ExpenseTypeController::class, 'update'])->name('update');
                    Route::get('{id}',      [ExpenseTypeController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [ExpenseTypeController::class, 'edit'])->name('edit');
                });          
            });

            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                Route::get('',          [BlankController::class, 'index'])->name('index');
                Route::post('',         [BlankController::class, 'store'])->name('store');
                Route::get('create',    [BlankController::class, 'create'])->name('create');
                Route::delete('{id}',   [BlankController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [BlankController::class, 'update'])->name('update');
                Route::get('{id}',      [BlankController::class, 'show'])->name('show');
                Route::get('{id}/edit', [BlankController::class, 'edit'])->name('edit');
            });
    
            Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
                Route::get('',          [BlankController::class, 'index'])->name('index');
                Route::post('',         [UserController::class, 'store'])->name('store');
                Route::get('create',    [BlankController::class, 'create'])->name('create');
                Route::delete('{id}',   [UserController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [UserController::class, 'update'])->name('update');
                Route::get('{id}',      [UserController::class, 'show'])->name('show');
                Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                Route::get('',          [ProfileController::class, 'index'])->name('index');
                Route::post('',         [ProfileController::class, 'store'])->name('store');
                Route::delete('{id}',   [ProfileController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [ProfileController::class, 'update'])->name('update');
                Route::get('{id}',      [ProfileController::class, 'show'])->name('show');
                Route::get('{id}/edit', [ProfileController::class, 'edit'])->name('edit');
            });
            Route::get('address/{type}/{id}', [AddressController::class, 'index'])->name('address');
        });                      
              
    });
});