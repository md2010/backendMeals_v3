<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Astrotomic\Translatable\Translatable;
use Illuminate\Contracts\Support\Jsonable;
use Iluminate\Databse\Query\Builder;
use App\Http\Services\Translation;
use App\Http\Requests\QueryParametersRequest;
use App\Http\Filter\Loader;
use App\Http\Filter\MealFilter;
use App\Http\Resources\MealCollection;
use App\Models\Meal;

class MealResourceController extends Controller
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

    public function show()
    {
        $data = DB::table('meals')->paginate();
        return new MealCollection($data);
    }

     
    public function index(QueryParametersRequest $request, MealFilter $filters)
    {
        $validated = $request->validated();
        $perPage = $request->input('per_page'); 

        $this->query = Meal::filter($filters);
        $this->query = $this->loader->load($request, $this->query)
                                    ->paginate($perPage)
                                    ->appends((request()->query()));
        $translated = $this->translation
                            ->translate($request,$this->query, $this->loader);   

        return new MealCollection($translated);
    }
 
    public function update(Request $request)
    {
        $timestamp = $request->input('diff_time');
        if ($timestamp != null){
            DB::table('meals')
                ->where('updated_at', '>', 'diff_time')
                ->update(['status' => 'updated']);
            DB::table('meals')
                ->where('deleted_at', '>', 'diff_time')
                ->update(['status' => 'deleted']);
        }
    }

}
