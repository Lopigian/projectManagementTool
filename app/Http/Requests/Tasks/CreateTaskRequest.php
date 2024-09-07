<?php

namespace App\Http\Requests\Tasks;

use App\Dto\Tasks\CreateTaskRequestDto;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CreateTaskRequest extends Data
{
    #[Rule('int|min:1')]
    public int $projectId;

    #[Rule('string|min:3|max:255')]
    public string $name;

    #[Rule('string|min:15')]
    public string $description;

    #[Rule('int')]
    public int $status;

    public function toCreateTaskDto(): CreateTaskRequestDto
    {
        return (new CreateTaskRequestDto())
            ->setProjectId($this->projectId)
            ->setName($this->name)
            ->setStatus($this->status)
            ->setDescription($this->description);
    }
}
