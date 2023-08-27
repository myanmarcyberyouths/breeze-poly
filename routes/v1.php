<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\EmailValidationController;
use App\Http\Controllers\Api\V1\Auth\InterestController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\EventSaveController;
use App\Http\Controllers\Api\V1\LaunchedEventController;
use App\Http\Controllers\Api\V1\SuggestionController;
use App\Http\Controllers\Api\V1\UserActivityFeedController;
use Illuminate\Support\Facades\Route;


// User Authenticated Routes
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
        Route::get('/me/activities', UserActivityFeedController::class);

        Route::post('/sign-out', [AuthController::class, 'logout']);
    });


    Route::prefix('events')->group(function () {
        Route::get('/saved', [EventSaveController::class, 'index']);
        Route::post('/{event}/save', [EventSaveController::class, 'store']);
        Route::post('/{event}/un-save', [EventSaveController::class, 'destroy']);
        Route::get('/launched', LaunchedEventController::class);

        Route::get('/suggestions', SuggestionController::class);
    });

});


Route::apiResource('/events', EventController::class);
