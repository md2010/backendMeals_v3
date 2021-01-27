<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    public function run($languages)
    {
        foreach ($languages as $language) {
            DB::table('languages')->insert([
                'lang' => $language
            ]);
        }
    }
}
