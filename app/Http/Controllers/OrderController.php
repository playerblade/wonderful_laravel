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
        return response()->json("Hello Index");
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
//        1 paso crea una orden
        $order = new Order();
        $order->transport_fares_id = 4;
        $order->user_id =  $request->user_id;
        $order->total_amount = 0;
        $order->save();

        $length_colors = sizeof($request->color_article);
        if ($length_colors > 1){
            $list = [];
            foreach ($request->color_article as $colors){
                $data = [
                    'article_id' => $request->article_id,
                    'order_id' => $order->id,
                    'price_article_id' => $request->price_article_id,
                    'color_article' => $colors,
                    'quantity' => 1,
                    'sub_total' => $request->price * 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
//                $order_detail = new OrderDetail();
                array_push($list,$data);
            }
            DB::table('order_details')->insert($list);
//            return response()->json($list);
        }else{
            $order_datail = new OrderDetail();
            $order_datail->article_id = $request->article_id;
            $order_datail->order_id = $order->id;
            $order_datail->price_article_id = $request->price_article_id;
            $order_datail->color_article = $request->color_article[0];
            $order_datail->quantity = $request->quantity;
            $order_datail->sub_total = $request->price * $order_datail->quantity;
            $order_datail->save();
//            return response()->json($order_datail);
        }

        $status_order = new StatusOrder();
        $status_order->order_id = $order->id;
        $status_order->process_order_id = 1;
        $status_order->save();

        return redirect()->route('orderAdd',['order_id' => $order->id])->with('200 , the first artcle add on order');
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
        $orders = DB::select("
            select o.id as order_id ,tf.id  as transport_fares_id , c.id as city_id , u.id as user_id,
                   c.city as city , tf.price as price, o.total_amount as total_amount
            from users u inner join orders o on u.id = o.user_id
                 inner join transport_fares tf on o.transport_fares_id = tf.id
                 inner join cities c on tf.city_id = c.id
            where o.id = $order->id;
        ");
        $cities = City::all();
        $order_details = DB::select("
            select o.id as order_id , a.title as articulo , od.quantity as cantidad, od.color_article as color,
                   od.sub_total as subTotal, pa.price as precio , od.created_at as fecha,
                   ia.url_image as imagen
            from users u inner join orders o on u.id = o.user_id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join image_articles as ia on ia.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
            and o.id = $order->id
            -- and o.id = 14
            and ia.is_main = 1
            and pa.is_current = 1
        ");

        $totalAmounts = DB::select("
            select o.id as order_id, sum(od.sub_total) as montoTotal
            from users u inner join orders o on u.id = o.user_id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
                  and o.id= $order->id
                  and pa.is_current = 1
            group by o.id , u.id;
        ");
        return view('orders.shipingMethods',compact('order','order_details','orders','cities','totalAmounts'));
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
        $order->transport_fares_id = $request->transport_fares_id;
        $order->user_id = $request->user_id;
        $order->total_amount = $request->total_amount;
        $order->update();

        return redirect()->route('paymentMethods',['order_id' => $order->id]);
//        return response()->json($order);
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

        return view('orders.formOrder',compact('articles','cities','colors','prices'));
    }

    public function getTransportFares(Request $request)
    {
        if ($request->ajax()){
            $transport_fares = TransportFare::where('city_id', $request->city_id)->get();
            foreach ($transport_fares as $transport_fare) {
                $transport_fare_array[$transport_fare->id] = [$transport_fare->price,$transport_fare->shiping];
            }
            return response()->json($transport_fare_array);
        }
    }

    public function articleAddMore($order_id)
    {
        $orders = DB::select("
            select o.id as order_id ,tf.id  as transport_fares_id , c.id as city_id , u.id as user_id
            from users u inner join orders o on u.id = o.user_id
                 inner join transport_fares tf on o.transport_fares_id = tf.id
                 inner join cities c on tf.city_id = c.id
            where o.id = $order_id;
        ");

        $order_details = DB::select("
            select o.id as order_id , a.title as articulo , od.quantity as cantidad, od.color_article as color,
                   od.sub_total as subTotal, pa.price as precio , od.created_at as fecha,
                   ia.url_image as imagen
            from users u inner join orders o on u.id = o.user_id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join image_articles as ia on ia.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
            and o.id = $order_id
            -- and o.id = 14
            and ia.is_main = 1
            and pa.is_current = 1
        ");
        return view('orders.orderDetailAddMore',compact('order_details','orders'));
    }

    public function showMoreArticles($order_id){
        $orders = DB::select("
            select o.id as order_id
            from orders o
            where o.id = $order_id;
        ");
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
        return view('orders.showMore',compact('articles','orders'));
    }

    public function formAddMoreArticles($article_id , $order_id){
        $orders = DB::select("
            select o.id as order_id
            from orders o
            where o.id = $order_id;
        ");
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

        return view('orders.formOrderMore',compact('articles','colors','prices','orders'));
    }

    public function addMoreArticles(Request $request)
    {
        $length_colors = sizeof($request->color_article);
        if ($length_colors > 1){
            $list = [];
            foreach ($request->color_article as $colors){
                $data = [
                    'article_id' => $request->article_id,
                    'order_id' => $request->order_id,
                    'price_article_id' => $request->price_article_id,
                    'color_article' => $colors,
                    'quantity' => 1,
                    'sub_total' => $request->price * 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
//                $order_detail = new OrderDetail();
                array_push($list,$data);
            }
            DB::table('order_details')->insert($list);
//            return response()->json($list);
        }else{
            $order_datail = new OrderDetail();
            $order_datail->article_id = $request->article_id;
            $order_datail->order_id = $request->order_id;
            $order_datail->price_article_id = $request->price_article_id;
            $order_datail->color_article = $request->color_article[0];
            $order_datail->quantity = $request->quantity;
            $order_datail->sub_total = $request->price * $order_datail->quantity;
            $order_datail->save();
//            return response()->json($order_datail);
        }

//        $status_order = new StatusOrder();
//        $status_order->order_id = $order->id;
//        $status_order->process_order_id = 1;
//        $status_order->save();

        return redirect()->route('orderAdd',['order_id' => $request->order_id])->with('200 , the first artcle add on order');
    }

    public function paymentMethods($order_id){
        $orders = DB::select("
            select o.id as order_id ,tf.id  as transport_fares_id , c.id as city_id , u.id as user_id,
                   c.city as city , tf.price as price, o.total_amount as total_amount
            from users u inner join orders o on u.id = o.user_id
                 inner join transport_fares tf on o.transport_fares_id = tf.id
                 inner join cities c on tf.city_id = c.id
            where o.id = $order_id;
        ");

        $cities = City::all();
        $order_details = DB::select("
            select o.id as order_id , a.title as articulo , od.quantity as cantidad, od.color_article as color,
                   od.sub_total as subTotal, pa.price as precio , od.created_at as fecha,
                   ia.url_image as imagen
            from users u inner join orders o on u.id = o.user_id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join image_articles as ia on ia.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
            and o.id = $order_id
            -- and o.id = 14
            and ia.is_main = 1
            and pa.is_current = 1
        ");

        $totalAmounts = DB::select("
            select o.id as order_id, sum(od.sub_total) as montoTotal
            from users u inner join orders o on u.id = o.user_id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
                  and o.id= $order_id
                  and pa.is_current = 1
            group by o.id , u.id;
        ");
        return view('orders.paymentMethods',compact('order_details','orders','cities','totalAmounts'));
    }
}
