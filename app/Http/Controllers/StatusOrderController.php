<?php

namespace App\Http\Controllers;

use App\StatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusOrderController extends Controller
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
     * @param  \App\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function show(StatusOrder $statusOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusOrder $statusOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusOrder $statusOrder)
    {
        $statusOrder->order_id = $request->order_id;
        $statusOrder->process_order_id = $request->process_order_id;
        $statusOrder->update();

        return redirect()->route('statusOrder');
//        return response()->json($statusOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusOrder $statusOrder)
    {
        //
    }

    public function ordersInitial()
    {
        $order_details = DB::select("
            select a.id as article_id, o.id as order_id ,
                   u.id as user_id , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as cliente,
                   a.title as articulo , pa.price as precio , od.quantity as cantidad ,
                   od.sub_total as subTotal, avg(od.sub_total) as montoTotal,
                   o.created_at as fecha , po.id as porcess_order_id
            from users u inner join orders o on u.id = o.user_id
                  inner join status_orders so on so.order_id = o.id
                  inner join process_orders po on so.process_order_id = po.id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
            and pa.is_current = 1
            and po.id = 1
            group by a.id, o.id, u.id, concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name), a.title, pa.price, od.quantity, od.sub_total, o.created_at , porcess_order_id
            order by fecha desc;
        ");

        return view('statusOrders.orderDetail',compact('order_details'));
    }

    public function ordersProcess()
    {
        $order_details = DB::select("
            select a.id as article_id, o.id as order_id ,
                   u.id as user_id , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as cliente,
                   a.title as articulo , pa.price as precio , od.quantity as cantidad ,
                   od.sub_total as subTotal, po.process_order as process_order,
                   o.created_at as fecha , po.id as porcess_order_id
            from users u inner join orders o on u.id = o.user_id
                  inner join status_orders so on so.order_id = o.id
                  inner join process_orders po on so.process_order_id = po.id
                  inner join order_details od on o.id = od.order_id
                  inner join articles a on od.article_id = a.id
                  inner join price_articles pa on a.id = pa.article_id
            and pa.is_current = 1
            and po.id = 2
            group by a.id, o.id, u.id, concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name), a.title, pa.price, od.quantity, od.sub_total, o.created_at , porcess_order_id,process_order
            order by fecha desc;
        ");

        return view('statusOrders.orderProcess',compact('order_details'));
    }
}
