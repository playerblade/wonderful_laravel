<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\City;
use App\ColorArticle;
use App\Maker;
use App\Order;
use App\OrderDetail;
use App\PriceArticle;
use App\ProcessOrder;
use App\StatusOrder;
use App\TransportFare;
use App\User;
use App\UserStatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
        $colors=DB::table('colors')
            ->where('colors.image',[$request->color_article])
            ->select('colors.*')->get();

        $quantity = DB::table('color_articles')
            ->join('colors','color_articles.color_id','=','colors.id')
            ->join('articles','color_articles.article_id','=','articles.id')
            ->where('color_articles.color_id',[$colors[0]->id])
            ->where('article_id',[$request->article_id])
            ->select('color_articles.quantity')->get();

        if ($request->quantity > $quantity[0]->quantity){
            return redirect()->back()->with('alert','No hay suficientes productos en el stock');

        }else{
//        1 paso crea una orden
            $order = new Order();
            $order->transport_fares_id = 4;
            $order->user_id =  $request->user_id;
            $order->total_amount = 0;
            $order->location = '';
            $order->active = 1;
            $order->save();

            $length_colors = sizeof($request->color_article);
//            aqui validamos si colo que ingresa son mas de 2 colores
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
                    array_push($list,$data);
                }
                DB::table('order_details')->insert($list);
            }else{
                $order_datail = new OrderDetail();
                $order_datail->article_id = $request->article_id;
                $order_datail->order_id = $order->id;
                $order_datail->price_article_id = $request->price_article_id;
                $order_datail->color_article = $request->color_article[0];
                $order_datail->quantity = $request->quantity;
                $order_datail->sub_total = $request->price * $order_datail->quantity;
                $order_datail->price_article = $request->price;
                $order_datail->save();

                $colors=DB::table('colors')
                ->where('colors.image',[$request->color_article])
                ->select('colors.*')->get();

                $quantity = DB::table('color_articles')
                ->join('colors','color_articles.color_id','=','colors.id')
                ->join('articles','color_articles.article_id','=','articles.id')
                ->where('color_articles.color_id',[$colors[0]->id])
                ->where('article_id',[$request->article_id])
                ->select('color_articles.quantity')->get();

                DB::table('color_articles')
                ->join('colors','color_articles.color_id','=','colors.id')
                ->join('articles','color_articles.article_id','=','articles.id')
                ->where('color_articles.color_id',[$colors[0]->id])
                ->where('article_id',[$request->article_id])
                ->update(['color_articles.quantity'=> $quantity[0]->quantity - $request->quantity]);

                $stock = DB::table('articles')
                    ->where('id',[$request->article_id])
                    ->select('stock')
                    ->first();

                DB::table('articles')
                ->where('id',[$request->article_id])
                ->update(['stock'=> $stock->stock - $request->quantity]);
            }

//            DB::beginTransaction();
//            try {
                $status_order = new StatusOrder();
                $status_order->order_id = $order->id;
                $status_order->process_order_id = 1;
                $status_order->save();

                $user_status_order = new UserStatusOrder();
                $user_status_order->status_order_id = $status_order->id;
                $user_status_order->user_id = Auth::user()->id;
                $user_status_order->save();

//              step 2  if all good commit
//                DB::commit();
//            } catch (\Exception $exception) {
//               step 3 if some error rollback
//                DB::rollBack();
//            }


//            return response()->json($user_status_order);

            return redirect()->route('orderAdd',['order_id' => $order->id])->with('200 , the first artcle add on order');
        }
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
                   od.sub_total as subTotal, pa.price as precio , o.created_at as fecha,
                   ia.url_image as imagen, od.id as id
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
        $order->location = $request->location;
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
        // $decrypt_article_id = Crypt::decrypt($article_id);
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

//        validation query for raiting and camentary article
        $orders_validation = DB::table('process_orders')
            ->join('status_orders','process_orders.id','=','status_orders.process_order_id')
            ->join('orders','status_orders.order_id','=','orders.id')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->join('articles','order_details.article_id','=','articles.id')
            ->where('articles.id',$article_id)
            ->where('process_orders.id',4)
            ->where('orders.user_id',Auth::user()->id)->first();
