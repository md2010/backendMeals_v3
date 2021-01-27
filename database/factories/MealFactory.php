<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Meal::class, function(Faker $faker) {
    return [
        'status' => 'created',
        'category_id' => factory(Category::class)
    ];
});
