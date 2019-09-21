<?php

namespace App\Http\Controllers\Api;

use App\Events\Tasks\TaskUnCompleted;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;

class UnCompleteTaskController extends Controller
{
    public function __invoke($id)
    {
        $task = Task::findOrFail($id);
        tap($task->update(['status' => false]), function ($updated) use ($task) {
            abort_unless($updated, 500);
            event(new TaskUnCompleted($task));
        });
        return response()->json(true);
    }
}
