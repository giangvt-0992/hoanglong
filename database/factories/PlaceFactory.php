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
        'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.992942387786!2d105.79984861458776!3d21.032968393011277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab40e004159b%3A0x78b0bd69d4796ef7!2zTmfDtSA2OCAtIEPhuqd1IEdp4bqleSwgUXVhbiBIb2EsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1588578678958!5m2!1svi!2s'
    ];
});
