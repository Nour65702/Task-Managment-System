<?php


namespace App\Services\Tasks;

use App\Jobs\UpdateTaskStatusJob;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Gate;


class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        return $this->taskRepository->getAll();
    }

    public function createTask(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function updateTask($id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function deleteTask($task)
    {
        return $this->taskRepository->delete($task);
    }

    public function getCompletedTasks()
    {
        return $this->taskRepository->getCompletedTasks();
    }

    public function dispatchTaskStatusUpdateJob()
    {
        UpdateTaskStatusJob::dispatch();
    }

    public function deleteMyTask(Task $task)
    {
        if (Gate::denies('delete-task', $task)) {
            return ['status' => false, 'message' => 'Unauthorized'];
        }

        $this->taskRepository->deleteTask($task);
        return ['status' => true, 'message' => 'Task Deleted Successfully'];
    }

    public function completeTask(Task $task)
    {
        if (Gate::denies('complete-task', $task)) {
            return ['status' => false, 'message' => 'Unauthorized'];
        }

        $this->taskRepository->completeTask($task);
        return ['status' => true, 'message' => 'Task Completed Successfully', 'task' => $task];
    }
}
