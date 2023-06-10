<?php

use Illuminate\Support\Facades\Route;


Route::get('/events', fn() => response()->json([
    'name' => 'Hello world'
]));
