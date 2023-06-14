<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->group(function () {
    Route::post('sign-up', [AuthController::class, 'register']);
    Route::post('sign-in', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('users/sign-out', [AuthController::class, 'logout']);
});

Route::apiResource('/events', EventController::class);
