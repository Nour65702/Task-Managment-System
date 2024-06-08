<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->group(function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [UserAuthController::class, 'logout']);

        Route::prefix('tasks')->group(function () {
            Route::delete('delete/{task}', [UserController::class, 'destroy']);
            Route::post('{task}/complete', [UserController::class, 'complete']);
            Route::get('{user}', [UserController::class, 'myTasks']);
        });
       
    });
});
