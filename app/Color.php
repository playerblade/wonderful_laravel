<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name','image'
    ];
    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}
