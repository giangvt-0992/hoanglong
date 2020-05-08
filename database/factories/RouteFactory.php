<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Place;
use App\Models\Route;
use Faker\Generator as Faker;

$factory->define(Route::class, function (Faker $faker, $var) {
    $places = Place::whereBrandId($var['brand_id'])->pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'depart_place_id' => $faker->randomElement($places),
        'des_place_id' => $faker->randomElement($places),
        'distance' => $x = $faker->numberBetween(60, 200),
        'duration' => json_encode([
            'hours' => $hours = floor($x/60),
            'minutes' => $x - $hours * 60
        ]),
        'brand_id' => $var['brand_id']
    ];
});
