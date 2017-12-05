<?php

use Illuminate\Database\Seeder;
use App\Task_user;

class TaskUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Task_user::create(['task_id' => 1, 'user_id' => 2]);
      Task_user::create(['task_id' => 2, 'user_id' => 2]);
      Task_user::create(['task_id' => 2, 'user_id' => 3]);
      Task_user::create(['task_id' => 2, 'user_id' => 4]);
    }
}
