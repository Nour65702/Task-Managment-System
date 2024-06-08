<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function getAll()
    {
        return Task::all();
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = Task::findOrFail($id); 
        $task->update($data); 

        return $task;
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }

    public function getCompletedTasks()
    {
        return Task::where('status', 'completed')->get();
    }

    public function findTaskById($taskId)
    {
        return Task::findOrFail($taskId);
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }

    public function completeTask(Task $task)
    {
        $task->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }
}
