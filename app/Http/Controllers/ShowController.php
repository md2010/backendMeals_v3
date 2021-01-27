<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Filter\Loader;
use App\Http\Filter\MealFilter;
use Astrotomic\Translatable\Translatable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use Iluminate\Databse\Query\Builder;
use App\Http\Services\Translation;
use App\Http\Requests\QueryParametersRequest;

class ShowController extends Controller
{ 
    protected $translation;
    protected $loader;
    protected $query;

    public function __construct(Translation $translation, Loader $loader)
    {
        $this->translation = $translation;
        $this->loader = $loader;
        $this->query =  Meal::query();
    }
   
    public function index()
    {
        return response()->json(Meal::all()->paginate(2),200,[],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function show(QueryParametersRequest $request, MealFilter $filters)
    {           
        $validated = $request->validated();
        
        $this->query = Meal::filter($filters);
        $this->query = $this->loader->load($request, $this->query)->get();
        $translated = $this->translation->translate($request,$this->query, $this->loader);

        $perPage = $request->input('per_page');      
        return response()->json($translated->paginate($perPage),200,[],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
   
}
