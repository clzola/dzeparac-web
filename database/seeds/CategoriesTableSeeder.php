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
        \Dzeparac\Category::create([
        	"name" => "Kategorija A",
	        "photo_url" => "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Toy-256.png",
        ]);

	    \Dzeparac\Category::create([
		    "name" => "Kategorija B",
		    "photo_url" => "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Toy-256.png",
	    ]);

	    \Dzeparac\Category::create([
		    "name" => "Kategorija C",
		    "photo_url" => "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Toy-256.png",
	    ]);
    }
}
