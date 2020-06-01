<?php

namespace App\Http\Controllers;

use App\StatusOrder;
use App\UserStatusOrder;
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
        DB::beginTransaction();
        try {
            $statusOrder->order_id = $request->order_id;
            $statusOrder->process_order_id = $request->process_order_id;
            $statusOrder->update();

            DB::table('user_status_orders')
            ->join('status_orders','user_status_orders.status_order_id','=','status_orders.id')
            ->where('status_order_id',$statusOrder->id)
            ->update(['user_id' => $request->user_id]);
//              step 2  if all good commit
            DB::commit();
        } catch (\Exception $exception) {
//               step 3 if some error rollback
            DB::rollBack();
        }
        return redirect()->route('home');
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
        $order_initial = DB::select("
            select o.id as order_id ,
              po.process_order as estado,
              o.created_at as fechaOrden , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as usuario,
              r.id as role_id, o.active as active
            from roles r inner join users u on r.id = u.role_id
                inner join user_status_orders uso on u.id = uso.user_id
                inner join status_orders so on uso.status_order_id = so.id
                inner join process_orders po on so.process_order_id = po.id
                inner join orders o on so.order_id = o.id
                inner join users c on o.user_id = c.id
            and po.id = 1
            order by o.created_at desc;
        ");

        return view('statusOrders.orderInitial',compact('order_initial'));
    }

    public function ordersProcess()
    {
        $order_process = DB::select("
                    select o.id as order_id ,
                      po.process_order as estado,
                      o.created_at as fechaOrden , concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as usuario,
                      r.id as role_id, o.active as active
                    from roles r inner join users u on r.id = u.role_id
		                inner join user_status_orders uso on u.id = uso.user_id
                        inner join status_orders so on uso.status_order_id = so.id
                        inner join process_orders po on so.process_order_id = po.id
                        inner join orders o on so.order_id = o.id
                        inner join users c on o.user_id = c.id
                    and po.id = 2
                    order by o.created_at desc;
        ");

        return view('statusOrders.orderProcess',compact('order_process'));
    }

    public function ordersDispatched()
    {
        $order_dispatched = DB::select("
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
                    and po.id = 3
                    order by o.created_at desc;
        ");

        return view('statusOrders.ordersDispatched',compact('order_dispatched'));
    }

    public function ordersDelivered()
    {
        $order_delivered = DB::select("
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
                    and po.id = 4
                    order by o.created_at desc;
        ");

//        return response()->json($order_delivered);
        return view('statusOrders.ordersDelivered',compact('order_delivered'));
    }


}
