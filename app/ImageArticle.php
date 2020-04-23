<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageArticle extends Model
{
    protected $fillable = [
        'article_id','url_image','is_main'
    ];
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
