<?php

namespace App\Http;

use App\Core\Enum\TaskStatusEnum;

class Helpers
{
    function taskStatusEnum($status) {
        return match ($status) {
            TaskStatusEnum::Pending => 'Pending',
            TaskStatusEnum::InProgress => 'InProgress',
            TaskStatusEnum::Completed => 'Completed',
        };
    }
}
