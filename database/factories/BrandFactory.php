<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    $phone = [
        [
            'key' => 'phone',
            'value' =>  $faker->tollFreePhoneNumber
        ]
    ];
    $a = json_encode($phone);
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'phone' => $a,
        'image' => config('picture.default_image'),
        'admin_id' => 1
    ];
});
