<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Auth $auth)
    {
        $tasks = Task::query()->byUser($auth)->paginate(4);
        return view('tasks.index', ['tasks'=>$tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $task = new Task;
        $task->fill($request->all());

        if(Auth::check()){
            $task->user_id = Auth::id();
            $task->save();
        }

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::query()->find($id);

        return view('tasks.edit', ['task'=>$task]);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::query()->find($id);

        if(auth()->user()->id !== $task->user_id)
        return "Ошибка вы не можете изменить постов других авторов"  ;

        $task->fill($request->all());
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::query()->find($id);
        if(auth()->user()->id !== $task->user_id) return "Ошибка вы не можете удалить постов других авторов";
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
