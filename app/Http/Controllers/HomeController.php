<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\City;
use App\Maker;
use App\PriceArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
//        $categories = Category::all();
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
            ->select('articles.id','articles.title','makers.name','image_articles.url_image','price_articles.price')
//                    ->get();
            ->paginate(5);

        $user = Auth::user();
        if ($request->user()->hasRole('administrador')) {
            return view('layouts.admin.home',compact('user'));
        }elseif($request->user()->hasRole('colaborador')){
            return view('layouts.collaborator.home',compact('user'));
        }elseif($request->user()->hasRole('verificador')){
            return view('layouts.checker.home',compact('user'));
        }elseif($request->user()->hasRole('cliente')){
            return view('layouts.client.home',compact('user','articles','categories','makers'));
        }else{
            return back();
        }

    }

}
