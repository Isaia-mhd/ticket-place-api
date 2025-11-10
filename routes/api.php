<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GetEventController;
use App\Http\Controllers\Api\OrganizerController;
use App\Http\Controllers\Api\RegisterOrganizerController;
use App\Http\Controllers\Api\StoreEventController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/events', [GetEventController::class, 'index']);
    Route::post('/organizer/new', [RegisterOrganizerController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/events/new', [StoreEventController::class, 'store']);
    Route::post('/organizer/delete', [OrganizerController::class, 'destroy']);
});
