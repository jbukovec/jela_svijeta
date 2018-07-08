<?php

use Faker\Generator as Faker;

$factory->define(App\Meal::class, function (Faker $faker) {
    return [
        'title:en' => $faker->text(50),
        'description:en' =>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'title:hr' => $faker->text(50),
        'description:hr' =>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'title:it' => $faker->text(50),
        'description:it' =>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'title:de' => $faker->text(50),
        'description:de' =>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'title:fr' => $faker->text(50),
        'description:fr' =>$faker->paragraph($nbSentences = 2, $variableNbSentences = true),
    ];
});
