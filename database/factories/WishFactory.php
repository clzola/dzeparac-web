<?php

use Dzeparac\Wish;
use Faker\Generator as Faker;

$factory->define(Wish::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
	    'category_id' => 1,
	    'price' => $faker->randomFloat(NULL, 0, 100),
	    'photo_url' => $faker->imageUrl(),
	    'notes' => $faker->text,
	    'flag_fulfilled' => $faker->boolean(30),
    ];
});
