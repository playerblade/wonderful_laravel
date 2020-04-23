<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportFare extends Model
{
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
