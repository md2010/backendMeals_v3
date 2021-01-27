<?php 

namespace App\Http\Filter;

use App\Models\Meal;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\MealTranslation;
use App\Models\CategoryTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Iluminate\Databse\Query\Builder;
use EloquentFilter\AppServiceProvider;
use Illuminate\Support\Str;

class Loader 
{
    public $ingredients;
    public $category;
    public $tags;
    private $params;
    private $arrRelations;

    public function setAtrributes() 
    {
        $this->ingredients = Str::contains($this->params, 'ingredients') ? true : false;
        $this->category = Str::contains($this->params, 'category') ? true : false;
        $this->tags = Str::contains($this->params, 'tags') ? true : false; 
    }

    public function setParams($request)
    {
        $this->params =  $request->input('with');
        $this->arrRelations = explode(",", $this->params); //parse $params in array 
        $this->setAtrributes();
    }
    
    public function load($request, $query)
    {
        $this->setParams($request);       
        if ($this->params) {                             
            return $query->with($this->arrRelations);
        } else { 
            return $query;
        }
    }
    
    
}