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
            ->select('articles.id','articles.title','articles.stock','makers.name','image_articles.url_image','price_articles.price')
            ->orderBy('articles.title','asc')
            ->paginate(5);

        $order_for_collaborator = DB::select("
                    select o.id as order_id ,
                      po.process_order as estado, po.id as process_order_id,
                      o.created_at as fechaOrden , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as usuario,
                      r.id as role_id, o.active as active
                    from roles r inner join users u on r.id = u.role_id
		                inner join user_status_orders uso on u.id = uso.user_id
                        inner join status_orders so on uso.status_order_id = so.id
                        inner join process_orders po on so.process_order_id = po.id
                        inner join orders o on so.order_id = o.id
                        inner join users c on o.user_id = c.id
                    where po.id = 1 or po.id = 2
                    order by o.created_at desc;
        ");

        $order_for_checker = DB::select("
                    select o.id as order_id ,
                      po.process_order as estado, po.id as process_order_id,
                      o.created_at as fechaOrden , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as usuario,
                      r.id as role_id, o.active as active
                    from roles r inner join users u on r.id = u.role_id
		                inner join user_status_orders uso on u.id = uso.user_id
                        inner join status_orders so on uso.status_order_id = so.id
                        inner join process_orders po on so.process_order_id = po.id
                        inner join orders o on so.order_id = o.id
                        inner join users c on o.user_id = c.id
                    where po.id = 3 or po.id = 4
                    order by o.created_at desc;
        ");

        $user = Auth::user();

        if ($request->user()->hasRole('administrador')) {
            return view('layouts.admin.home',compact('user'));
        }elseif($request->user()->hasRole('colaborador')){
            return view('layouts.collaborator.home',compact('user','order_for_collaborator'));
        }elseif($request->user()->hasRole('verificador')){
            return view('layouts.checker.home',compact('user','order_for_checker'));
        }elseif($request->user()->hasRole('cliente')){
            return view('layouts.client.home',compact('user','articles','categories','makers'));
        }else{
            return back();
        }

    }

}
