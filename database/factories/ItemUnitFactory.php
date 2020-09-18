<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ItemUnits;
use Faker\Generator as Faker;

$factory->define(ItemUnits::class, function (Faker $faker) {
    return [
        'name' 			=> 	$faker->word,
        'buy_price' 	=> 	$faker->randomElement([100, 200, 300, 400, 500, 600, 700, 800, 900, 1000]),
        'sell_price' 	=> 	$faker->randomElement([100, 200, 300, 400, 500, 600, 700, 800, 900, 1000]),
    ];
});
