<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::post('register', [PassportAuthController::class,'register']);
Route::post('login', [PassportAuthController::class,'login']);

Route::middleware('auth:api')->group(function(){

    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', [PassportAuthController::class,'logout']);
    });

});

Route::apiResource('/', AuthController::class);
