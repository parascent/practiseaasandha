<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Int_;

class TasksController extends Controller
{
    public function all(Request $request)
    {
        $user  = Auth::user();
        $tasks = null;
        if($user->is_admin == true)
        {
            $tasks = \App\Task::with(['assignee', 'createdBy'])->get();
        }
        else {
            $tasks = \App\Task::with(['assignee', 'createdBy'])->where('assignee',$user->id)->get();
        }
        $users = \App\User::all();
//        dd($tasks);
        return view('home', ['tasks'=> $tasks->toArray(), 'users'=> $users]);
    }

    public function single(Request $request)
    {
        $user  = Auth::user();
        $task = \App\Task::with(['assignee', 'createdBy'])->findOrFail($request->id);
        if($user->is_admin == true || $user->id == $task->assignee->id)
        {
            return view('single',['task'=>$task]);
        }

        return view('errors.forbidden');
    }

    public function add(Request $request){
        $user  = Auth::user();
        if($user->is_admin == false){
            return view('errors.forbidden');
        }

        $task = new \App\Task();
        $task->created_by = $user->id;
        $task->assignee = $request->assignee;
        $task->description = $request->description;
        $task->save();

        return redirect('home');
    }

    public function edit(Request $request){
        $user  = Auth::user();
        if($user->is_admin == false){
            return view('errors.forbidden');
        }

        $task = new \App\Task();
        $task->created_by = $user->id;
        $task->assignee = $request->assignee;
        $task->description = $request->description;
        $task->save();

        return view('single', ['task'=> $task]);
    }

    public function markDone(Request $request)
    {
        $user  = Auth::user();
        $task = \App\Task::findOrFail($request->id);
        if($user->is_admin == false && $user->id != $task->assignee){
            return view('errors.forbidden');
        }

        $task->completed = true;
        $task->save();

        return redirect('home');
    }

    public function delete(Request $request){
        $user  = Auth::user();
        if($user->is_admin == false){
            return view('errors.forbidden');
        }

        $task =\App\Task::findOrFail($request->id);
        $task->delete();

        return redirect('home');
    }




}
