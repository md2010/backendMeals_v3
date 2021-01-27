<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{   
    public function run()
    {     
        $numberOfMeals = 6;
        $numberOfIngredients = 6;
        $numberOfTags = 6;
        $numberOfCategories = $numberOfMeals; //MealFactory calls CategoryFactory

        $meals = factory(Meal::class, $numberOfMeals)->create();
        $ingredients = factory(Ingredient::class, $numberOfIngredients)->create();
        $tags = factory(Tag::Class, $numberOfTags)->create(); 

        $meals->each(function(Meal $m) use ($tags) {
            $m->tags()->attach(
                $tags->random(rand(1, 6))->pluck('id')->toArray()
                
            );
        });
        $meals->each(function(Meal $m) use ($ingredients) {
            $m->ingredients()->attach(
                $ingredients->random(rand(1, 6))->pluck('id')->toArray()
                
            );
        }); 
        $languages = ['en', 'hr', 'fr', 'de']; //input all languages for which translation is needed
        $this->callWith(LanguageSeeder::class, ['languages' => $languages]);
        $this->callWith(IngredientTranslationSeeder::class, ['IDs' => $numberOfIngredients, 'locales' => $languages]); 
        $this->callWith(TagTranslationSeeder::class, ['IDs' => $numberOfTags, 'locales' => $languages]); 
        $this->callWith(MealTranslationSeeder::class, ['IDs' => $numberOfMeals, 'locales' => $languages]);
        $this->callWith(CategoryTranslationSeeder::class, ['IDs' => $numberOfCategories, 'locales' => $languages]);

        $mealDelete = Meal::where('id', 5)->delete();
        
    }

}
