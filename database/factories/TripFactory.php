<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Place;
use App\Models\Route;
use App\Models\Trip;
use Faker\Generator as Faker;

$factory->define(Trip::class, function (Faker $faker, $var) {
    $route = Route::find($var['route_id']);
    $distance = $route->distance;
    $now = rand(1262055681, 1263455681);
    $endStamp = $now + $distance * 60;
    $depart_place = $route->departPlace->name;
    // $des_place = $route->desPlace->name;
    return [
        'name' => $faker->name,
        'depart_time' => $start = date("H:i", $now),
        'arrive_time' => $end = date("H:i", $endStamp),
        'pick_up_schedule' => json_encode([['time' => $start,'location' =>  $depart_place]]),
        'brand_id' => $route->brand_id,
        'route_id' => $route->id,
        'car_type_id' => $faker->numberBetween(1, 10)
    ];
});
