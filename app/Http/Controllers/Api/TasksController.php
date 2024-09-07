<?php

namespace App\Http\Controllers\Api;

use App\Business\Interfaces\ITaskService;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Responses\ApiHttpResponse;

class TasksController extends BaseApiController
{
    private ITaskService $taskService;

    public function __construct(ITaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function create(CreateTaskRequest $request): ApiHttpResponse
    {
        $result = $this->taskService->create($request->toCreateTaskDto());
        return $this->defaultResponse($result);
    }

    public function update(UpdateTaskRequest $updateTaskRequest): ApiHttpResponse
    {
        $data = $this->taskService->update($updateTaskRequest->toUpdateTaskDto());
        return $this->defaultResponse($data);
    }

    public function delete(int $id): ApiHttpResponse
    {
        $data = $this->taskService->delete($id);
        return $this->defaultResponse($data);
    }

    public function getAll(): ApiHttpResponse
    {
        $tasks = $this->taskService->getAll();
        return $this->defaultResponse($tasks);
    }

    public function getById(int $id): ApiHttpResponse
    {
        $task = $this->taskService->getById($id);
        dd($task);
        return $this->defaultResponse($task);
    }
}
