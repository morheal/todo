<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Task_user;
use Response;
use App\User;
use DB;

use Auth;
class TaskController extends Controller
{
  //adding task function
    public function addTask(Request $request)
    {
      //getting data from request and creating new task
      $new_task = Task::create(['title' => $request->title, 'description' => $request->description, 'deadline' => $request->deadline, 'creator' => Auth::user()->id]);
      return $new_task;
    }
    //deleting task function
    public function deleteTask(Request $request)
    {
      $this_task = new Task();
      $this_task->deleteById($request->id);
      return $request->id;
    }

    public function getUsersWithoutTask(Request $request)
    {
      $id = $request->id;
      $users = User::whereDoesntHave('tasks', function ($query) use ($id) {
        $query->where('task_id', 'like', $id);
      })->get();
      return Response::json(['id'=>$request->id, 'users' => $users]);
    }

    public function addTaskToUser(Request $request)
    {
      $user = User::find($request->user_id);
      $user->tasks()->attach($request->task_id);
      return Response::json(["username" => $user->name, "task_id" => $request->task_id]);
    }
}
