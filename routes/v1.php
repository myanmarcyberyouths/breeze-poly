<?php

use App\Http\Controllers\Api\V1\Auth\PassportAuthController;
use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::post('register', [PassportAuthController::class, 'register']);
    Route::post('login', [PassportAuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('user/logout', [PassportAuthController::class, 'logout']);
});

Route::apiResource('/events', EventController::class);
