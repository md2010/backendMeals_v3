<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationSeeder extends Seeder
{
    public function run($IDs, $locales)
    {
        for ($i = 1; $i <= $IDs; $i++){
            foreach ($locales as $locale){
                DB::table('category_translations')->insert([
                    [
                        'category_id' => $i,
                        'locale' => $locale,
                        'title' => 'Naslov kategorije ' .$i. ' na ' .$locale. ' jeziku'
                    ]
                ]);
            }
        }
    }
}
