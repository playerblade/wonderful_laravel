<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceArticle extends Model
{
    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
