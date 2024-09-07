<?php

namespace App\Business\Services;

use App\Business\Interfaces\ITaskService;
use App\Core\Enum\TaskStatusEnum;
use App\Dto\Tasks\CreateTaskRequestDto;
use App\Dto\Tasks\GetDetailedTaskResponseDto;
use App\Dto\Tasks\UpdateTaskRequestDto;
use App\Exceptions\HttpHasMatchException;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\isNull;

class TaskService implements ITaskService
{
    function create(CreateTaskRequestDto $createTaskRequestDto): bool
    {
        $this->validate($createTaskRequestDto);

        $task = new Task();
        return $task->setName($createTaskRequestDto->getName())
            ->setProjectId($createTaskRequestDto->getProjectId())
            ->setStatus($createTaskRequestDto->getStatus())
            ->setDescription($createTaskRequestDto->getDescription())
            ->save();
    }

    function update(UpdateTaskRequestDto $updateTaskRequestDto): bool
    {
        $this->validate($updateTaskRequestDto);

        $task = Task::findTaskById($updateTaskRequestDto->id);
        if(is_null($task)){
            throw new HttpHasMatchException("Task not found or deleted!");
        }
        $task->fill($updateTaskRequestDto->toArray());
        return $task->save();
    }

    function delete(int $id): bool
    {
        $task = Task::findTaskById($id);
        if(!$task) {
            throw new HttpHasMatchException("Task not found!");
        }
        return $task->deleteTask();
    }

    function getAll(): Collection
    {
        $statuses = TaskStatusEnum::cases();
        $tasks = Task::with('project')->get();
        $tasks->transform(function ($task) use ($statuses) {
            $task->statusString = $statuses[$task->status]->name;
            return $task;
        });
        return $tasks;
    }

    function getById(int $id): GetDetailedTaskResponseDto
    {
        $task = Task::findTaskById($id);
        if(isNull($task)){
            throw new HttpHasMatchException("Task not found or deleted!");
        }
        return new GetDetailedTaskResponseDto($task);
    }

    public function validate($taskData): void
    {
        $query = Task::query();

        if (isset($taskData->id)) {
            $query->where('id', '!=', $taskData->id);
        }

        $query->where(function (Builder $query) use ($taskData) {
            $query->where('name', '=', $taskData->getName());
        });

        if ($query->exists()) {
            throw new HttpHasMatchException("Task has a matching record in the database.");
        }
    }
}
