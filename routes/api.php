<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PhaseController;
use App\Http\Controllers\Api\StrandController;
use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ActivityTypeController;
use App\Http\Controllers\Api\HolidayController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('phases', PhaseController::class);
    Route::apiResource('strands', StrandController::class);
    Route::apiResource('batches', BatchController::class);
    Route::apiResource('modules', ModuleController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('activity-types', ActivityTypeController::class);
    Route::apiResource('holidays', HolidayController::class);
});