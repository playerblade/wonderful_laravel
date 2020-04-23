<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function priceArticle(){
        return $this->belongsTo(PriceArticle::class);
    }
}
