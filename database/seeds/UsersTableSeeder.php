<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = new User;
        $user->name = 'Pedro Elias';
        $user->email = 'pedrogm91@gmail.com';
        $user->password = bcrypt('123123');
        $user->save();

        $user = new User;
        $user->name = 'Manuel';
        $user->email = 'email@email.com';
        $user->password = bcrypt('123123');
        $user->save();
    }
}
