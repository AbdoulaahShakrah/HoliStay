<?php

use App\Http\Controllers\Api\V1\AmenityController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PhotoController;
use App\Http\Controllers\Api\V1\PropertyAmenityController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\PropertyTaxController;
use App\Http\Controllers\Api\V1\ReservationController;
use App\Http\Controllers\Api\V1\TaxController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
 
    Route::get('properties', [PropertyController::class, 'index']);

    Route::get('properties/{id}', [PropertyController::class, 'show']);

    Route::get('categories', [PropertyController::class, 'categories']);

    Route::post('login', [AuthController::class, 'login']);

    Route::post('client-register', [AuthController::class, 'clientRegister']);

    Route::post('host-register', [AuthController::class, 'hostRegister']);
});

//api/v1/properties 
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => ['auth:sanctum']], function () {

    Route::post('properties', [PropertyController::class, 'store']);

    Route::put('properties/{id}', [PropertyController::class, 'update']);
 
    Route::patch('properties/{id}', [PropertyController::class, 'update']);

    Route::delete('properties/{id}', [PropertyController::class, 'destroy']);

    Route::get('amenities', [AmenityController::class, 'index']);

    Route::get('taxes', [TaxController::class, 'index']);

    Route::post('propertyAmenities', [PropertyAmenityController::class, 'store']);

    Route::post('propertyTaxes', [PropertyTaxController::class, 'store']);

    Route::post('photos', [PhotoController::class, 'store']);

    Route::post('payment', [PaymentController::class, 'store']);

    Route::post('reservation', [ReservationController::class, 'store']);

    Route::get('reservations/by-client', [ReservationController::class, 'getByClientId']);

    Route::get('reservations/by-property', [ReservationController::class, 'getByPropertyId']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

