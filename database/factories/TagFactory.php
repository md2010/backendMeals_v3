<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

$factory->define(Tag::class, function(Faker $faker) {
    static $counter = 0;
    $counter ++;
    return [
        'slug' => 'tag-'. $counter
    ];
});