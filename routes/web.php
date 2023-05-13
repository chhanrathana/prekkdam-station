<?php

use App\Http\Controllers\BlankController;
use App\Http\Controllers\Dashboards\DepositController;
use App\Http\Controllers\Dashboards\LoanController;
use App\Http\Controllers\Operations\ClientController;
use App\Http\Controllers\Operations\Deposits\PaymentController;
use App\Http\Controllers\Operations\Deposits\RequestController as DepositsRequestController;
use App\Http\Controllers\Operations\ExpenseController as OperationsExpenseController;
use App\Http\Controllers\Operations\Loans\PaymentController as LoansPaymentController;
use App\Http\Controllers\Operations\Loans\RequestController;
use App\Http\Controllers\Operations\Memberships\PaymentController as MembershipsPaymentController;
use App\Http\Controllers\Operations\Memberships\RequestController as MembershipsRequestController;
use App\Http\Controllers\Operations\RevenueController as OperationsRevenueController;
use App\Http\Controllers\Reports\Accountings\BalancesheetController;
use App\Http\Controllers\Reports\Accountings\CashFlowController;
use App\Http\Controllers\Reports\Accountings\NetIncomeController;
use App\Http\Controllers\Reports\Accountings\RevenueController;
use App\Http\Controllers\Reports\Accountings\ExpenseController;
use App\Http\Controllers\Settings\AddressController;
use App\Http\Controllers\Settings\MasterData\CalendarController;
use App\Http\Controllers\Settings\MasterData\DepositController as MasterDataDepositController;
use App\Http\Controllers\Settings\MasterData\ExpenseTypeController;
use App\Http\Controllers\Settings\MasterData\LoanController as MasterDataLoanController;
use App\Http\Controllers\Settings\MasterData\RevenueTypeController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Settings\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['auth'])->group(function () {

    Route::middleware(['has.menu'])->group(function(){
                        

        Route::get('', function () {
            return redirect()->route('dashboard.loan.index');
        })->name('dashboard');

        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('loan',      [LoanController::class, 'index'])->name('loan.index');
            Route::get('deposit',   [DepositController::class, 'index'])->name('deposit.index');
        });
                
        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
            Route::group(['prefix' => 'accounting', 'as' => 'accounting.'], function () {
                Route::get('balancesheet',  [BalancesheetController::class, 'index'])->name('balancesheet.index');
                Route::get('netincome',     [NetIncomeController::class, 'index'])->name('netincome.index');
                Route::get('cashflow',      [CashFlowController::class, 'index'])->name('cashflow.index');
                Route::get('revenue',       [RevenueController::class, 'index'])->name('revenue.index');
                Route::get('expense',       [ExpenseController::class, 'index'])->name('expense.index');
            });
    
            Route::group(['prefix' => 'operation', 'as' => 'operation.'], function () {
                Route::get('loan',          [LoanController::class, 'index'])->name('loan.index');
                Route::get('deposit',       [LoanController::class, 'index'])->name('deposit.index');
            });
        });
      
        Route::group(['prefix' => 'operation', 'as' => 'operation.'], function () {
            // loans transaction
            Route::group(['prefix' => 'loan', 'as' => 'loan.'], function () {
                Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
                    Route::get('',          [LoansPaymentController::class, 'index'])->name('index');
                    Route::get('{id}/edit', [LoansPaymentController::class, 'edit'])->name('edit');
                    Route::patch('{id}',    [LoansPaymentController::class, 'update'])->name('update');
                });
                
                Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
                    Route::get('download',          [RequestController::class, 'download'])->name('download');            
                    Route::get('create',            [RequestController::class, 'create'])->name('create');
                    Route::post('create',           [RequestController::class, 'store'])->name('store');
                    Route::get('list',              [RequestController::class, 'index'])->name('index');
                    Route::get('list/{id}',         [RequestController::class, 'show'])->name('show');            
                    Route::delete('list/{id}',      [RequestController::class, 'destroy'])->name('destroy');
                    Route::patch('list/{id}',       [RequestController::class, 'update'])->name('update');
                    Route::get('list/{id}/edit',    [RequestController::class, 'edit'])->name('edit');
                });            
            });

            Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function () {
                Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
                    Route::get('',          [PaymentController::class, 'index'])->name('index');
                    Route::get('{id}/edit', [PaymentController::class, 'edit'])->name('edit');
                    Route::patch('{id}',    [PaymentController::class, 'update'])->name('update');
                });
                
                Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
                    Route::get('download',          [DepositsRequestController::class, 'download'])->name('download');            
                    Route::get('create',            [DepositsRequestController::class, 'create'])->name('create');
                    Route::post('create',           [DepositsRequestController::class, 'store'])->name('store');
                    Route::get('list',              [DepositsRequestController::class, 'index'])->name('index');
                    Route::get('list/{id}',         [DepositsRequestController::class, 'show'])->name('show');            
                    Route::delete('list/{id}',      [DepositsRequestController::class, 'destroy'])->name('destroy');
                    Route::post('photo/{id}',       [DepositsRequestController::class, 'updatePhoto'])->name('updatePhoto');
                    Route::patch('list/{id}',       [DepositsRequestController::class, 'update'])->name('update');
                    Route::get('list/{id}/edit',    [DepositsRequestController::class, 'edit'])->name('edit');
                });                
            });

            Route::group(['prefix' => 'membership', 'as' => 'membership.'], function () {
                Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
                    Route::get('',          [MembershipsPaymentController::class, 'index'])->name('index');
                    Route::get('{id}/edit', [MembershipsPaymentController::class, 'edit'])->name('edit');
                    Route::patch('{id}',    [MembershipsPaymentController::class, 'update'])->name('update');
                });
                
                Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
                    Route::get('download',          [MembershipsRequestController::class, 'download'])->name('download');            
                    Route::get('create',            [MembershipsRequestController::class, 'create'])->name('create');
                    Route::post('create',           [MembershipsRequestController::class, 'store'])->name('store');
                    Route::get('list',              [MembershipsRequestController::class, 'index'])->name('index');
                    Route::get('list/{id}',         [MembershipsRequestController::class, 'show'])->name('show');            
                    Route::delete('list/{id}',      [MembershipsRequestController::class, 'destroy'])->name('destroy');
                    Route::post('photo/{id}',       [MembershipsRequestController::class, 'updatePhoto'])->name('updatePhoto');
                    Route::patch('list/{id}',       [MembershipsRequestController::class, 'update'])->name('update');
                    Route::get('list/{id}/edit',    [MembershipsRequestController::class, 'edit'])->name('edit');
                });
            });

            Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
                Route::get('create',            [OperationsExpenseController::class, 'create'])->name('create');
                Route::post('create',           [OperationsExpenseController::class, 'store'])->name('store');            
                Route::get('list',              [OperationsExpenseController::class, 'index'])->name('index');
                Route::get('list/{id}',         [OperationsExpenseController::class, 'show'])->name('show');
                Route::delete('list/{id}',      [OperationsExpenseController::class, 'destroy'])->name('destroy');
                Route::patch('list/{id}',       [OperationsExpenseController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [OperationsExpenseController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'revenue', 'as' => 'revenue.'], function () {
                Route::get('create',            [OperationsRevenueController::class, 'create'])->name('create');
                Route::post('create',           [OperationsRevenueController::class, 'store'])->name('store');
                Route::get('list',              [OperationsRevenueController::class, 'index'])->name('index');
                Route::get('list/{id}',         [OperationsRevenueController::class, 'show'])->name('show');
                Route::delete('list/{id}',      [OperationsRevenueController::class, 'destroy'])->name('destroy');
                Route::patch('list/{id}',       [OperationsRevenueController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [OperationsRevenueController::class, 'edit'])->name('edit');
            });

            Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
                Route::get('create',            [ClientController::class, 'create'])->name('create');
                Route::post('create',           [ClientController::class, 'store'])->name('store');
                Route::get('list',              [ClientController::class, 'index'])->name('index');
                Route::get('list/{id}',         [ClientController::class, 'show'])->name('show');            
                Route::post('photo/{id}',       [ClientController::class, 'updatePhoto'])->name('updatePhoto');
                Route::patch('list/{id}',       [ClientController::class, 'update'])->name('update');
                Route::get('list/{id}/edit',    [ClientController::class, 'edit'])->name('edit');
            });
        });
        
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
            Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function () {            
                Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function () {
                    Route::get('',          [CalendarController::class, 'index'])->name('index');
                    Route::get('download',  [CalendarController::class, 'download'])->name('download');
                    Route::post('',         [CalendarController::class, 'store'])->name('store');
                    Route::get('create',    [CalendarController::class, 'create'])->name('create');
                    Route::delete('{id}',   [CalendarController::class, 'destroy'])->name('destroy');
                    Route::patch('{id}',    [CalendarController::class, 'update'])->name('update');
                    Route::get('{id}',      [CalendarController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [CalendarController::class, 'edit'])->name('edit');
                });
    
                Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function () {
                    Route::get('',          [MasterDataDepositController::class, 'index'])->name('index');
                });
             
                Route::group(['prefix' => 'loan', 'as' => 'loan.'], function () {    
                    Route::get('',          [MasterDataLoanController::class, 'index'])->name('index');
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
    
                 Route::group(['prefix' => 'revenue-type', 'as' => 'revenue-type.'], function () {
                    Route::get('',          [RevenueTypeController::class, 'index'])->name('index');
                    Route::post('',         [RevenueTypeController::class, 'store'])->name('store');
                    Route::get('create',    [RevenueTypeController::class, 'create'])->name('create');
                    Route::delete('{id}',   [RevenueTypeController::class, 'destroy'])->name('destroy');
                    Route::patch('{id}',    [RevenueTypeController::class, 'update'])->name('update');
                    Route::get('{id}',      [RevenueTypeController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [RevenueTypeController::class, 'edit'])->name('edit');
                });                  
            });
            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                Route::get('',          [UserController::class, 'index'])->name('index');
                Route::post('',         [UserController::class, 'store'])->name('store');
                Route::get('create',    [UserController::class, 'create'])->name('create');
                Route::delete('{id}',   [UserController::class, 'destroy'])->name('destroy');
                Route::patch('{id}',    [UserController::class, 'update'])->name('update');
                Route::get('{id}',      [UserController::class, 'show'])->name('show');
                Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
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