<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function transportFare(){
        return $this->belongsTo(TransportFare::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function procesOrders(){
        return $this->belongsToMany(ProcessOrder::class);
    }
}
