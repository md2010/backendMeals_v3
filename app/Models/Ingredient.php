<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory;
    use Translatable;
    
    public $translatedAttributes = ['title']; 
    protected $hidden = ['created_at', 'updated_at'];

    public function meals(){
        return $this->belongsToMany(Meal::Class);
    }
}
