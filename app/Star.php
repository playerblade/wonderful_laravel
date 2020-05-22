<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $fillable = [
        'id','star','created_at','updated_ats'
    ];
}
