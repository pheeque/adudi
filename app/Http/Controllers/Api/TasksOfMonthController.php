<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Task;

class TasksOfMonthController extends Controller
{
    public function __invoke($month)
    {
        return TaskResource::collection(Task::whereMonth('due_date', $month)->get());
    }
}
