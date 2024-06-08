<?php

namespace App\Helpers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskHelper
{

    // Get tasks from cache or database.

    public static function getTasks()
    {
        return Cache::remember('tasks.index', now()->addSeconds(5), function () {
            return Task::orderBy('status', 'desc')
                ->orderBy('due_date')
                ->get();
        });
    }


    // Get completed tasks from cache or database.

    public static function getCompletedTasks()
    {
        return Cache::remember('tasks.complete', now()->addSeconds(2), function () {
            return Task::where('status', 'completed')
                ->orderBy('completed_at', 'desc')
                ->get();
        });
    }

    
}
