<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function transportFares(){
        return $this->hasMany(TransportFare::class);
    }
}
