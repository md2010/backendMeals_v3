<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientTranslationSeeder extends Seeder
{
    public function run($IDs, $locales)
    {
        for ($i = 1; $i <= $IDs; $i++){
            foreach ($locales as $locale){
                DB::table('ingredient_translations')->insert([
                    [
                        'ingredient_id' => $i,
                        'locale' => $locale,
                        'title' => 'Naslov sastojka ' .$i. ' na ' .$locale. ' jeziku'
                    ]
                ]);
            }
        }
    }

}
