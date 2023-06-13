<?php

use App\Http\Controllers\Api\V1\Auth\PassportAuthController;
use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->group(function () {
    Route::post('sign-up', [PassportAuthController::class, 'register']);
    Route::post('sign-in', [PassportAuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('users/sign-out', [PassportAuthController::class, 'logout']);
});

Route::apiResource('/events', EventController::class);
