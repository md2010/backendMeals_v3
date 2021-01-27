<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


$factory->define(Category::class, function (Faker $faker) {
    static $counter = 0;
    $counter++;
    return [
        'slug' => 'category-'. $counter
    ];
});


