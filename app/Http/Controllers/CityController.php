<?php

namespace App\Http\Controllers;

use App\Charts\BarChart;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
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
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
    public function promedioVentasPorCiudades(Request $request , City $cities){
        if ($request->user()->hasRole('administrador')) {
            $cities  = DB::select(
                "
                select c.city as ciudad, count(do.article_id) as cantidad, avg(do.sub_total) as totalVenta
                FROM cities c INNER JOIN transport_fares t
                    ON c.id = t.city_id
                    INNER JOIN orders o
                    ON t.id = o.transport_fares_id
                    INNER JOIN status_orders eo
                    ON o.id = eo.order_id
                    INNER JOIN order_details do
                    ON o.id = do.order_id
                    join articles a on do.article_id = a.id
                    join process_orders po on eo.process_order_id = po.id
                where po.id = 4
                GROUP BY ciudad
                order by totalVenta desc;
            "
            );

            $barchart = new BarChart();

            foreach ($cities as $city){
                $barchart->dataset(
                    $city->ciudad,'bar',[$city->totalVenta ]
                );
//            $barchart->
            }

            return view('cities.promedioVentasPorCiudades',compact('barchart'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }
}
