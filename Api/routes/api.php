<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\TrackRecordController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'User',
    ],
    function ($router) {
        Route::get('/', [UserController::class, 'index']);
        Route::post('store', [UserController::class, 'store']);
        Route::get('show/{id}', [UserController::class, 'show']);
        Route::put('update/{id}', [UserController::class, 'update']);
        Route::delete('delete/{id}', [UserController::class, 'destroy']);
    },
);
Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'Driver',
    ],
    function ($router) {
        Route::get('/', [DriverController::class, 'index']);
        Route::post('store', [DriverController::class, 'store']);
        Route::get('show/{id}', [DriverController::class, 'show']);
        Route::put('update/{id}', [DriverController::class, 'update']);
        Route::put('updateScore/{id}', [DriverController::class, 'updateScore']);
        Route::delete('delete/{id}', [DriverController::class, 'destroy']);
    },
);

Route::group(
    [
        //'middleware' => 'auth:sanctum',
        'prefix' => 'Device',
    ],
    function ($router) {
        Route::get('/', [DeviceController::class, 'index']);
        Route::post('store', [DeviceController::class, 'store']);
        Route::get('show/{id}', [DeviceController::class, 'show']);
        Route::put('update/{id}', [DeviceController::class, 'update']);
        Route::put('updateScore/{id}', [DeviceController::class, 'updateScore']);
        Route::delete('delete/{id}', [DeviceController::class, 'destroy']);
    },
);


Route::group(
    [
       // 'middleware' => 'auth:sanctum',
        'prefix' => 'Company',
    ],
    function ($router) {
        Route::get('/', [CompanyController::class, 'index']);
        Route::post('store', [CompanyController::class, 'store']);
        Route::get('show/{id}', [CompanyController::class, 'show']);
        Route::put('update/{id}', [CompanyController::class, 'update']);
        Route::delete('delete/{id}', [CompanyController::class, 'destroy']);
    },
);
Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'TrackRecord',
    ],
    function ($router) {
        Route::get('/', [TrackRecordController::class, 'index']);
        Route::post('store', [TrackRecordController::class, 'store']);
        Route::get('show/{id}', [TrackRecordController::class, 'show']);
        Route::put('update/{id}', [TrackRecordController::class, 'update']);
        Route::delete('delete/{id}', [TrackRecordController::class, 'destroy']);
    },
);

Route::group([
    'prefix' => 'auth'

], function ($router) {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'report',
    'middleware' => 'auth:sanctum',

], function ($router) {
    Route::post('/allUserCompany', [reportController::class, 'allUserCompany']);
    Route::post('/scoreDriver', [reportController::class, 'scoreDriver']);
    Route::post('/scoreCompany', [reportController::class, 'scoreCompany']);
});
