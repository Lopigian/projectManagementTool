<?php

namespace App\Dto\Projects;

use App\Models\Project;
use Spatie\LaravelData\Data;

class GetDetailedProjectResponseDto extends Data
{
    public int $id;
    public string $name;
    public string $description;

    public function __construct(Project $project)
    {
        $this->id = $project->getId();
        $this->name = $project->getName();
        $this->description = $project->getDescription();
    }
}
