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
       $users = array(
        ['name' => 'Juan', 'email' => 'juanmeano@localhost.com', 'password' => Hash::make('1234567')]);

       foreach ($users as $user) {
       		User::create($user);
       }
    }
}
