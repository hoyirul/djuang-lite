<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login/driver', [AuthController::class, 'login_driver']);
Route::post('/auth/login/customer', [AuthController::class, 'login_customer']);
Route::post('/auth/register/driver', [AuthController::class, 'register_driver']);
Route::post('/auth/register/customer', [AuthController::class, 'register_customer']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::controller(SettingController::class)->group(function(){
        Route::prefix('settings')->group(function(){
            Route::get('profile/{user_id}', 'show_profile');
            Route::put('profile/{user_id}', 'update_profile');
            Route::put('password/{user_id}', 'update_password');
        });
    });

    Route::controller(OrderController::class)->group(function(){
        Route::prefix('orders')->group(function(){
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{customer_id}/customer', 'show_by_customer');
            Route::get('/{driver_id}/customer', 'show_by_driver');
        });
    });

    Route::controller(ScheduleController::class)->group(function(){
        Route::prefix('schedules')->group(function(){
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
            Route::get('customer/{customer_id}', 'show_by_customer');
        });
    });

    Route::apiResource('role', RoleController::class);
});
