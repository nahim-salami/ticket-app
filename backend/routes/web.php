<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\AuthController;

Route::post('/api/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/api/logout', [AuthController::class, 'logout']);
});


Route::get('/api/events', [EventController::class, 'index']);
Route::get('/api/events/{event}', [EventController::class, 'show']);

Route::post('/api/events/{event}/participate', [ParticipantController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/api/events', [EventController::class, 'store']);
    Route::put('/api/events/{event}', [EventController::class, 'update']);
    Route::delete('/api/events/{event}', [EventController::class, 'destroy']);
    Route::get('/api/events/{event}/participants', [EventController::class, 'participants']);
});
