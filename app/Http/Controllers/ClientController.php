<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ClientController extends controller
{

    
    use AuthenticatesUsers;

    // protected $loginView = 'clients.view';
    protected $guard = 'clients';

    // function __construct()
    // { 
    //     $this->middleware('auth:clients', ['only' => ['secret']]);
    // }


    /**
     * display a listing of the resource.
     *
     * @return \illuminate\http\response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * display the specified resource.
     *
     * @param  \app\client  $client
     * @return \illuminate\http\response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * show the form for editing the specified resource.
     *
     * @param  \app\client  $client
     * @return \illuminate\http\response
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * update the specified resource in storage.
     *
     * @param  \illuminate\http\request  $request
     * @param  \app\client  $client
     * @return \illuminate\http\response
     */
    public function update(request $request, client $client)
    {
        //
    }

    /**
     * remove the specified resource from storage.
     *
     * @param  \app\client  $client
     * @return \illuminate\http\response
     */
    public function destroy(client $client)
    {
        //
    }

    public function cantidaddeproductosporcliente_2( request $request, client $clients)
    {
        if ($request->user()->authorizerole(['administrador'])) {
            $clients = db::select(
                "select concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name) as cliente,
                 count(do.id) as cantidadproducto, year(o.created_at) as anio
            from categories d join sub_categories sd on d.id = sd.category_id
                 join articles a on sd.id = a.sub_category_id
                 join order_details do on a.id = do.article_id
                 join orders o on do.order_id = o.id
                 join status_orders eo on o.id = eo.order_id
                 join process_orders po on eo.process_order_id = po.id
                 join price_articles pa on a.id = pa.article_id
                 join clients c on o.client_id = c.id
            -- where eo.id = 5
            -- and year(o.created_at) = 2014
            group by anio, cliente
            order by cantidadproducto desc;"
            );
//        dd($clients);
            return view('clients.cantidaddeproductosporcliente_2',compact('clients'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }
}
