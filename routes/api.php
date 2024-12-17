<?php

use App\Http\Controllers\Api\V1\AmenityController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PhotoController;
use App\Http\Controllers\Api\V1\PropertyAmenityController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\PropertyTaxController;
use App\Http\Controllers\Api\V1\TaxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//api/v1/properties 
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('properties', PropertyController::class);
    Route::apiResource('amenities', AmenityController::class);
    Route::apiResource('taxes', TaxController::class);
    Route::apiResource('propertyAmenities', PropertyAmenityController::class);
    Route::apiResource('propertyTaxes', PropertyTaxController::class);
    Route::apiResource('photos', PhotoController::class);
    Route::apiResource('payment', PaymentController::class);

});

