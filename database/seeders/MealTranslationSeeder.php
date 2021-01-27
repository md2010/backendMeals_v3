<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTranslationSeeder extends Seeder
{
    public function run($IDs, $locales)
    {
        for ($i = 1; $i <= $IDs; $i++){
            foreach ($locales as $locale){
                DB::table('meal_translations')->insert([
                    [
                        'meal_id' => $i,
                        'description' => 'Opis jela ' .$i. ' na ' .$locale. 'jeziku',
                        'title' => 'Naslov jela ' .$i.  ' na ' .$locale. ' jeziku',
                        'locale' => $locale
                    ]
                ]);
            }
        }
    }
}
