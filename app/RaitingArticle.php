<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaitingArticle extends Model
{
    protected $fillable = [
        'article_id','user_id','star_id','created_at','updated_ats'
    ];
}
