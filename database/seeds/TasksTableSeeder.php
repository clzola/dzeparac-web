<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Wish 1 - Fulfilled
        \App\Task::create([
        	'wish_id' => 1,
	        'child_id' => 1,
	        'name' => 'Zadatak 1',
	        'child_completed' => true,
	        'parent_completed' => true,
	        'fulfilled' => true,
        ]);

	    \App\Task::create([
		    'wish_id' => 1,
		    'child_id' => 1,
		    'name' => 'Zadatak 2',
		    'child_completed' => true,
		    'parent_completed' => true,
		    'fulfilled' => true,
	    ]);

	    \App\Task::create([
		    'wish_id' => 1,
		    'child_id' => 1,
		    'name' => 'Zadatak 3',
		    'child_completed' => true,
		    'parent_completed' => true,
		    'fulfilled' => true,
	    ]);

	    factory(\App\Task::class, 4)->create([
	    	'wish_id' => 2,
		    'child_id' => 1,
	    ]);

	    factory(\App\Task::class, 2)->create([
		    'wish_id' => 3,
		    'child_id' => 1,
	    ]);

	    factory(\App\Task::class, 7)->create([
		    'wish_id' => 4,
		    'child_id' => 1,
	    ]);
    }
}
