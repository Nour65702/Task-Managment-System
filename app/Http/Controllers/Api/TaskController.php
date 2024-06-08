<?php

namespace App\Http\Controllers\Api;

use App\Contract\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskFormRequest;
use App\Http\Requests\Task\UpdateTaskFormRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\Tasks\TaskService;
use Exception;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        try {
            $tasks = $this->taskService->getAllTasks();
            return ApiResponse::success([
                'tasks' => TaskResource::collection($tasks)
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function store(StoreTaskFormRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $task = $this->taskService->createTask($validatedData);
            return ApiResponse::success([
                'message' => 'Task Created Successfully',
                'task' => TaskResource::make($task)
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function show(Task $task)
    {
        try {
            return ApiResponse::success([
                'task' => TaskResource::make($task)
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }



    public function update(UpdateTaskFormRequest $request, $id)
    {

        try {
            $validatedData = $request->validated();
            $updatedTask = $this->taskService->updateTask($id, $validatedData);

            if (!$updatedTask) {
                return ApiResponse::error('Task not found', 404);
            }
            return ApiResponse::success([
                'message' => 'Task Updated Successfully',
                'task' => TaskResource::make($updatedTask)
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $this->taskService->deleteTask($task);
            return ApiResponse::success(['message' => 'Task Deleted Successfully']);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function showCompleted()
    {
        try {
            $completedTasks = $this->taskService->getCompletedTasks();
            return ApiResponse::success([
                'tasks' => TaskResource::collection($completedTasks)
            ]);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function updateTaskPriorities()
    {
        try {
            $this->taskService->dispatchTaskStatusUpdateJob();
            return ApiResponse::success(['message' => 'Task Status Update Job Dispatched']);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}
