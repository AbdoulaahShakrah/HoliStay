<?php

use App\Http\Controllers\Api\V1\AmenityController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PhotoController;
use App\Http\Controllers\Api\V1\PropertyAmenityController;
use App\Http\Controllers\Api\V1\PropertyController;
use App\Http\Controllers\Api\V1\PropertyTaxController;
use App\Http\Controllers\Api\V1\ReservationController;
use App\Http\Controllers\Api\V1\TaxController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/* 
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    $user = User::where('email', $credentials['email'], 'password', $credentials['password']); 
    $token = $user->createToken('api-token', ['reserve', 'view_reservations'])->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

Route::post('/register', function (Request $request) {
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);     

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $token = $user->createToken('api-token', ['reserve', 'view_reservations'])->plainTextToken;

    return response()->json([
        'user' => $user,
        'access_token' => $token,
    ]);
});

*/

//api/v1/properties 
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'/*, 'middleware' => ['auth:sanctum']*/] , function () {
    Route::apiResource('properties', PropertyController::class);
    Route::apiResource('amenities', AmenityController::class);
    Route::apiResource('taxes', TaxController::class);
    Route::apiResource('propertyAmenities', PropertyAmenityController::class);
    Route::apiResource('propertyTaxes', PropertyTaxController::class);
    Route::apiResource('photos', PhotoController::class);
    Route::apiResource('payment', PaymentController::class);
    Route::apiResource('reservation', ReservationController::class);
    Route::get('reservations/by-client', [ReservationController::class, 'getByClientId']);
    Route::get('reservations/by-property', [ReservationController::class, 'getByPropertyId']);

});

