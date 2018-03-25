<?php

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
        \Dzeparac\User::create([
        	'is_parent' => true,
	        'username' => 'clzola',
	        'email' => 'lazar.radinovic@gmail.com',
	        'password' => bcrypt('123'),
        ]);

        \Dzeparac\User::create([
        	'is_child' => true,
	        'name' => 'Petar',
	        'parent_id' => 1,
	        'code' => 'ABCD',
        ]);
    }
}
