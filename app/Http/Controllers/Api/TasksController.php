<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required',
            'due_date' => 'required|date',
            'status'   => 'required|boolean',
        ]);
        return new TaskResource(Task::create([
            'name'     => $data['name'],
            'due_date' => $data['due_date'],
            'status'   => $data['status'],
            'user_id'  => auth()->user()->id,
        ]));
    }
}
