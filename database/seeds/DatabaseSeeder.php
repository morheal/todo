<?php

use Illuminate\Database\Seeder;
use App\Task_user;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(TaskUserTableSeeder::class);
    }
}
