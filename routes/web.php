<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',
    'WelcomeController@welcome'
);
Route::get('/article/{id}/detail',
    'WelcomeController@articleDetail'
);

Route::group(['middleware' => 'web','auth'], function () {

    // Route::get('/home', 'HomeController@index')->name('home')->middleware('password.confirm');
    Route::get('/home', 'HomeController@index')->name('home');

    // Route::auth();
    Auth::routes();

    //login Client
    Route::get('/clients/login', 'ClientController@showLoginForm');
    Route::post('/login/clients', 'ClientController@login');

    //    consulta 1
    Route::get('/reportes/articulos' , 'ArticleController@articulosVendidosPorMes')->name('articulos');
    //    consulta 2
    Route::get('/reportes/clientes' , 'ClientController@cantidadDeProductosPorCliente_2')->name('clientes');
    //    consulta 3
    Route::get('/reportes/categorias', 'CategoryController@productosVendidosPorDepartamento')->name('categorias');
    //    consulta 4
    Route::get('/reportes/categories_promedio', 'CategoryController@promedioDeventasPorDepartamento')->name('categories_promedio');

    //    consulta 4 barChart
    Route::get('/reportes/categories_promedio_chart', 'CategoryController@promedioDeventasPorDepartamentoBarChart')->name('categories_promedio_torta');
    //    consulta 5
    Route::get('/reportes/ventas_ciudades', 'CityController@promedioVentasPorCiudades')->name('ventas_ciudades');

    //    consulta 6
    Route::get('/reportes/ventas/{city_id}/articulos_promedio_ventas_ciudades', 'ArticleController@promedioDeProductosMasVendidosPorCiudades')->name('articulos_promedio_ventas_ciudades');

    //    consulta 7
    Route::get('/reportes/colaboradores/ordenes_despachados', 'UserStatusOrderController@listaDeColaboradoresYLaCantidadeDeOrdenesDespachados')->name('ordenes_despachados');

    //    consulta 8
    Route::get('/reportes/usuarios_verificadores' , 'UserStatusOrderController@listaDeVerificadoresYSuCantidadDeOrdenEntregado')->name('usuarios_verificadores');

    //    consulta 9
    Route::get('/reportes/raitings/raiting_comentarios_articulos', 'RaitingArticleController@raitingsYComentariosArticulos')->name('raiting_comentarios_articulos');
    //          consulta 9.1 comentarios seung el raiting (segun las evaluaciones de acuerdo a las estrellas)
    Route::get('/reportes/articulo/{article_id}/raitings', 'RaitingArticleController@raitingsArticulos')->name('raitings');
    Route::get('/reportes/articulo/raiting/{raiting}/{article_id}/comentarios', 'RaitingArticleController@comentariosArticulos')->name('comentarios');

    //    consulta 10
    //    1 pantalla
    Route::get('/reportes/detalle_ordenes_por_cliente' , 'OrderDetailController@detalleDeOrdenesPorCliente')->name('clientes')->middleware('password.confirm');
    //      2 pantalla ordenes
    Route::get('/reportes/cliente/{client_id}/ordenes' , 'OrderDetailController@listaDeOrdenesPorCliente')->name('ordenes');
    //      3 pantalla detalle ordenes
    Route::get('/reportes/cliente/orden/{order_id}/detalle_orden' , 'OrderDetailController@detallesDeLasOrdnesDelCliente')->name('detalle_orden');
    //      4 pantalla detalle del articulo
    Route::get('/reportes/cliente/orden/detalle_orden/{article_id}/articulo' , 'OrderDetailController@detalleDelArticulo')->name('articulo');

    // CRUD DE ARTICULOS
    Route::resource('articles','ArticleController');
    Route::resource('image_articles','ImageArticleController');
    Route::resource('makers','MakersController');
    Route::resource('articles',
        'ArticleController'
    );
    // CRUD DE ARTICULOS
    Route::resource('categories',
        'CategoryController'
    );
    Route::resource('sub_categories',
        'SubCategoryController'
    );
    Route::resource('colors',
        'ColorController'
    );
    Route::resource('colo_articles',
        'ColorArticleController'
    );
    Route::get('/get_sub_categories',
        'ArticleController@getSubCategories'
    );

    Route::get('/order/{article_id}/form',
        'OrderController@formOrder'
    );
    Route::resource('orders',
        'OrderController'
    );

    Route::get('/get_transport_fares',
        'OrderController@getTransportFares'
    );

    Route::get('/orders_initial',
        'OrderController@ordersInitial'
    );
});
