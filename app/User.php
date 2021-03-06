<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Task;
use App\Task_user;
use DB;
use Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //relationship with task model
    public function tasks()
    {
      return $this->belongsToMany('App\Task');
    }

    public function addTask($task_id)
    {
      $this->tasks()->attach($task_id);
      $this_task = Task::find($task_id);
      Mail::to($this)->send(new TaskAdded($this_task));
      return;
    }
}
