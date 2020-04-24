<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id','sub_category_id','title', 'marker','description','stock'
    ];

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function imageArticles(){
        return $this->hasMany(ImageArticle::class);
    }

    public function priceArticles(){
        return $this->hasMany(PriceArticle::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

//    public function clients(){
//        return $this->belongsToMany(Client::class);
//    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
