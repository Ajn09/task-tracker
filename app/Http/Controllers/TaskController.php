<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\TaskUpdated;
use App\Events\TaskDeleted;
use App\Events\TaskCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Auth::user()->tasks; // Retrieve tasks for the authenticated user
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:not started,ongoing,completed',
        ]);

        $task = new Task($request->all());
        Auth::user()->tasks()->save($task); // Save task to authenticated user's tasks

        // Broadcast TaskCreated event
        broadcast(new TaskCreated($task))->toOthers();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:not started,ongoing,completed',
        ]);

        $task->update($request->all());

        // Broadcast TaskUpdated event
        broadcast(new TaskUpdated($task))->toOthers();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();

        // Broadcast TaskDeleted event
        broadcast(new TaskDeleted($task))->toOthers();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
