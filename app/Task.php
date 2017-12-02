<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'deadline', 'creator'];

    public function deleteById($id)
    {
      Task::where('id', $id)->delete();
      return;
    }
}