//        dd($orders_validation);
//        list raiting and commentary article
        $commentaries = DB::table('commentary_articles')->join('users','commentary_articles.user_id','=','users.id')
                        ->join('raiting_articles','raiting_articles.user_id','=','users.id')
                        ->join('stars','raiting_articles.star_id','=','stars.id')
                        ->select('commentary_articles.comment','commentary_articles.id','raiting_articles.star_id','commentary_articles.created_at',DB::raw("CONCAT(users.last_name,' ',users.mother_last_name,' ',users.first_name) as full_name"))
                        ->where('commentary_articles.article_id',$article_id)
                        ->where('commentary_articles.is_main',1)
                        ->where('raiting_articles.article_id',$article_id)
                        ->groupBy('commentary_articles.comment','commentary_articles.id','raiting_articles.star_id','commentary_articles.created_at','users.last_name','users.mother_last_name','users.first_name')
                        ->orderBy('commentary_articles.created_at','desc')->get();

        $commentaries_0 = DB::table('commentary_articles')->join('users','commentary_articles.user_id','=','users.id')
                        ->join('raiting_articles','raiting_articles.user_id','=','users.id')
                        ->join('stars','raiting_articles.star_id','=','stars.id')
                        ->select('commentary_articles.comment','commentary_articles.id','raiting_articles.star_id','commentary_articles.created_at',DB::raw("CONCAT(users.last_name,' ',users.mother_last_name,' ',users.first_name) as full_name"))
                        ->where('commentary_articles.article_id',$article_id)
                        ->where('commentary_articles.is_main',0)
                        ->where('commentary_articles.user_id','=',Auth::user()->id)
                        ->where('raiting_articles.article_id',$article_id)
                        ->groupBy('commentary_articles.comment','commentary_articles.id','raiting_articles.star_id','commentary_articles.created_at','users.last_name','users.mother_last_name','users.first_name')
                        ->orderBy('commentary_articles.created_at','asc')->get();
