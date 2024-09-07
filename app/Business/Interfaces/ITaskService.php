<?php

namespace App\Business\Interfaces;

use App\Dto\Tasks\CreateTaskRequestDto;
use App\Dto\Tasks\GetDetailedTaskResponseDto;
use App\Dto\Tasks\UpdateTaskRequestDto;
use Illuminate\Support\Collection;

interface ITaskService
{
    function create(CreateTaskRequestDto $createTaskRequestDto) :bool;

    function update(UpdateTaskRequestDto $updateTaskRequestDto) :bool;

    function delete(int $id) :bool;

    function getAll() :Collection;

    function getById(int $id) :GetDetailedTaskResponseDto;
}
