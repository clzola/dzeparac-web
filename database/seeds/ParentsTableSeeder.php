<?php

use Illuminate\Database\Seeder;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Parentt::create([
        	"username" => "clzola",
	        "email" => "lazar.radinovic@gmail.com",
	        "password" => bcrypt('123456'),
        ]);
    }
}
