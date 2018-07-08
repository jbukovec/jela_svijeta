<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguagesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(MealsTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(TagsTableSeeder::class);

        $tags = App\Tag::all();
        $ingredients = App\Ingredient::all();

        App\Meal::all()->each(function ($meal) use ($tags, $ingredients) { 
            $meal->tags()->attach(
                $tags->random(rand(1, 6))->pluck('id')->toArray()
            );
            $meal->ingredients()->attach(
                $ingredients->random(rand(1,8))->pluck('id')->toArray()
            ); 
        });

    }
}
