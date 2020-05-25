<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentaryArticle extends Model
{
    protected $fillable = [
        'article_id','user_id','comment','created_at','updated_ats'
    ];
}
