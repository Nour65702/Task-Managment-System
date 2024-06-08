<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Models\User;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('update-task', function (User $user, Task $task) {
            return $user->id === $task->user_id || $user->isAdmin();
        });
    
        Gate::define('delete-task', function (User $user, Task $task) {
            return $user->id === $task->user_id || $user->isAdmin();
        });
    
        Gate::define('complete-task', function (User $user, Task $task) {
            return $user->id === $task->user_id || $user->isAdmin();
        });
    }
}
