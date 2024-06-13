<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TrackRecordController;

Route::group([
    //'middleware' => 'api',
    'prefix' => 'Company'
], function ($router) {
    Route::post('store', [CompanyController::class,'store']);
    Route::get('show/{id}', [CompanyController::class,'show']);
    Route::put('update/{id}', [CompanyController::class,'update']);
    Route::delete('delete/{id}',[CompanyController::class,'destroy']);
});
Route::group([
    //'middleware' => 'api',
    'prefix' => 'TrackRecord'
], function ($router) {
    Route::post('store', [TrackRecordController::class,'store']);
    Route::get('show/{id}', [TrackRecordController::class,'show']);
    Route::put('update/{id}', [TrackRecordController::class,'update']);
    Route::delete('delete/{id}',[TrackRecordController::class,'destroy']);
});
