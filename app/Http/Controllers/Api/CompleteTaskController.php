<?php

namespace App\Http\Controllers\Api;

use App\Events\Tasks\TaskCompleted;
use App\Http\Controllers\Controller;
use App\Task;

class CompleteTaskController extends Controller
{
    public function __invoke($id)
    {
        $task = Task::findOrFail($id);
        tap($task->update(['status' => true]), function ($updated) use ($task) {
            abort_unless($updated, 500);
            event(new TaskCompleted($task));
        });
        return response()->json(true);
    }
}
