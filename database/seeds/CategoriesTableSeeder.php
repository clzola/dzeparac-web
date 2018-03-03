<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
        	"name" => "Kategorija A",
	        "photo_url" => "AA",
        ]);

	    \App\Category::create([
		    "name" => "Kategorija B",
		    "photo_url" => "BB",
	    ]);

	    \App\Category::create([
		    "name" => "Kategorija C",
		    "photo_url" => "CC",
	    ]);
    }
}
