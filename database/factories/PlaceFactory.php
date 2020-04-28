<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Place;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
        'description' => $faker->realText($maxNbChars = 160, $indexSize = 2),
        'address' => $faker->streetAddress,
        'district_id' => $faker->numberBetween($min = 1, $max = 800),
        'brand_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
