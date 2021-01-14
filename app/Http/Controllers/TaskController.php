<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->createOrEdit(new Task());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return $this->createOrEdit($task);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    protected function createOrEdit(Task $task)
    {
        return view('tasks.createOrEdit', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->storeOrUpdate($request, new Task());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        return $this->storeOrUpdate($request, $task);
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function storeOrUpdate(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $isNew = !$task->exists;

        $task->setAttribute('title', $request->input('title'));
        $task->setAttribute('description', $request->input('description'));
        $task->save();

        return $this->redirectToIndexAfterAction($isNew ? 'created' : 'updated');
    }

    /**
     * @param string $action
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToIndexAfterAction(string $action)
    {
        return redirect()->route('tasks.index')
            ->with('success', "The task has been $action successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return $this->redirectToIndexAfterAction('deleted');
    }
}
