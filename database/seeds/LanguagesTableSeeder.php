<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            ['title' => 'Hrvatski jezik', 'language' => 'hr'],
            ['title' => 'Engleski jezik', 'language' => 'en'],
            ['title' => 'Njemački jezik', 'language' => 'de'], 
            ['title' => 'Francuski jezik', 'language' => 'fr'],
            ['title' => 'Talijanski jezik', 'language' => 'it'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }

    }
}
