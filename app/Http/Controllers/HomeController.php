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
//        $makers = DB::table('makers')
//                      ->select('makers.*')
//                      ->orderBy('name','asc')->get();

        $articles = DB::select("
                select a.title as articulo , m.name as fabricante, ia.url_image as image,
                       pa.price as price , a.id as id, sc.sub_category, c.category
                from categories c inner join sub_categories sc on c.id=sc.category_id
                    inner join articles a on sc.id=a.sub_category_id
                    inner join image_articles ia on a.id = ia.article_id
                    inner join price_articles pa on a.id = pa.article_id
                    inner join makers m on a.maker_id = m.id
                    and pa.is_current = 1
                    and ia.is_main = 1
                    and c.id = 1
               order by a.title asc;
        ");

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
