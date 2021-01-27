<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    
    public $fillable = ['id', 'slug'];
    protected $hidden = ['created_at', 'updated_at'];
    public $translatedAttributes = ['title']; 

    public function meals(){
        return $this->hasMany(Meal::Class);
    }

    public function categoryTranslations(){
        return $this->hasMany(CategoryTranslation::class);
    }
}
