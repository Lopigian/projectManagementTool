<?php

namespace App\Dto\Tasks;

use App\Models\Project;
use App\Models\Task;
use Spatie\LaravelData\Data;

class GetDetailedTaskResponseDto extends Data
{
    public int $id;
    public int $projectId;
    public string $name;
    public int $status;
    public string $description;

    public function __construct(Task $task)
    {
        $this->id = $task->getId();
        $this->projectId = $task->getProjectId();
        $this->name = $task->getName();
        $this->status = $task->getStatus();
        $this->description = $task->getDescription();
    }
}
