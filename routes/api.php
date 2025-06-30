<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('categories/{category}/breeds', [App\Http\Controllers\Api\BreedController::class, 'getBreeds']);
