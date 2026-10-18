<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    // Show All Tasks
    public function index(Request $request)
    {
        $request->validate([
            'status' => 'sometimes|in:pending,in_progress,completed',
        ]);

        $tasks = Task::query()
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Tasks retrieved successfully',
            'tasks'    => $tasks,
        ], Response::HTTP_OK);
    }

    // Show One Task
    public function show(Task $task)
    {
        return response()->json([
            'message' => 'Task retrieved successfully',
            'task'    => $task,
        ], Response::HTTP_OK);
    }

    // Create New Task
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'status'      => 'sometimes|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
        ]);

        $task = Task::create($validatedData)->refresh();

        return response()->json([
            'message' => 'Task created successfully',
            'task'    => $task,
        ], Response::HTTP_CREATED);
    }

    // Update Task
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title'       => 'sometimes|required|string|max:150',
            'description' => 'sometimes|nullable|string',
            'status'      => 'sometimes|in:pending,in_progress,completed',
            'due_date'    => 'sometimes|nullable|date',
        ]);

        $task->update($validatedData);

        return response()->json([
            'message' => 'Task updated successfully',
            'task'    => $task,
        ], Response::HTTP_OK);
    }

    // Delete Task
    public function destroy(Task $task)
    {

        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
        ], Response::HTTP_OK);
    }
}
