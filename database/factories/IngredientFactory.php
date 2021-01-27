<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function(Faker $faker) {
    static $counter = 0;
    $counter ++;
    return [
        'slug' => 'ingredient-'. $counter
    ];
});