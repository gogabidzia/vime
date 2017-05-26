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
        User::create([
        	'email'=>'admin@vime.ge',
        	'password'=>bcrypt('password'),
        	'name'=>'admin',
        	'phone'=>'000'
        ]);
    }
}
