<?php

use Faker\Generator as Faker;

$factory->define(App\Ingredient::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'title:en' => $faker->text(50),
        'title:hr' => $faker->text(50),
        'title:it' => $faker->text(50),
        'title:de' => $faker->text(50),
        'title:fr' => $faker->text(50),
    ];
});
