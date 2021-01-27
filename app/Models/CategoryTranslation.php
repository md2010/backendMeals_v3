<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTranslation extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['category_id','locale','title'];

    public function category(){
        return belongsTo(Category::Class);
    }
}
