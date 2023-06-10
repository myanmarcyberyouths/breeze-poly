<?php

use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;


Route::apiResource('/events', EventController::class);
