<?php

namespace App\Http\Services;

use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\MealTranslation;
use App\Models\CategoryTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Http\Request;
use Iluminate\Databse\Query\Builder;
use EloquentFilter\AppServiceProvider;
use Illuminate\Support\Str;
use App\Http\Filter\Loader;

class Translation 
{
    private $query;
    private $request;

    public function setLanguage()
    {
        app('config')->set('translatable.locale', $this->request->input('lang'));
    }

    public function translateCategory()
    {   
        foreach($this->query as $m){ 
            if ($m['category'] != NULL) {
                $m->makeHidden('category_id');                  
                $m['category']->translate();
                $m['category']->makeHidden('translations');
            }  
        }
        return $this->query;
    }

    public function translateMeal()
    {      
        foreach($this->query as $m) {
            $m->translate();           
            $m->makeHidden('translations', 'category_id');                  
        }  
        return $this->query;
    }

    public function translateIngredient()
    {
        foreach($this->query as $m) {   
            $ingr = $m['ingredients'];
            foreach($ingr as $i) {            
                $i->translate();
                $i->makeHidden('translations', 'pivot'); 
            }                
        }  
        return $this->query;
    }

     public function translateTag()
     {
        foreach($this->query as $m) {   
            $tags = $m['tags'];
            foreach($tags as $t) {            
                $t->translate();
                $t->makeHidden('translations', 'pivot'); 
            }                
        }  
        return $this->query;
    } 

    public function translate($request,$query,$loader)
    {     
        $this->request = $request;
        $this->setLanguage(); 
        $this->query = $query;
        $this->query = $this->translateMeal();

        if ($loader->ingredients != false) { 
            $this->query= $this->translateIngredient();
        }
        if ($loader->category != false) {
            $this->query = $this->translateCategory();
        }
        if ($loader->tags != false) {
            $this->query = $this->translateTag();
        }
        return $this->query;
    }

}