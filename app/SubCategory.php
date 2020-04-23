<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id','sub_category'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}
