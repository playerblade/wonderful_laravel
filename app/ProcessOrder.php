<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessOrder extends Model
{
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
