<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Charts\BarChart;
use App\Color;
use App\ColorArticle;
use App\PriceArticle;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->authorizeRole(['administrador'])) {
            $categories = Category::all();
            $sub_categories = SubCategory::all();
            $colors = Color::all();

            $articles = DB::select(
                "select sb.id ,  a.id as id , a.title as article , a.marker as marker , a.stock  as stock,
                        sb.sub_category as sub_category , c.category as category , a.description as description
                 from  articles a inner join sub_categories sb on a.sub_category_id  = sb.id
                 inner join categories c on sb.category_id  = c.id;
            ");
            //        dd($articles);
            return view('articles.crud.index', compact('articles','categories','sub_categories','colors'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
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
        // $articles = request()->all();

        // return response()->json($articles);

        // $articles = request()->except('_token');
        $request->except('_token');

        if ($request->user()->authorizeRole(['administrador'])) {

            $request->validate([
                'sub_category_id' => 'required',
                'title' => 'required|max:250|string|regex:/^.+@.+$/i',
                'marker' => 'required|max:250|string|regex:/^.+@.+$/i',
                'description' => 'required',
                'stock' => 'required|numeric',
                'color_id' => 'required|numeric',
                'price' => 'required|max:250|string|regex:/^.+@/i',
                'is_current' => 'required|boolean',
            ]);

            $article =  Article::create($request->all());
            // dd($article->id);

            // $color =  ColorArticle::create($request->all());
//            $color = new ColorArticle();

//            $color->article_id = $article->id;
//            $color->color_id = $request->input('color_id');
            // dd($color);
            $colorAssings = [];
            foreach ($request->input('color_id') as $color_id){
                $colorAssings[] = [
                    'article_id' => $article->id,
                    'color_id' => $color_id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ];
            }

            $price  = new PriceArticle();
            $price->article_id = $article->id;
            $price->price = $request->input('price');
            $price->is_current = $request->input('is_current');

            $article->save();
//            $color->save();
            ColorArticle::insert($colorAssings);
            $price->save();
            // dd($color);



            return redirect()->route('articles.index')
            ->with('success','Product created successfully.');

        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        //return view('articles.crud.index',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article , SubCategory $sub_categories)
    {
        $colors = DB::select("
            select c.name as name , c.id as id
            from colors c inner join color_articles co on c.id = co.color_id
                inner join articles a on co.article_id = a.id
            where a.id = $article->id
        ");

        $sub_categories = DB::select(
            "select sb.id as id , sb.sub_category as sub_category
             from  articles a inner join sub_categories sb on a.sub_category_id  = sb.id
             inner join categories c on sb.category_id  = c.id
             where a.id = $article->id ;
        ");
        $prices = DB::select("
            select pa.id as id,  pa.price as price
            from price_articles pa inner join articles a on pa.article_id = a.id
            where a.id = $article->id ;
        ");
        return view('articles.crud.edit',compact('article','sub_categories','colors','prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'sub_category_id' => 'required',
            'title' => 'required',
            'marker' => 'required',
            'description' => 'required',
            'stock' => 'required',
        ]);

        $article->update($request->all());
        return redirect()->route('articles.index')->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        $article->delete();
        return redirect()->route('articles.index')->with('success','Article deleted successfully');

    }
//    metodo ajax para para recibir las subcategorias de categorias
    public function getSubCategories(Request $request)
    {
        if ($request->ajax()){
            $sub_categories = SubCategory::where('category_id', $request->category_id)->get();

            foreach ($sub_categories as $sub_category) {
                $sub_categories_array[$sub_category->id] = $sub_category->sub_category;
            }
            return response()->json($sub_categories_array);
        }
    }

    public function articulosVendidosPorMes( Request $request, Article $articles)
    {
        if ($request->user()->authorizeRole(['administrador'])) {
            $articles = DB::select(
                "select a.title as producto , dt.quantity as cantidad,
                            CASE MONTH(o.created_at)
                                when 1 then 'Enero'
                                when 2 then 'Febrero'
                                when 3 then 'Marzo'
                                when 4 then 'Abril'
                                when 5 then 'Mayo'
                                when 6 then 'Junio'
                                when 7 then 'Julio'
                                when 8 then 'Agosto'
                                when 9 then 'Septiembre'
                                when 10 then 'Octubre'
                                when 11 then 'Noviembre'
                                when 12 then 'Diciembre'
                            END as mes
                        from order_details dt
                            inner join articles a on a.id = dt.article_id
                            inner join orders o on o.id = dt.order_id
                            inner join price_articles pa on pa.id = dt.price_article_id
                            inner join clients c on c.id = o.client_id
                            inner join status_orders so on so.order_id = o.id
                            inner join process_orders po on so.process_order_id = po.id
                        where po.id = 4
                        -- and MONTH(o.created_at) = 4
                        group by a.title , dt.quantity , mes
                        order by cantidad desc;"
            );
            //        dd($articles);
            return view('articles.articulosVendidosPorMes', compact('articles'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }

    public function promedioDeProductosMasVendidosPorCiudades($city_id, Article $articles , Request $request){

        if ($request->user()->authorizeRole(['administrador'])) {

            $cities = DB::table('cities')->select('*')->paginate(3);
            //        dd($cities);
            $articles = DB::select(
                "
                    select c.city as ciudad ,  a.title as producto , count(od.article_id) as cantidad , avg(od.sub_total) as totalVenta
                    from articles a join order_details od on a.id = od.article_id
                         join orders o on od.order_id = o.id
                         join transport_fares tf on o.transport_fares_id = tf.id
                         join cities c on tf.city_id = c.id
                         join status_orders so on o.id = so.order_id
                         join process_orders po on so.process_order_id = po.id
                    where po.id = 5
                    and c.id = $city_id
                    group by ciudad,producto
                    order by totalVenta desc;

                "
            );

            $barchart = new BarChart();

            foreach ($articles as $article) {
                $barchart->dataset(
                    $article->producto, 'bar', [$article->totalVenta]
                );
            }
            //        dd($articles);
            // return view('articles.promedioDeProductosMasVendidosPorCiudades',compact('barchart','articles','cities'));
            return view('articles.promedioDeProductosMasVendidosPorCiudades', compact('barchart', 'articles', 'cities'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }
}
