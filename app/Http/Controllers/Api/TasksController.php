<?php

namespace App\Http\Controllers\Api;

use App\Events\Tasks\TaskCreated;
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

        $task = Task::create([
            'name'     => $data['name'],
            'due_date' => $data['due_date'],
            'status'   => $data['status'],
            'user_id'  => auth()->user()->id,
        ]);

        event(new TaskCreated($task));

        return new TaskResource($task);
    }

    public function destroy($id)
    {
        return response()->json(Task::findOrFail($id)->delete());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required',
        ]);
        return response()->json(
            Task::findOrFail($id)->update(request()->all())
        );
    }
}
