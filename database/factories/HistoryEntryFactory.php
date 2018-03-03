<?php

use App\HistoryEntry;
use Faker\Generator as Faker;

$factory->define( HistoryEntry::class, function (Faker $faker) {
	return [
		'name' => $faker->sentence(3),
		'category_id' => 1,
		'price' => $faker->randomFloat(NULL, 0, 100),
		'photo_url' => $faker->imageUrl(),
		'notes' => $faker->text,
	];
});
