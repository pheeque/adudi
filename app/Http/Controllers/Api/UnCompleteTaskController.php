<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;

class UnCompleteTaskController extends Controller
{
    public function __invoke($id)
    {
        return response()->json(Task::findOrFail($id)->update(['status' => false]));
    }
}
