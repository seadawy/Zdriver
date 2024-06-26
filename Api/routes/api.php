<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TrackRecordController;
use App\Http\Controllers\DriverController;

Route::group(
    [
        //'middleware' => 'api',
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
        //'middleware' => 'api',
        'prefix' => 'Driver',
    ],
    function ($router) {
        Route::get('/', [DriverController::class, 'index']);
        Route::post('store', [DriverController::class, 'store']);
        Route::get('show/{id}', [DriverController::class, 'show']);
        Route::put('update/{id}', [DriverController::class, 'update']);
        Route::delete('delete/{id}', [DriverController::class, 'destroy']);
    },
);
Route::group(
    [
        //'middleware' => 'api',
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
        //'middleware' => 'api',
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
