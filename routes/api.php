<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GetEventController;
use App\Http\Controllers\Api\StoreEventController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/events', [GetEventController::class, 'index']);
    Route::post('/events/new', [StoreEventController::class, 'store']);
});
