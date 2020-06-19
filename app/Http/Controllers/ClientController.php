<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends controller
{
    /**
     * display a listing of the resource.
     *
     * @return \illuminate\http\response
     */
    public function index()
    {
        $users = DB::select("CALL get_clients();");

        $roles = DB::select("CALL get_roles();");

        return view('clients.crud.index',compact('users','roles'));
    }

    /**
     * show the form for creating a new resource.
     *
     * @return \illuminate\http\response
     */
    public function create()
    {
        //
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  \illuminate\http\request  $request
     * @return \illuminate\http\response
     */
    public function store(request $request)
    {
        DB::insert("CALL insert_users_with_roles(
            5,'$request->ci','$request->first_name',
           '$request->second_name','$request->last_name','$request->mother_last_name',
           '$request->gender',$request->phone_number,'$request->birthday','$request->user',
           '$request->password',1);
        ");

        return redirect()->route('clients.index') ->with('success','client saved');
    }

    /**
     * display the specified resource.
     *
     * @param  \app\User  $user
     * @return \illuminate\http\response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * show the form for editing the specified resource.
     *
     * @param  \app\User  $user
     * @return \illuminate\http\response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * update the specified resource in storage.
     *
     * @param  \illuminate\http\request  $request
     * @param  \app\User  $user
     * @return \illuminate\http\response
     */
    public function update(request $request, User $user)
    {
//        dd($request->all());
        $user->update($request->all());
        return redirect()->route('clients.index')->with('success','client updated successfully');
    }

    /**
     * remove the specified resource from storage.
     *
     * @param  \app\user  $user
     * @return \illuminate\http\response
     */
    public function destroy(User $user)
    {
//        $user_status_orders = DB::table('user_status_orders')
//            ->where('user_id',$user->id)->get();
//        if (empty($user_status_orders[0])){
            $user->delete();
            return redirect()->route('clients.index') ->with('success','use deleted');
//        }else{
//            return redirect()->route('users.index') ->with('error','not deleted, User working in Order!!');
//        }
    }

    public function cantidaddeproductosporcliente_2( request $request)
    {
        if ($request->user()->hasRole('administrador')) {
            $clients = db::select(
                "select concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name) as cliente,
                 count(do.id) as cantidadProducto, year(o.created_at) as anio
            from categories d join sub_categories sd on d.id = sd.category_id
                 join articles a on sd.id = a.sub_category_id
                 join order_details do on a.id = do.article_id
                 join orders o on do.order_id = o.id
                 join status_orders eo on o.id = eo.order_id
                 join process_orders po on eo.process_order_id = po.id
                 join price_articles pa on a.id = pa.article_id
                 join users c on o.user_id = c.id
            group by anio, cliente
            order by cantidadproducto desc;"
            );
//        dd($clients);
            $years = DB::select("
                select year(orders.created_at) as anio
                from orders
                group by year(orders.created_at);
            ");

            return view('clients.cantidadDeProductosPorCliente_2',compact('clients','years'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }

    public function cantidadDeProductosPorCliente_2a( $anio , Request $request)
    {
        if ($request->user()->hasRole('administrador')) {
            $clients = db::select(
                "select concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name) as cliente,
                 count(do.id) as cantidadProducto, year(o.created_at) as anio
            from categories d join sub_categories sd on d.id = sd.category_id
                 join articles a on sd.id = a.sub_category_id
                 join order_details do on a.id = do.article_id
                 join orders o on do.order_id = o.id
                 join status_orders eo on o.id = eo.order_id
                 join process_orders po on eo.process_order_id = po.id
                 join price_articles pa on a.id = pa.article_id
                 join users c on o.user_id = c.id
            where year(o.created_at) = $anio
            group by anio, cliente
            order by cantidadproducto desc;"
            );
//        dd($clients);
            $years = DB::select("
                select year(orders.created_at) as anio
                from orders
                group by year(orders.created_at);
            ");

            return view('clients.cantidadDeProductosPorCliente_2a',compact('clients','years'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }
}
