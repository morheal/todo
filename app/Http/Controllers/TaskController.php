<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

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
    public function deleteTask($value='')
    {
      # code...
    }
}
