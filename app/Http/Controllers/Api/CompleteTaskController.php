<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;

class CompleteTaskController extends Controller
{
    public function __invoke($id)
    {
        return response()->json(Task::findOrFail($id)->update(['status' => true]));
    }
}
