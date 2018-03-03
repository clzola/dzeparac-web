<?php

use Illuminate\Database\Seeder;

class ChildrenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Child::create([
        	"parent_id" => 1,
        	"name" => "Petar",
	        "code" => "ABNGH12",
	        "photo_url" => "https://cdn.pixabay.com/photo/2016/10/14/22/31/cute-1741376_960_720.jpg",
	        'money' => 40,
        ]);

	    \App\Child::create([
		    "parent_id" => 1,
		    "name" => "Lazar",
		    "code" => "ZZS2X1",
		    "photo_url" => "https://cdn.pixabay.com/photo/2016/10/14/22/31/cute-1741376_960_720.jpg",
	    ]);
    }
}
