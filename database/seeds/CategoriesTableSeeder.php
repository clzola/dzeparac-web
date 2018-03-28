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
        	"name" => "Igračke",
	        "photo_url" => "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Toy-256.png",
        ]);

	    \Dzeparac\Category::create([
		    "name" => "Namjernice",
		    "photo_url" => "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Toy-256.png",
	    ]);

	    \Dzeparac\Category::create([
		    "name" => "Odjeća",
		    "photo_url" => "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Toy-256.png",
	    ]);
    }
}
