<?php

namespace App\Http\Requests\Projects;

use App\Dto\Projects\UpdateProjectRequestDto;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class UpdateProjectRequest extends Data
{
    #[Rule('int|min:1')]
    public int $id;

    #[Rule('string|min:3|max:255')]
    public string $name;

    #[Rule('string|min:15')]
    public string $description;

    public function toUpdateProjectDto(): UpdateProjectRequestDto
    {
        return (new UpdateProjectRequestDto())
            ->setId($this->id)
            ->setName($this->name)
            ->setDescription($this->description);
    }
}
