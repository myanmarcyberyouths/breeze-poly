<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\EmailValidationController;
use App\Http\Controllers\Api\V1\Auth\InterestController;
use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;


Route::prefix('users')->group(function () {
    Route::post('/validate-email', [EmailValidationController::class, 'validateEmail']);
    Route::post('/validate-profile-image', [EmailValidationController::class, 'validateProfileImage']);
    Route::get('/interests', [InterestController::class, 'index']);

    Route::post('/sign-up', [AuthController::class, 'register']);
    Route::post('/sign-in', [AuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/me', [AuthController::class, 'getAuthUser']);

        Route::post('/sign-out', [AuthController::class, 'logout']);
    });
    
    Route::group(['prefix' => 'events'], function () {
        Route::post('save',[EventController::class,'save']);
    });

});

Route::apiResource('/events', EventController::class);

