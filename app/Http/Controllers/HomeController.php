<?php

namespace App\Http\Controllers;

use App\Category;
use App\Maker;
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
        $categories = Category::all();
        $makers = Maker::all();
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

        $user = Auth::user();
        if ($request->user()->hasRole('administrador')) {
            return view('layouts.admin.home',compact('user'));
        }
        if ($request->user()->hasRole('colaborador')){
            return view('layouts.collaborator.home',compact('user'));
        }
        if ($request->user()->hasRole('verificador')){
            return view('layouts.checker.home',compact('user'));
        }
        if ($request->user()->hasRole('cliente')){
            return view('layouts.client.home',compact('user','articles','categories','makers'));
        }

    }

}
