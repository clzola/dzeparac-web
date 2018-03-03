<?php

use Illuminate\Database\Seeder;

class WishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\App\Wish::create([
    		'child_id' => 1,
    		'name' => 'W1',
		    'category_id' => 1,
		    'price' => 57,
		    'photo_url' => "https://picsum.photos/400/200/?image=806",
		    'notes' => 'Lorem ispum dulum',
		    'flag_fulfilled' => true,
	    ]);

	    \App\Wish::create([
		    'child_id' => 1,
		    'name' => 'W2',
		    'category_id' => 1,
		    'price' => 10,
		    'photo_url' => "https://picsum.photos/400/200/?image=200",
		    'notes' => 'Lorem ispum dulum',
		    'flag_fulfilled' => false,
	    ]);

	    \App\Wish::create([
		    'child_id' => 1,
		    'name' => 'W3',
		    'category_id' => 1,
		    'price' => 23,
		    'photo_url' => "https://picsum.photos/400/200/?image=400",
		    'notes' => 'Lorem ispum dulum',
		    'flag_fulfilled' => false,
	    ]);

	    \App\Wish::create([
		    'child_id' => 1,
		    'name' => 'W4',
		    'category_id' => 1,
		    'price' => 30,
		    'photo_url' => "https://picsum.photos/400/200/?image=700",
		    'notes' => 'Lorem ispum dulum',
		    'flag_fulfilled' => false,
	    ]);
    }
}
