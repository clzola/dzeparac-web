<?php

use Dzeparac\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
	$childCompleted = $faker->boolean;

    return [
        'name' => $faker->sentence,
	    'child_completed' => $childCompleted,
	    'parent_completed' => $childCompleted && $faker->boolean,
    ];
});
