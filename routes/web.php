<?php

use App\Http\Controllers\Operator\CategoryController;
use App\Http\Controllers\Operator\CustomerController;
use App\Http\Controllers\Operator\DriverController;
use App\Http\Controllers\Operator\HomeController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Operator\PaymentController;
use App\Http\Controllers\Operator\PlottingController;
use App\Http\Controllers\Operator\RoleController;
use App\Http\Controllers\Operator\SettingController;
use App\Http\Controllers\Operator\TransactionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('calc/{txid}', [TransactionController::class, 'get_calc']);

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::prefix('operator')->group(function(){
        Route::controller(HomeController::class)->group(function(){
            Route::get('dashboard', 'index');
        });

        Route::controller(SettingController::class)->group(function() {
            Route::get('/change_password', 'change_password');
            Route::put('/update_password', 'update_password');
            Route::get('/change_profile', 'change_profile');
            Route::put('/update_profile', 'update_profile');
        });

        Route::controller(TransactionController::class)->group(function() {
            Route::get('/transaction', 'index');
            Route::get('/transaction/{id}/edit', 'edit');
            Route::put('/transaction/{id}', 'update');
        });

        Route::controller(PaymentController::class)->group(function() {
            Route::get('/payment', 'index');
            Route::get('/payment/{txid}/paid', 'paid_put');
            Route::get('/payment/{txid}/processing', 'processing_put');
            Route::get('/payment/{txid}', 'show');
        });

        Route::resource('plotting', PlottingController::class);

        Route::middleware('isSuperadmin')->group(function(){
            Route::resource('role', RoleController::class);
            Route::resource('operator', OperatorController::class);
            Route::resource('customer', CustomerController::class);
            Route::resource('driver', DriverController::class);
        });
    });
});
