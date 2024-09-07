<?php

namespace App\Core\Enum;

enum TaskStatusEnum: int
{
    case Pending = 0;
    case InProgress = 1;
    case Completed = 2;
}
