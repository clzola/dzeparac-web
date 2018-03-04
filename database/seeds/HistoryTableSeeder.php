<?php

use Illuminate\Database\Seeder;

class HistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\App\HistoryEntry::create([
			'child_id' => 1,
			'name' => 'Dzeparac 50EUR',
			'price' => 50.00,
		]);

		for($i=0; $i<100; $i++) {
			\App\HistoryEntry::create([
				'child_id' => 1,
				'name' => "Igracka supermen ($i)" ,
				'category_id' => 1,
				'price' => 10.00,
				'photo_url' => 'https://picsum.photos/400/200/?image=208',
			]);
		}

	    \App\HistoryEntry::create([
		    'child_id' => 1,
		    'name' => 'W1',
		    'category_id' => 1,
		    'price' => 57,
		    'photo_url' => "https://picsum.photos/400/200/?image=806",
		    'notes' => 'Lorem ispum dulum',
		    'wish_id' => 1,
	    ]);
    }
}
