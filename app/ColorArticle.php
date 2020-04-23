<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorArticle extends Model
{
    protected $fillable = [
        'article_id','color_id'
    ];
}
