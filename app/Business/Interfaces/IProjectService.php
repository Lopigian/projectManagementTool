<?php

namespace App\Business\Interfaces;

use App\Dto\Projects\CreateProjectRequestDto;
use App\Dto\Projects\GetDetailedProjectResponseDto;
use App\Dto\Projects\UpdateProjectRequestDto;
use Illuminate\Support\Collection;

interface IProjectService
{

    function create(CreateProjectRequestDto $createProjectRequestDto) :bool;

    function update(UpdateProjectRequestDto $updateProjectRequestDto) :bool;

    function delete(int $id) :bool;

    function getAll() :Collection;

    function getById(int $id) :GetDetailedProjectResponseDto;

}
