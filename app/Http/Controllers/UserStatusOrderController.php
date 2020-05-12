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
        if ($request->user()->authorizeRole(['administrador'])) {
            $users = DB::select(
                "
                select concat_ws(' ' ,u.last_name,u.mother_last_name,u.first_name,u.second_name) as colaborador , count(so.order_id) as cantidadDespachado
                from roles r join role_user ru on r.id = ru.role_id
                    join users u on ru.user_id = u.id
                    -- and r.role = 'colaborador'
                    and r.id = 2
                    join user_status_orders uso on u.id = uso.user_id
                    join status_orders so on uso.status_order_id = so.id
                    join process_orders po on so.process_order_id = po.id
                    -- and po.process_order = 'dispatched'
                    and po.id = 3
                    join orders o on so.order_id = o.id
                group by u.id;
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
        if ($request->user()->authorizeRole(['administrador'])) {
            $users = DB::select(
                "select concat_ws(' ',u.last_name,u.mother_last_name,u.first_name,u.second_name) as verificadores,
            COUNT(o.id) as cantidadEntregado
            FROM roles r INNER JOIN role_user ru
            ON r.id = ru.role_id
            INNER JOIN users u
            ON ru.user_id = u.id
            AND r.role = 'verificador'
            INNER JOIN user_status_orders ue
            ON u.id = ue.user_id
            INNER JOIN status_orders eo
            ON ue.status_order_id = eo.id
            INNER JOIN process_orders p
            ON eo.process_order_id = p.id
            AND p.process_order = 'delivered'
            INNER JOIN orders o
            on eo.order_id = o.id
            GROUP BY verificadores;"
            );
            //    dd($users);
            return view('users.listaDeVerificadoresYSuCantidadDeOrdenEntregado',compact('users'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }

    }
}
