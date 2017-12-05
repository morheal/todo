<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create(['title' => 'make coffee', 'description' => 'make some gorgeus and sweet coffee', 'deadline' => '2017-12-31', 'creator' => 1]);
        Task::create(['title' => 'cook shaverma', 'description' => 'take some lavash, add a lot of meat, a little bit of mazik and it`s ready!', 'deadline' => '2017-12-12', 'creator' => 1]);
        Task::create(['title' => 'go to pub', 'description' => 'go to papapub, drink some beer and eat delicious meals', 'deadline' => '2017-12-22', 'creator' => 2]);
    }
}
