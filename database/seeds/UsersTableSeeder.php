<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'user', 'email' => 'user@mail.com', 'password' => bcrypt(111111)]);
        User::create(['name' => 'admin', 'email' => 'admin@mail.com', 'password' => bcrypt(111111)]);
        User::create(['name' => 'user2', 'email' => 'user2@mail.com', 'password' => bcrypt(111111)]);
        User::create(['name' => 'user3', 'email' => 'user3@mail.com', 'password' => bcrypt(111111)]);
    }
}
