<?php

namespace App\Http\Controllers\Api;

use App\Contract\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Task;
use App\Services\Tasks\TaskService;
use Exception;

class UserController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function myTasks(string $userId)
    {
        try {
            $user = User::with('tasks')->findOrFail($userId);
            return ApiResponse::success([
                'user' => UserResource::make($user),
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $response = $this->taskService->deleteMyTask($task);

            if (!$response['status']) {
                return ApiResponse::unauthorized($response['message']);
            }

            return ApiResponse::success(['message' => $response['message']]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function complete(Task $task)
    {
        try {
            $response = $this->taskService->completeTask($task);

            if (!$response['status']) {
                return ApiResponse::unauthorized($response['message']);
            }

            return ApiResponse::success([
                'message' => $response['message'],
                'task' => TaskResource::make($response['task']),
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
