<?php

namespace App\Http\Controllers;

use App\Article;
use App\Order;
use App\OrderDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return redirect()->back();
    }

    public function detalleDeOrdenesPorCliente(Request $request){
//        if ($request->user()->authorizeRole(['cliente','administrador'])) {
//            $users =  DB::table('users')->select('*')->get();
            $clients = DB::select("
                select c.id as id, c.phone_number as telefono,
                      CASE c.gender
                         when 'F' then 'Femenino'
                         when 'M' then 'Masculino'
                      END as genero,
                      concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name) as cliente,
                      c.user as user,
                      c.ci as ci,
                      CASE c.active
                         when 1 then 'activo'
                         when 0 then 'inactivo'
                      END as activo
                from roles r
                inner join users c on r.id = c.role_id
                and r.id = 5;
                "
            );
//            dd($users);
            return view('clients.detalleDeOrdenesPorCliente1Pantalla',compact('clients'));
//        } else {
//            abort(403, 'you do not authorized for this web site');
//        }
    }

    public function listaDeOrdenesPorCliente($client_id, Request $request, Order $orders){

            $orders = DB::select("
                	select o.id as order_id ,
                      CASE po.process_order
                         when 'initial' then 'inicial'
                         when 'process' then 'proceso'
                         when 'preparation' then 'preparacion'
                         when 'dispatched' then 'despachado'
                         when 'delivered' then 'entregado'
                      END as estado,
                      o.created_at as fechaOrden , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as usuario
                from roles r inner join users u on r.id = u.role_id

		        inner join user_status_orders uso on u.id = uso.user_id
                        inner join status_orders so on uso.status_order_id = so.id
                        inner join process_orders po on so.process_order_id = po.id
                        inner join orders o on so.order_id = o.id
		        inner join users c on o.user_id = c.id
                   and r.id = 2
                   -- and c.id = 5
                   and c.id = $client_id
                   order by o.created_at desc;
                   "
            );
//            dd($orders);
            return view('clients.listaDeOrdenesPorCliente2Pantalla',compact('orders'));

    }

    public function detallesDeLasOrdnesDelCliente($order_id, Request $request , OrderDetail $orderDetails){

            $orderDetails = DB::select("
                select a.id as article_id, o.id as order_id ,
                       c.id as client_id , concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name) as cliente,
                       od.id as id , a.title as articulo , pa.price as precio , od.quantity as cantidad ,
                       od.sub_total as subTotal, avg(od.sub_total) as montoTotal,
                       o.created_at as fecha
                from roles r inner join users c on r.id = c.role_id
                      inner join orders o on c.id = o.user_id
                      inner join order_details od on o.id = od.order_id
                      inner join articles a on od.article_id = a.id
                      inner join price_articles pa on a.id = pa.article_id
                and o.id = $order_id
                and r.role = 'cliente'
                and pa.is_current = 1
                -- group by c.id, od.id, a.title, pa.price
                group by a.id, o.id, c.id, concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name), od.id, a.title, pa.price, od.quantity, od.sub_total, o.created_at
                order by fecha desc;
                "
            );

            $totalAmounts = DB::select("
                select o.id as order_id, sum(od.sub_total) as montoTotal
                from users c inner join orders o on c.id = o.user_id
                      inner join order_details od on o.id = od.order_id
                      inner join articles a on od.article_id = a.id
                      inner join price_articles pa on a.id = pa.article_id
                      and o.id=$order_id
                      and pa.is_current = 1
                group by o.id , c.id;
            ");

//            dd($orderDetails);
            return view('clients.detallesDeLasOrdnesDelCliente3Pantalla',compact('orderDetails','totalAmounts'));
    }

    public function detalleDelArticulo($article_id ,  Request $request , Article $articles ){
            $articles = DB::select("
                select a.title as articulo , m.name as fabricante , a.stock as stock ,
                       c.image as color , a.description as descripcion,
                       c.name as nombreColor
                from articles a inner join image_articles ia on a.id = ia.article_id
                    inner join color_articles ca on a.id = ca.article_id
                    inner join makers m  on a.maker_id = m.id
                    inner join colors c on ca.color_id = c.id
                    inner join sub_categories sc on a.sub_category_id = sc.id
                    inner join categories cta on sc.category_id = cta.id
                    inner join price_articles pa on a.id = pa.article_id
                and a.id = $article_id
                group by a.title, m.name, a.stock, c.image, a.description, c.name;
                "
            );

//            dd($orderDetails);
            $prices_articles = DB::select("
                select pa.price as precio,
                       CASE pa.is_current
                            WHEN 1 THEN 'actual'
                            WHEN 0 THEN 'anterior'
                       END as estadoPrecios
                from articles a inner join price_articles pa on a.id = pa.article_id
                where a.id = $article_id;
            ");

            $images_articles = DB::select("
                select ia.url_image as imagen,
                       CASE ia.is_main
                            WHEN 1 THEN 'principal'
                            WHEN 0 THEN 'secundario'
                       END as estadoImagenes
                from articles a inner join image_articles ia on a.id = ia.article_id
                where a.id = $article_id;
            ");

            return view('clients.detalleDelArticulo4Pantalla',compact('articles', 'prices_articles','images_articles'));
    }

    public function allOrdersClient($user_id){
//        $orders = DB::select("
//                select o.id as order_id , o.active as active
//                from orders o
//                   where o.user_id = $user_id
//                   order by o.created_at desc;
//                   "
//        );

        $orders = DB::select("
                select o.id as order_id , o.active as active , po.process_order as process_order
                from orders o inner join status_orders so on o.id = so.order_id
                    inner join process_orders po on po.id = so.process_order_id
                   where o.user_id = $user_id
                   order by o.created_at desc;
                   "
        );
//            dd($orders);
        return view('orders.allOrderClient',compact('orders'));
    }
}
