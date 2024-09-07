<?php

namespace App\Http\Controllers\Api;

use App\Business\Interfaces\IProjectService;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Http\Responses\ApiHttpResponse;

class ProjectsController extends BaseApiController
{
    private IProjectService $projectService;

    public function __construct(IProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function create(CreateProjectRequest $request): ApiHttpResponse
    {
        $result = $this->projectService->create($request->toCreateProjectDto());
        return $this->defaultResponse($result);
    }

    public function update(UpdateProjectRequest $updateProjectRequest): ApiHttpResponse
    {
        $data = $this->projectService->update($updateProjectRequest->toUpdateProjectDto());
        return $this->defaultResponse($data);
    }

    public function delete(int $id): ApiHttpResponse
    {
        $data = $this->projectService->delete($id);
        return $this->defaultResponse($data);
    }

    public function getAll(): ApiHttpResponse
    {
        $projects = $this->projectService->getAll();
        return $this->defaultResponse($projects);
    }

    public function getById(int $id): ApiHttpResponse
    {
        $project = $this->projectService->getById($id);
        return $this->defaultResponse($project);
    }
}
