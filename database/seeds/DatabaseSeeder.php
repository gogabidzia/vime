<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'=>'company@gmail.com',
            'password'=>bcrypt('password'),
            'name'=>'Company',
            'phone'=>'123123123',
            'type'=>'company'
        ]);
        DB::table('companies')->insert([
            'user_id'=>1
        ]);
        DB::table('users')->insert([
        	'email'=>'admin@vime.ge',
        	'password'=>bcrypt('password'),
        	'name'=>'admin',
            'type'=>'admin',
        	'phone'=>'000'
        ]);
        DB::table('users')->insert([
            'email'=>'user@gmail.com',
            'password'=>bcrypt('password'),
            'name'=>'გიორგი',
            'surname'=>'ცირეკიძე',
            'phone'=>'551242280',
            'type'=>'user'
        ]);
    }
}
