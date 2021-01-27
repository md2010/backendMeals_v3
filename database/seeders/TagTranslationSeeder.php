<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTranslationSeeder extends Seeder
{
    public function run($IDs, $locales)
    {
        for ($i = 1; $i <= $IDs; $i++){
            foreach ($locales as $locale){
                DB::table('tag_translations')->insert([
                    [
                        'tag_id' => $i,
                        'locale' => $locale,
                        'title' => 'Naslov na taga ' .$i. ' na ' .$locale. ' jeziku'
                    ]
                ]);
            }
        }
    }
}
