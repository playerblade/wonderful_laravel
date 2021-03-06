<?php

namespace App\Http\Controllers;

use App\UserStatusOrder;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserStatusOrderController extends Controller
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
     * @param  \App\UserStatusOrder  $userStatusOrder
     * @return \Illuminate\Http\Response
     */
    public function show(UserStatusOrder $userStatusOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserStatusOrder  $userStatusOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(UserStatusOrder $userStatusOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserStatusOrder  $userStatusOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserStatusOrder $userStatusOrder)
    {
        // $userStatusOrder->

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserStatusOrder  $userStatusOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserStatusOrder $userStatusOrder)
    {
        //
    }

//    consulta 7
    public function listaDeColaboradoresYLaCantidadeDeOrdenesDespachados(User $users , Request $request){
        if ($request->user()->hasRole('administrador')) {
            $users = DB::select(
                "
                select concat_ws(' ' ,u.last_name,u.mother_last_name,u.first_name,u.second_name) as colaborador , count(so.order_id) as cantidadDespachado
                from roles r join users u on u.role_id = r.id
                    and r.role = 'colaborador'
                    -- and r.id = 2
                    join user_status_orders uso on u.id = uso.user_id
                    join status_orders so on uso.status_order_id = so.id
                    join process_orders po on so.process_order_id = po.id
                    and po.process_order = 'dispatched'
                    -- and po.id = 3
                    join orders o on so.order_id = o.id
                group by u.id,u.last_name,u.mother_last_name,u.first_name,u.second_name;
            "
            );

            return view('users.listaDeColaboradoresYLaCantidadeDeOrdenesDespachados',compact('users'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }

    }

//consulta 8
    public function listaDeVerificadoresYSuCantidadDeOrdenEntregado( Request $request, User $users)
    {
        if ($request->user()->hasRole('administrador')) {
            $users = DB::select(
                "select concat_ws(' ' ,u.last_name,u.mother_last_name,u.first_name,u.second_name) as verificadores , count(so.order_id) as cantidadEntregado
                from roles r join users u on u.role_id = r.id
                    and r.role = 'verificador'
                    -- and r.id = 2
                    join user_status_orders uso on u.id = uso.user_id
                    join status_orders so on uso.status_order_id = so.id
                    join process_orders po on so.process_order_id = po.id
                    and po.process_order = 'delivered'
                    -- and po.id = 3
                    join orders o on so.order_id = o.id
                group by u.id,u.last_name,u.mother_last_name,u.first_name,u.second_name;
            ");
            //    dd($users);
            return view('users.listaDeVerificadoresYSuCantidadDeOrdenEntregado',compact('users'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }

    }
}