//        dd($commentaries);

        $raitings = DB::select(
            "select c.id as user, a.id as article_id, a.title as article ,s.id as estrella, s.star as nameRaiting , count(ra.star_id) as cantidadCliente
            from stars s inner join raiting_articles ra on s.id = ra.star_id
               inner join users c on ra.user_id = c.id
               -- inner join roles r on c.role_id = r.id
               -- inner join commentary_articles ca on c.id = ca.user_id
               inner join articles a on ra.article_id = a.id
               -- where c.role_id = 5
               where a.id = $article_id
               group by s.id, a.id,a.title, s.star,c.id
               order by s.star desc;

        ");
        $raitingsA = DB::select(
            "select a.id as article_id, a.title as article ,s.id as estrella, s.star as nameRaiting , count(ra.star_id) as cantidadCliente
            from stars s inner join raiting_articles ra on s.id = ra.star_id
               inner join users c on ra.user_id = c.id
               -- inner join roles r on c.role_id = r.id
               inner join commentary_articles ca on c.id = ca.user_id
               inner join articles a on ra.article_id = a.id
               -- where c.role_id = 5
               where a.id = $article_id
               group by s.id, a.id,a.title, s.star
               order by s.star desc;

        ");
        $porcentajes = DB::select("
                select cantidad.article, sum(cantidad.cantidadCliente) as montoTotal
                 from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.user_id) as cantidadCliente
                      from stars s inner join raiting_articles ra on s.id = ra.star_id
                           inner join users c on ra.user_id = c.id
                           -- inner join commentary_articles ca on c.id = ca.user_id
                           inner join articles a on ra.article_id = a.id
                           where a.id = $article_id
                           group by s.id, a.title, s.star
                           order by s.star) as cantidad
                  group by cantidad.article;
        ");
        $porcentajesA = DB::select("
                select cantidad.article, sum(cantidad.cantidadCliente) as montoTotal
                 from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.user_id) as cantidadCliente
                      from stars s inner join raiting_articles ra on s.id = ra.star_id
                           inner join users c on ra.user_id = c.id
                           inner join commentary_articles ca on c.id = ca.user_id
                           inner join articles a on ra.article_id = a.id
                           where a.id = $article_id
                           group by s.id, a.title, s.star
                           order by s.star) as cantidad
                  group by cantidad.article;
        ");
        $maximoDeEstrella = DB::select("
                select cantidad.article, max(cantidad.cantidadCliente) as maximo
                 from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                      from stars s inner join raiting_articles ra on s.id = ra.star_id
                           inner join users c on ra.user_id = c.id
                           inner join commentary_articles ca on c.id = ca.user_id
                           inner join articles a on ra.article_id = a.id
                           where a.id = $article_id
                           group by s.id, a.title, s.star
                           order by s.star) as cantidad
                  group by cantidad.article;
        ");
        $agruparRaitingsIguales = DB::select(
            "select cantidad.article, cantidad.cantidadCliente as cantidadClientee
            from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                 from stars s inner join raiting_articles ra on s.id = ra.star_id
                      inner join users c on ra.user_id = c.id
                      inner join commentary_articles ca on c.id = ca.user_id
                      inner join articles a on ra.article_id = a.id
                      where a.id = $article_id
                      group by s.id, a.title, s.star
                      order by s.star) as cantidad
             group by cantidad.article,cantidad.cantidadCliente;

        ");

        $validacionDeRainting = DB::table('raiting_articles')
            ->join('users','raiting_articles.user_id','=','users.id')
            ->join('articles','raiting_articles.article_id','=','articles.id')
            ->where('articles.id',$article_id)
            ->where('raiting_articles.user_id',Auth::user()->id)->first();

        $images_articles = DB::table('image_articles')
            ->join('articles','image_articles.article_id','=','articles.id')
            ->select('image_articles.article_id','image_articles.url_image','image_articles.is_main')->get();

        return view('orders.formOrder',compact('articles','cities','colors','prices','stocks','orders_validation','commentaries','raitings','porcentajes','maximoDeEstrella','agruparRaitingsIguales','commentaries_0','validacionDeRainting','porcentajesA','raitingsA','images_articles'));
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
            ->select('articles.id','articles.title','articles.stock','makers.name','image_articles.url_image','price_articles.price')
            ->orderBy('articles.title','asc')
            ->paginate(5);

        return view('orders.showMore',compact('articles','orders','categories','makers'));
    }

    public function formAddMoreArticles($article_id , $order_id){
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
        $orders = DB::select("
            select o.id as order_id
            from orders o
            where o.id = $order_id;
        ");

        $images_articles = DB::table('image_articles')
            ->join('articles','image_articles.article_id','=','articles.id')
            ->select('image_articles.article_id','image_articles.url_image','image_articles.is_main')->get();

        return view('orders.formOrderMore',compact('articles','cities','colors','prices','stocks','orders','images_articles'));
    }

    public function addMoreArticles(Request $request)
    {
        $colors=DB::table('colors')
            // ->join('colors','color_articles.color_id','=','colors.id')
            // ->join('articles','color_articles.article_id','=','articles.id')
            ->where('colors.image',[$request->color_article])
            ->select('colors.*')->get();

//              $res = $request->quantity_total - $request->quantity;
        $quantity=DB::table('color_articles')
            ->join('colors','color_articles.color_id','=','colors.id')
            ->join('articles','color_articles.article_id','=','articles.id')
            // ->where('colors.image',[$request->color_article])
            ->where('color_articles.color_id',[$colors[0]->id])
            ->where('article_id',[$request->article_id])
            ->select('color_articles.quantity')->get();

        if ($request->quantity > $quantity[0]->quantity){
            return redirect()->back()->with('alert','No hay suficientes productos en el stock');

        }else{

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

                $colors=DB::table('colors')
                        ->where('colors.image',[$request->color_article])
                        ->select('colors.*')->get();

    //                $res = $request->quantity_total - $request->quantity;
                $quantity=DB::table('color_articles')
                    ->join('colors','color_articles.color_id','=','colors.id')
                    ->join('articles','color_articles.article_id','=','articles.id')
                    // ->where('colors.image',[$request->color_article])
                    ->where('color_articles.color_id',[$colors[0]->id])
                    ->where('article_id',[$request->article_id])
                    ->select('color_articles.quantity')->get();

                DB::table('color_articles')
                    ->join('colors','color_articles.color_id','=','colors.id')
                    ->join('articles','color_articles.article_id','=','articles.id')
                    // ->where('colors.image',[$request->color_article])
                    ->where('color_articles.color_id',[$colors[0]->id])
                    ->where('article_id',[$request->article_id])
                    ->update(['color_articles.quantity'=> $quantity[0]->quantity - $request->quantity]);

                $stock = DB::table('articles')
                    ->where('id',[$request->article_id])
                    ->select('stock')
                    ->first();

                DB::table('articles')
                    ->where('id',[$request->article_id])
                    ->update(['stock'=> $stock->stock - $request->quantity]);

    //            return response()->json($order_datail);
            }
        }
        return redirect()->route('orderAdd',['order_id' => $request->order_id])->with('200 , the first artcle add on order');
    }

    public function paymentMethods($order_id){
        $orders = DB::select("
            select o.id as order_id ,tf.shiping  as shiping , c.id as city_id , u.id as user_id,
                   c.city as city , tf.price as price, o.total_amount as total_amount , o.location as location
            from users u inner join orders o on u.id = o.user_id
                 inner join transport_fares tf on o.transport_fares_id = tf.id
                 inner join cities c on tf.city_id = c.id
            where o.id = $order_id;
        ");

        $cities = City::all();
        $order_details = DB::select("
            select o.id as order_id , a.title as articulo , od.quantity as cantidad, od.color_article as color,
                   od.sub_total as subTotal, pa.price as precio , o.created_at as fecha,
                   ia.url_image as imagen , od.id as id
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

    public function orderCancel($order_id , Request $request)
    {
//        $colors = DB::table('color_articles')
//        ->join('colors','color_articles.color_id','=','colors.id')
//        ->join('articles','color_articles.article_id','=','articles.id')
//        ->join('order_details','order_details.article_id','=','articles.id')
//        ->join('orders','order_details.order_id','=','orders.id')
//        ->select('color_articles.quantity','color_articles.article_id','color_articles.color_id')
//        ->where('order_id',$order_id)
//        ->where('colors.image',$request->article)->get();

        $order_details = DB::table('order_details')
            ->select('order_details.*')
            ->where('order_id',$order_id)->get();

//        $array = array();
        foreach ($order_details as $order_detail){

            $array[] = DB::table('color_articles')
//                        ->join('colors','color_articles.article_id','=','colors.id')
                        ->where('article_id',[$order_detail->article_id])
//                        ->where('colors.name',[$order_detail->color_article])
                        ->update(['quantity' => $order_detail->quantity + $request->quantity]);

        }

//        dd($array);
        $order_details_stock = DB::table('order_details')
            ->join('articles','order_details.article_id','=','articles.id')
            ->select('order_details.*','articles.stock')
            ->where('order_id',$order_id)->get();

//        dd($order_details_stock);

        $array_stock = array();
        foreach ($order_details_stock as $item){

            $array_stock[] = DB::table('articles')
                                ->where('id',[$item->article_id])
                                ->update(['stock'=> $item->stock + $request->quantity]);

        }

//        dd($array_stock);

//        DB::table('color_articles')
//        ->where('article_id',$colors[0]->article_id)
//        ->where('color_id',$colors[0]->color_id)
//        ->update(['quantity' => $colors[0]->quantity + $request->quantity]);
//
//        $stock = DB::table('articles')
//            ->where('id',[$colors[0]->article_id])
//            ->select('stock')
//            ->first();
//
//        DB::table('articles')
//            ->where('id',[$colors[0]->article_id])
//            ->update(['stock'=> $stock->stock + $request->quantity]);
//
        $amount_bank_account = DB::connection('db1')->table('bank_accounts')
        ->join('bank_users','bank_accounts.bank_user_id','=','bank_users.id')
        ->where('first_name',$request->first_name)
        ->select('bank_accounts.amount')->first();
//
        DB::connection('db1')->table('bank_accounts')
        ->join('bank_users','bank_accounts.bank_user_id','=','bank_users.id')
        ->where('first_name',$request->first_name)
        ->update(['amount' => $amount_bank_account->amount + $request->monto_total_transaction]);
//
        DB::connection('mysql')->table('orders')
        ->where('orders.id',$order_id)
        ->update(['orders.active' => 0]);

        return redirect()->route('user_orders',['user_id' => Auth::user()->id]);
    }

    public function orderRestart($order_id)
    {
        DB::connection('mysql')->table('orders')
            ->where('orders.id',$order_id)
            ->update(['orders.active' => 1]);
        return redirect()->back();
    }

    public function formOrdenDetalleDeArticulo($article_id)
    {
        // $decrypt_article_id = Crypt::decrypt($article_id);
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

//        validation query for raiting and camentary article
        $orders_validation = DB::table('process_orders')
            ->join('status_orders','process_orders.id','=','status_orders.process_order_id')
            ->join('orders','status_orders.order_id','=','orders.id')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->join('articles','order_details.article_id','=','articles.id')
            ->where('articles.id',$article_id)
            ->where('process_orders.id',5)
            ->where('orders.user_id',Auth::user()->id)->first();
//        dd($orders_validation);
//        list raiting and commentary article
        $commentaries = DB::table('commentary_articles')->join('articles','commentary_articles.article_id','=','articles.id')
                        ->join('users','commentary_articles.user_id','=','users.id')
                        ->join('raiting_articles','articles.id','=','raiting_articles.article_id')
                        ->select('commentary_articles.comment','commentary_articles.id','raiting_articles.star_id','commentary_articles.created_at',DB::raw("CONCAT(users.last_name,' ',users.mother_last_name,' ',users.first_name) as full_name"))
                        ->where('articles.id',$article_id)
                        ->orderBy('commentary_articles.created_at','desc')->get();

        $raitings = DB::select(
            "select a.id as article_id, a.title as article ,s.id as estrella, s.star as nameRaiting , count(ra.star_id) as cantidadCliente
            from stars s inner join raiting_articles ra on s.id = ra.star_id
               inner join users c on ra.user_id = c.id
               -- inner join roles r on c.role_id = r.id
               inner join commentary_articles ca on c.id = ca.user_id
               inner join articles a on ra.article_id = a.id
               -- where c.role_id = 5
               where a.id = $article_id
               group by s.id, a.id,a.title, s.star
               order by s.star desc;

        ");
        $porcentajes = DB::select("
                select cantidad.article, sum(cantidad.cantidadCliente) as montoTotal
                 from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                      from stars s inner join raiting_articles ra on s.id = ra.star_id
                           inner join users c on ra.user_id = c.id
                           inner join commentary_articles ca on c.id = ca.user_id
                           inner join articles a on ra.article_id = a.id
                           where a.id = $article_id
                           group by s.id, a.title, s.star
                           order by s.star) as cantidad
                  group by cantidad.article;
        ");
        $maximoDeEstrella = DB::select("
                select cantidad.article, max(cantidad.cantidadCliente) as maximo
                 from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                      from stars s inner join raiting_articles ra on s.id = ra.star_id
                           inner join users c on ra.user_id = c.id
                           inner join commentary_articles ca on c.id = ca.user_id
                           inner join articles a on ra.article_id = a.id
                           where a.id = $article_id
                           group by s.id, a.title, s.star
                           order by s.star) as cantidad
                  group by cantidad.article;
        ");
        $agruparRaitingsIguales = DB::select(
            "select cantidad.article, cantidad.cantidadCliente as cantidadClientee
            from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                 from stars s inner join raiting_articles ra on s.id = ra.star_id
                      inner join users c on ra.user_id = c.id
                      inner join commentary_articles ca on c.id = ca.user_id
                      inner join articles a on ra.article_id = a.id
                      where a.id = $article_id
                      group by s.id, a.title, s.star
                      order by s.star) as cantidad
             group by cantidad.article,cantidad.cantidadCliente;

        ");
        return view('orders.formOrdenDetalleDeArticulo',compact('articles','cities','colors','prices','stocks','orders_validation','commentaries','raitings','porcentajes','maximoDeEstrella','agruparRaitingsIguales'));
    }


    public function orderInvoice($order_id){
        $orders = DB::select("
            select o.id as order_id ,tf.shiping  as shiping , c.id as city_id , u.id as user_id,
                   c.city as city , tf.price as price, o.total_amount as total_amount , o.location as location
            from users u inner join orders o on u.id = o.user_id
                 inner join transport_fares tf on o.transport_fares_id = tf.id
                 inner join cities c on tf.city_id = c.id
            where o.id = $order_id;
        ");

        $cities = City::all();
        $order_details = DB::select("
            select o.id as order_id , a.title as articulo , od.quantity as cantidad, od.color_article as color,
                   od.sub_total as subTotal, pa.price as precio , o.created_at as fecha,
                   a.description as description , od.id as id
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
        return view('invoice.invoice',compact('order_details','orders','cities','totalAmounts'));
    }

    public function orderInvoicePrint($order_id){
        $orders = DB::select("
            select o.id as order_id ,tf.shiping  as shiping , c.id as city_id , u.id as user_id,
                   c.city as city , tf.price as price, o.total_amount as total_amount , o.location as location
            from users u inner join orders o on u.id = o.user_id
                 inner join transport_fares tf on o.transport_fares_id = tf.id
                 inner join cities c on tf.city_id = c.id
            where o.id = $order_id;
        ");

        $cities = City::all();
        $order_details = DB::select("
            select o.id as order_id , a.title as articulo , od.quantity as cantidad, od.color_article as color,
                   od.sub_total as subTotal, pa.price as precio , o.created_at as fecha,
                   a.description as description , od.id as id
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
        return view('invoice.invoicePrint',compact('order_details','orders','cities','totalAmounts'));
    }
}
