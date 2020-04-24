<?php

namespace App\Http\Controllers;

use App\Article;
use App\City;
use App\ColorArticle;
use App\Order;
use App\OrderDetail;
use App\ProcessOrder;
use App\StatusOrder;
use App\TransportFare;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return  response()->json($request->user_id);
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->transport_fares_id = $request->transport_fares_id;
        $order->total_amount = 0;
        $order->save();

        $order_datail = new OrderDetail();
        $order_datail->article_id = $request->article_id;
        $order_datail->order_id = $order->id;
        $order_datail->price_article_id = $request->price_article_id;
        $order_datail->quantity = $request->quantity;
        $order_datail->sub_total = $request->price * $order_datail->quantity;
        $order_datail->save();

        $status_order = new StatusOrder();
        $status_order->order_id = $order->id;
        $status_order->process_order_id = 1;
        $status_order->save();

//        $color_article = new ColorArticle();
//        $color_article->article_id = $request->article_id;
//        $color_article->color_id = $request->color_id;
//        $color_article->save();
//        return response()->json($color_article);
//        return  response()->json($status_order);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function formOrder($article_id)
    {
        $cities = City::all();
        $prices = DB::select("
            select pa.price as price , pa.id as id , pa.is_current as current , a.id as article_id
            from articles a inner join price_articles pa on a.id = pa.article_id
            where a.id = $article_id;
        ");
        $colors = DB::select("
            select c.name as name , c.image as image , c.id as id
            from articles a inner join color_articles ca on a.id = ca.article_id
                 inner join colors c on ca.color_id = c.id
            where a.id = $article_id;
        ");
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

        return view('orders.formOrder',compact('articles','cities','colors','prices'));
    }

    public function getTransportFares(Request $request)
    {
        if ($request->ajax()){
            $transport_fares = TransportFare::where('city_id', $request->city_id)->get();
            foreach ($transport_fares as $transport_fare) {
                $transport_fare_array[$transport_fare->id] = $transport_fare->price;
            }
            return response()->json($transport_fare_array);
        }
    }

    public function ordersInitial()
    {
        $order_details = DB::select("
            select a.id as article_id, o.id as order_id ,
                   u.id as user_id , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as cliente,
                   a.title as articulo , pa.price as precio , od.quantity as cantidad ,
                   od.sub_total as subTotal, avg(od.sub_total) as montoTotal,
                   o.created_at as fecha
            from users u inner join orders o on u.id = o.user_id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
            and pa.is_current = 1
            group by a.id, o.id, u.id, concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name), a.title, pa.price, od.quantity, od.sub_total, o.created_at
            order by fecha desc;
        ");

        return view('orders.orderDetail',compact('order_details'));
    }
}
