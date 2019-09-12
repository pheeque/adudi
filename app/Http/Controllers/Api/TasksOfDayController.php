<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Task;

class TasksOfDayController extends Controller
{
    public function __invoke($day)
    {
        return TaskResource::collection(Task::whereDate('due_date', $day)->get());
    }
}
