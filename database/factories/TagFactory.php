<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'title:en' => $faker->text(25),
        'title:hr' => $faker->text(25),
        'title:it' => $faker->text(25),
        'title:de' => $faker->text(25),
        'title:fr' => $faker->text(25),
    ];
});
