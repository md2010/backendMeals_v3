<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Http\Filter\QueryFilter;
use Illuminate\Database\Eloquent\SoftDeletes;


class Meal extends Model 
{
    use HasFactory;   
    use Translatable;
    use SoftDeletes;

    protected $softDelete = true;
    protected $dateFormat = 'U'; //save timestamps in UNIX timestamp format
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public $translatedAttributes = ['title', 'description'];  

    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::Class);
    }  
    
    public function tags()
    {
        return $this->belongsToMany(Tag::Class);
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }

}
