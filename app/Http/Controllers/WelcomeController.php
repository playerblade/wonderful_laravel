<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\City;
use App\Maker;
use App\PriceArticle;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $categories = Category::select('categories.*')->orderBy('category','asc')->get();
        $makers = Maker::select('makers.*')->orderBy('name','asc')->get();

        $articles = DB::table('categories')
            ->join('sub_categories','categories.id','=','sub_categories.category_id')
            ->join('articles','sub_categories.id','=','articles.sub_category_id')
            ->join('image_articles','articles.id','=','image_articles.article_id')
            ->join('price_articles','articles.id','=','price_articles.article_id')
            ->join('makers','articles.maker_id','=','makers.id')
            ->where('price_articles.is_current','=',1)
            ->where('image_articles.is_main','=',1)
            ->where('categories.id','=',1)
            ->select('articles.id','articles.title','articles.stock','makers.name','image_articles.url_image','price_articles.price')
            ->orderBy('articles.title','asc')
            ->paginate(3);
//        dd($articles);
//        return response()->json($articles);

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

        $stocks = DB::select("
                    select a.id as id, sum(ca.quantity) as stock
                    from colors c inner join color_articles ca on c.id = ca.color_id
                    inner join articles a on ca.article_id = a.id
                    and a.id = $article_id
                    group by id;
        ");

        $cities = City::all();
        $prices = PriceArticle::join('articles','price_articles.article_id','articles.id')
            ->where('articles.id',$article_id)
            ->select('price_articles.*')->get();

        $colors = DB::select("
            select c.name as name , c.image as image , c.id as color_id, ca.quantity as quantity
            from articles a inner join color_articles ca on a.id = ca.article_id
                 inner join colors c on ca.color_id = c.id
            where a.id = $article_id;
        ");

        $images_articles = DB::table('image_articles')
            ->join('articles','image_articles.article_id','=','articles.id')
            ->select('image_articles.article_id','image_articles.url_image','image_articles.is_main')->get();

        return view('welcome.articleDetail',compact('articles','stocks','cities','prices','colors','images_articles'));
    }

    public function admin(){
        return response()->json('Hello Admin');
    }

    public function geArticlesForCategories(Request $request){
        if ($request->ajax()){
            $articles = DB::table('categories')
                ->join('sub_categories','categories.id','=','sub_categories.category_id')
                ->join('articles','sub_categories.id','=','articles.sub_category_id')
                ->join('image_articles','articles.id','=','image_articles.article_id')
                ->join('price_articles','articles.id','=','price_articles.article_id')
                ->join('makers','articles.maker_id','=','makers.id')
                ->where('price_articles.is_current','=',1)
                ->where('image_articles.is_main','=',1)
                ->where('categories.id','=',$request->category_id)
                ->select('articles.id','articles.title','articles.stock','makers.name','image_articles.url_image','price_articles.price')
                ->orderBy('articles.title','asc')->get();
//                ->paginate(2);
            foreach ($articles as $article) {
                $articles_array[$article->id] = [$article->title,$article->price,$article->name,$article->url_image,$article->stock];
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
                       pa.price as price , a.id as id, a.stock as stock
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
                $articles_array[$article->id] = [$article->articulo,$article->price,$article->fabricante,$article->image,$article->stock];
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
                       pa.price as price , a.id as id , a.stock as stock
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
                $articles_array[$article->id] = [$article->articulo,$article->price,$article->fabricante,$article->image,$article->stock];
//                $articles_array_description[$article->id] = $article->description;
            }
            return response()->json($articles_array);
        }
    }

    public function getMakers(Request $request){
        if ($request->ajax()){
            $makers = DB::table('makers')
                      ->join('articles','makers.id','=','articles.maker_id')
                      ->join('sub_categories','articles.sub_category_id','=','sub_categories.id')
                      ->where('sub_categories.id',$request->sub_category_id)
                      ->select('makers.*')
                      ->orderBy('makers.name','asc')->get();
//            dd($makers);

            foreach ($makers as $maker) {
                $makers_array[$maker->id] = $maker->name;
            }
            return response()->json($makers_array);
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
                $articles_array[$article->title] = [$article->id,$article->url_image,$article->price,$article->name,$article->stock];
            }

            return response()->json($articles_array);
        }
    }
}
