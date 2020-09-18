<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' 				=> 	$faker->words($nb = 2, $asText = true),
        'manufacturer' 		=> 	$faker->randomElement(['asus', 'dell', 'apple', 'samsung', 'hawaii']),
        'quantity' 			=> 	$faker->numberBetween($min = 5, $max = 25),
        'expiry_date'		=>	$faker->dateTimeBetween('+1 week', '+2 month'),
    ];
});
