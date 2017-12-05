<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_user extends Model
{
    protected $fillable = ['task_id', 'user_id'];

    protected $table = 'task_user';
}
