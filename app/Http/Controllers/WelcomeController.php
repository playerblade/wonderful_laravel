<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Maker;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $categories = Category::orderBy('categories.category')->get();
        $makers = Maker::orderBy('makers.name')->get();
        $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join sub_categories sc on a.sub_category_id = sc.id
                    inner join categories c on sc.category_id = c.id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and c.id = 1
               order by a.title asc;
        ");

        return view('welcome.welcome',compact('articles','categories','makers'));
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

    public function geArticlesForCategories(Request $request){
        if ($request->ajax()){
//            $articles = Article::where('sub_category_id', $request->sub_category_id)->get();
            $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join sub_categories sc on a.sub_category_id = sc.id
                    inner join categories c on sc.category_id = c.id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and c.id = $request->category_id
                order by articulo asc;
            ");
            foreach ($articles as $article) {
                $articles_array[$article->id] = [$article->articulo,$article->price,$article->fabricante,$article->image];
//                $articles_array_description[$article->id] = $article->description;
            }
            return response()->json($articles_array);
        }
    }

    public function getSubCategories(Request $request){
        if ($request->ajax()){
            $sub_categories = SubCategory::where('category_id', $request->category_id)
                                           ->orderBy('sub_category','asc')->get();

            foreach ($sub_categories as $sub_category) {
                $sub_categories_array[$sub_category->id] = $sub_category->sub_category;
            }
            return response()->json($sub_categories_array);
        }
    }

    public function getArticlesForSubCategories(Request $request){
        if ($request->ajax()){
//            $articles = Article::where('sub_category_id', $request->sub_category_id)->get();
            $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join sub_categories sc on a.sub_category_id = sc.id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and sc.id = $request->sub_category_id
                order by articulo asc;
            ");
            foreach ($articles as $article) {
                $articles_array[$article->id] = [$article->articulo,$article->price,$article->fabricante,$article->image];
//                $articles_array_description[$article->id] = $article->description;
            }
            return response()->json($articles_array);
        }
    }
    public function getArticlesForMakers(Request $request){
        if ($request->ajax()){
//            $articles = Article::where('sub_category_id', $request->sub_category_id)->get();
            $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join sub_categories sc on a.sub_category_id = sc.id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and m.id = $request->maker_id
                order by articulo asc;
            ");
            foreach ($articles as $article) {
                $articles_array[$article->id] = [$article->articulo,$article->price,$article->fabricante,$article->image];
//                $articles_array_description[$article->id] = $article->description;
            }
            return response()->json($articles_array);
        }
    }

    public function getArticlesForMakersAndSubCategories(Request $request){
        if ($request->ajax()){
//            $articles = Article::where('sub_category_id', $request->sub_category_id)->get();
            $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join sub_categories sc on a.sub_category_id = sc.id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and m.id = $request->maker_id
                    and sc.id = $request->sub_category_id
                order by articulo asc;
            ");
            foreach ($articles as $article) {
                $articles_array[$article->id] = [$article->articulo,$article->price,$article->fabricante,$article->image];
//                $articles_array_description[$article->id] = $article->description;
            }
            return response()->json($articles_array);
        }
    }

    public function getSearchArticles(Request $request){
        if ($request->ajax()){
//            $articles = DB::table('articles')->where('title','LIKE','%'.$request->text.'%')->get();
            $articles = DB::table('articles')
                ->join('image_articles','articles.id','=','image_articles.article_id')
                ->join('price_articles','articles.id','=','price_articles.id')
                ->join('makers','articles.maker_id','=','makers.id')
                ->where('articles.title','LIKE','%'.$request->text.'%')
                ->select('articles.*','image_articles.url_image','price_articles.price','makers.name')
                ->orderBy('title','asc')->get();

            foreach ($articles as $article) {
                $articles_array[$article->title] = [$article->id,$article->url_image,$article->price,$article->name];
            }

            return response()->json($articles_array);
        }
    }
}
