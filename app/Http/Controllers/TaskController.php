<?php

namespace App\Http\Controllers;
use App\Task;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $tasks = auth()->user()->tasks();
        $tasks = is_null($tasks) ? [] : $tasks->get();
        return view('tasks', [ 'tasks' => $tasks ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:225'
        ]);

        if($validator->fails())
        {
            return redirect('/tasks')
            ->withInput()
            ->withErrors($validator);
        }

        $user = User::find(auth()->user()->id);

        $request->user()->tasks()
            ->create([
                'name' => $request->name
            ]);

        return redirect('/tasks');
    }

    public function destroy(Task $task, Request $request)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}
