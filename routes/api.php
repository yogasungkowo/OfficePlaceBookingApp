<?php

use App\Http\Controllers\Api\BookingTransactionsController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\OfficeSpaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/city/{city:slug}', [CityController::class, 'show']);
Route::apiResource('/cities', CityController::class);

Route::get('/office/{officeSpace:slug}', [OfficeSpaceController::class, 'show']);
Route::apiResource('/offices', OfficeSpaceController::class);

Route::post('/booking', [BookingTransactionsController::class, 'store']);
Route::post('/check-booking', [BookingTransactionsController::class, 'booking_details']);


