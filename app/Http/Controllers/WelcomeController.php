<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $articles = DB::select("
                select a.title as articulo , a.marker as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join price_articles pa on a.id = pa.article_id
                    and pa.is_current = 1
                    and ia.is_main = 1
                order by articulo desc ;
        ");

        return view('welcome.welcome',compact('articles'));
    }

    public function articleDetail($article_id)
    {
        $articles = DB::select("
                select a.title as articulo , a.marker as fabricante, ia.url_image as image,
                       pa.price as price , a.description as description , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join price_articles pa on a.id = pa.article_id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and a.id = $article_id
                order by articulo desc ;
        ");

        return view('welcome.articleDetail',compact('articles'));
    }

}
