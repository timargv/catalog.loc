<?php

use Faker\Generator as Faker;

$factory->define(App\Entity\Brand::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(14),
        'slug' => str_random(10),
    ];
});
