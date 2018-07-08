<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 5)->create()->each(function ($company) {
            for ($i=0; $i < 10; $i++) { 
                $company->meals()->save(factory(App\Meal::class)->make());
            }
            
        });
    }
}
