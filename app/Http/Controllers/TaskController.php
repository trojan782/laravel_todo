<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks();
        return view('/dashboard', compact('tasks'));
    }

    public function add()
    {
        return view('add');
    }
    //function to save a new task
    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $task = new Task();
        $task->description = $request->description;
        $task->user_id = Auth::user()->id;
        $task->save();
        return redirect('/dashboard');
    }

    public function edit(Task $task)
    {
        return view('edit', compact('task'));
        // if (auth()->user()->id === $task->user_id) {
        // } else {
            // return redirect('/dashboard');
            // dd("i did not work!");
        }
        
    // }

    public function update(Request $request, Task $task)
    {
        //to check if the delete button is clicked and to delete the task
        if(isset($_POST['delete'])) {
            $task->delete();
            return redirect('/dashboard');
            //to update the task
        } else {
            $this->validate($request, [
                'description' => 'required'
            ]);
            $task->description = $request->description;
            $task->save();
            return redirect('/dashboard');
        }
    }
}
