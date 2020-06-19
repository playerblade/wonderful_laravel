<?php

namespace App\Http\Controllers;

use App\Category;
use App\Charts\BarChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        aniadir atorizacion para administradores
        $categories = Category::all()->sortDesc();
        return view('categories.crud.index',compact('categories'));
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
        $request->validate([
            'category' => 'required|string|min:1|max:250|unique:categories'
        ]);
            $category = new Category();
            $category->category = ucwords($request->category);
//            $category->created_at = date_default_timezone_set('Europe/London');
            $category->save();

        return redirect()->route('categories.index')->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories_edit = Category::all();
        return view('categories.crud.edit',compact('category','categories_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category' => 'required'
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }

//dev sara
    public function productosVendidosPorDepartamento(Request $request, Category $categories){
//        departamento = category
        if ( $request->user()->hasRole('administrador')){

            $categories = DB::select(
                "
                    select c.category as departamentos,  count(eo.process_order_id) as cantidadVentas
                    from categories c join sub_categories sc on c.id = sc.category_id
                         join articles a on sc.id = a.sub_category_id
                         join order_details od on a.id = od.article_id
                         join orders o on od.order_id = o.id
                         join status_orders eo on o.id = eo.order_id
                         join process_orders po on eo.process_order_id = po.id
                    WHERE eo.process_order_id = 4
                    group by departamentos
                    order by cantidadVentas desc;
                "
            );
            return view('categories.productosVendidosPorDepartamento',compact('categories'));
        }else{
            return abort(400,'not authorized');
        }
    }

    public function productosVendidosPorDepartamento_a(Request $request){
//        departamento = category
        if ( $request->user()->hasRole('administrador')){

            $categories = DB::select(
                "
                    select c.category as departamentos,  count(eo.process_order_id) as cantidadVentas
                    from categories c join sub_categories sc on c.id = sc.category_id
                         join articles a on sc.id = a.sub_category_id
                         join order_details od on a.id = od.article_id
                         join orders o on od.order_id = o.id
                         join status_orders eo on o.id = eo.order_id
                         join process_orders po on eo.process_order_id = po.id
                    WHERE eo.process_order_id = 4
                    and o.created_at between '$request->date_1' and '$request->date_2'
                    group by departamentos
                    order by cantidadVentas desc;
                "
            );
            return view('categories.productosVendidosPorDepartamento_a',compact('categories'));
        }else{
            return abort(400,'not authorized');
        }
    }

//    dev sara
    public function promedioDeventasPorDepartamento(Request $request, Category $categorias){
//        departamento = category
        if ($request->user()->hasRole('administrador')) {
            $categorias = DB::select(
                "
                select c.category as departamento, a.title as producto, count(od.article_id) as cantidad, avg(od.sub_total) as totalVenta
                from categories c join sub_categories sc on c.id = sc.category_id
                     join articles a on sc.id = a.sub_category_id
                     join order_details od on a.id = od.article_id
                     join orders o on od.order_id = o.id
                     join status_orders so on o.id = so.order_id
                     join process_orders po on so.process_order_id = po.id
                where so.process_order_id = 4
                -- and c.id = 3
                group by departamento,producto
                order by cantidad desc;
            "
            );

            $all_categories = Category::select('categories.*')->orderBy('category','asc')->get();

            return view('categories.promedioDeventasPorDepartamento',compact('categorias','all_categories'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }


//    dev sara
    public function promedioDeventasPorDepartamento_a(Request $request, $category_id){
//        departamento = category
        if ($request->user()->hasRole('administrador')) {
            $categorias = DB::select(
                "
                select c.category as departamento, a.title as producto, count(od.article_id) as cantidad, avg(od.sub_total) as totalVenta
                from categories c join sub_categories sc on c.id = sc.category_id
                     join articles a on sc.id = a.sub_category_id
                     join order_details od on a.id = od.article_id
                     join orders o on od.order_id = o.id
                     join status_orders so on o.id = so.order_id
                     join process_orders po on so.process_order_id = po.id
                where so.process_order_id = 4
                and c.id = $category_id
                group by departamento,producto
                order by cantidad desc;
            "
            );

            $all_categories = Category::select('categories.*')->orderBy('category','asc')->get();

            return view('categories.promedioDeventasPorDepartamento_a',compact('categorias','all_categories'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }

    function promedioDeventasPorDepartamentoBarChart(Request $request, Category $categories_promedios){
        if ($request->user()->hasRole('administrador')) {
            $categories_promedios = DB::select(
                "
                select c.category as departamento, count(od.article_id) as cantidad, avg(od.sub_total) as totalVenta
                from categories c join sub_categories sc on c.id = sc.category_id
                     join articles a on sc.id = a.sub_category_id
                     join order_details od on a.id = od.article_id
                     join orders o on od.order_id = o.id
                     join status_orders so on o.id = so.order_id
                     join process_orders po on so.process_order_id = po.id
                where so.process_order_id = 4
                -- and c.id = 3
                -- group by a.id
                group by departamento
                order by totalVenta desc;
            "
            );
//        dd($categories_promedios);
//        pie chart
            $chart = new BarChart();
            foreach ($categories_promedios as $categories_promedio){
                $chart->dataset($categories_promedio->departamento,'bar',[
                    $categories_promedio->totalVenta
                ]);
            }
//        $chart->minimalist(false);
//        $chart->
            return view('categories.promedioDeventasPorDepartamentoBarChart',compact('chart'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }
}
