<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
class TaskController extends Controller
{
    //
    public function index() {
   // $tasks = DB::table('tasks')->get();
    $tasks = Task::all();
    return view('tasks', compact('tasks'));
}

public function create(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|max:10'
    ]);
    $task_name = $request->name;
    // DB::table('tasks')->insert(['name' => $task_name]);
    $task = new Task;
    $task->name = $task_name;
    $task->save();

    return redirect()->back();
}
    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back();
    }


    public function edit($id) {
        $task = Task::findOrFail($id);
        $tasks = Task::all();

        return view('tasks', compact('task', 'tasks'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:10'
        ]);

        $task = Task::findOrFail($request->id);
        $task->name = $request->name;
        $task->save();

        return redirect('tasks');
    }
}
