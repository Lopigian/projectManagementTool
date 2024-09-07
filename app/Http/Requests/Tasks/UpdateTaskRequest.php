<?php

namespace App\Http\Requests\Tasks;

use App\Dto\Projects\UpdateProjectRequestDto;
use App\Dto\Tasks\UpdateTaskRequestDto;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class UpdateTaskRequest extends Data
{
    #[Rule('int|min:1')]
    public int $id;

    #[Rule('int|min:1')]
    public int $projectId;

    #[Rule('string|min:3|max:255')]
    public string $name;

    #[Rule('string|min:15')]
    public string $description;

    #[Rule('int')]
    public int $status;

    public function toUpdateTaskDto(): UpdateTaskRequestDto
    {
        return (new UpdateTaskRequestDto())
            ->setId($this->id)
            ->setProjectId($this->projectId)
            ->setName($this->name)
            ->setStatus($this->status)
            ->setDescription($this->description);
    }
}
