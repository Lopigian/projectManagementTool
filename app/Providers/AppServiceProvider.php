<?php

namespace App\Providers;

use App\Business\Interfaces\IProjectService;
use App\Business\Interfaces\ITaskService;
use App\Business\Services\ProjectService;
use App\Business\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProjectService::class, ProjectService::class);
        $this->app->bind(ITaskService::class, TaskService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
