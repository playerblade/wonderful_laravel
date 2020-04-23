<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    function users(){
        return $this->belongsToMany(User::class);
    }

    function clients(){
        return $this->hasMany(Client::class);
    }
}
