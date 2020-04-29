<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $categories = Category::all();
        $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                order by articulo desc;
        ");

        return view('welcome.welcome',compact('articles','categories'));
    }

    public function articleDetail($article_id)
    {
        $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.description as description , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and a.id = $article_id
                order by articulo desc ;
        ");

        return view('welcome.articleDetail',compact('articles'));
    }

    public function admin(){
        return response()->json('Hello Admin');
    }
    public function get_sub_categories_search(Request $request){
        if ($request->ajax()){
            $sub_categories = SubCategory::where('category_id', $request->category_id)->get();

            foreach ($sub_categories as $sub_category) {
                $sub_categories_array[$sub_category->id] = $sub_category->sub_category;
            }
            return response()->json($sub_categories_array);
        }
    }

    public function get_articles_search(Request $request){
        if ($request->ajax()){
            $articles = Article::where('sub_category_id', $request->sub_category_id)->get();

            foreach ($articles as $article) {
                $articles_array[$article->id] = [$article->title,$article->description];
//                $articles_array_description[$article->id] = $article->description;
            }
            return response()->json($articles_array);
        }
    }
}
