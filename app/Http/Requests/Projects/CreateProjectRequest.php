<?php

namespace App\Http\Requests\Projects;

use App\Dto\Projects\CreateProjectRequestDto;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CreateProjectRequest extends Data
{
    #[Rule('string|min:3|max:255')]
    public string $name;

    #[Rule('string|min:15')]
    public string $description;

    public function toCreateProjectDto(): CreateProjectRequestDto
    {
        return (new CreateProjectRequestDto())
            ->setName($this->name)
            ->setDescription($this->description);
    }
}
