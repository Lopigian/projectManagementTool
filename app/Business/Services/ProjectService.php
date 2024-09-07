<?php

namespace App\Business\Services;

use App\Business\Interfaces\IProjectService;
use App\Dto\Projects\CreateProjectRequestDto;
use App\Dto\Projects\GetDetailedProjectResponseDto;
use App\Dto\Projects\UpdateProjectRequestDto;
use App\Exceptions\HttpHasMatchException;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\isNull;

class ProjectService implements IProjectService
{

    /**
     * @throws \Exception
     */
    function create(CreateProjectRequestDto $createProjectRequestDto): bool
    {
        $this->validate($createProjectRequestDto);

        $project = new Project();
        return $project->setName($createProjectRequestDto->getName())
                ->setDescription($createProjectRequestDto->getDescription())
                ->save();
    }

    function update(UpdateProjectRequestDto $updateProjectRequestDto): bool
    {
        $this->validate($updateProjectRequestDto);

        $project = Project::findProjectById($updateProjectRequestDto->id);
        if(is_null($project)){
            throw new HttpHasMatchException("Project not found or deleted!");
        }
        $project->fill($updateProjectRequestDto->toArray());
        return $project->save();
    }

    function delete(int $id): bool
    {
        $project = Project::findProjectById($id);
        if(!$project) {
            throw new HttpHasMatchException("Project not found!");
        }
        return $project->deleteProject();
    }

    function getAll(): Collection
    {
        return Project::all();
    }

    function getById(int $id): GetDetailedProjectResponseDto
    {
        $project = Project::findProjectById($id);
        if(isNull($project)){
            throw new HttpHasMatchException("Project not found or deleted!");
        }
        return new GetDetailedProjectResponseDto($project);
    }

    public function validate($projectData): void
    {
        $query = Project::query();

        if (isset($projectData->id)) {
            $query->where('id', '!=', $projectData->id);
        }

        $query->where(function (Builder $query) use ($projectData) {
            $query->where('name', '=', $projectData->getName());
        });

        if ($query->exists()) {
            throw new HttpHasMatchException("Project has a matching record in the database.");
        }
    }
}
