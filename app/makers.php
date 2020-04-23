<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class makers extends Model
{
    protected $fillable = [
        'name','location','phone_number'
    ];
}
