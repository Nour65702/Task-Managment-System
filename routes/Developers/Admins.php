<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::apiResource('tasks', TaskController::class)->except('update');
        Route::patch('task/update/{task}',[TaskController::class,'update']);

        Route::get('completed', [TaskController::class, 'showCompleted']);

    });
   
});

// Route for updating task status
Route::get('/update-task-priorities', [TaskController::class, 'updateTaskPriorities'])->name('updateTaskPriorities');
