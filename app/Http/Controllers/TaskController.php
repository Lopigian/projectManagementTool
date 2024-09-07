<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\ITaskService;
use App\Core\Enum\TaskStatusEnum;

class TaskController extends Controller
{
    private ITaskService $taskService;

    public function __construct(ITaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $statuses = TaskStatusEnum::cases();
        $tasks = $this->taskService->getAll();
        $tasks->transform(function ($task) use ($statuses) {
            $task->status = $statuses[$task->status]->name;
            return $task;
        });

        return view('tasks.index', ['tasks' => $tasks, 'statuses' => $statuses]);
    }
}
