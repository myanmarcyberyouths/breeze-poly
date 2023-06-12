<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\Auth\PassportAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('user')->group(function () {
    Route::post('register', [PassportAuthController::class, 'register']);
    Route::post('login', [PassportAuthController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {
    
    Route::get('events', [EventController::class, 'index']);
    Route::post('events/store', [EventController::class, 'store']);
    Route::get('events/show', [EventController::class, 'show']);
    Route::post('events/update', [EventController::class, 'update']);
    Route::delete('events/delete', [EventController::class, 'destroy']);

    Route::post('user/logout', [PassportAuthController::class, 'logout']);
});

Route::apiResource('/', AuthController::class);
