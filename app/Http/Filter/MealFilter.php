<?php 

namespace App\Http\Filter;

use App\Http\Filter\QueryFilter;
use Iluminate\Databse\Query\Builder;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealFilter extends QueryFilter
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }
  
    public function category($term) 
    {
        if ($term == NULL) { //in query string-> category=
            return $this->builder->where('meals.category_id', NULL);
        } else 
        return $this->builder->where('meals.category_id', 'LIKE',  $term);
    }
  
    public function tags($term) 
    {
        $arrTags = explode(",", $term);
        foreach ($arrTags as $tag) {
            $this->builder = $this->builder->whereHas('tags', function ($query) use ($tag) {
                return $query->where('tag_id', 'LIKE', "%$tag%");
            });
        }
        return $this->builder;
    }   

    public function diff_time($term)
    {
        if ($term > 0){
            return $this->builder->where('created_at', '>', $term)
                                 ->orWhere('updated_at', '>', $term)
                                 ->orWhere('deleted_at', '>', $term)
                                 ->restore();
        }        
    }

}
