<?php

namespace App\Http\Controllers;

use App\Article;
use App\Charts\BarChart;
use App\City;
use App\Client;
use App\CommentaryArticle;
use App\RaitingArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaitingArticleController extends Controller
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
     * @param  \App\RaitingArticle  $raitingArticle
     * @return \Illuminate\Http\Response
     */
    public function show(RaitingArticle $raitingArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RaitingArticle  $raitingArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(RaitingArticle $raitingArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RaitingArticle  $raitingArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaitingArticle $raitingArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RaitingArticle  $raitingArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaitingArticle $raitingArticle)
    {
        //
    }

    public function raitingsYComentariosArticulos(Article $articles , Request $request){
        if ($request->user()->authorizeRole(['administrador'])) {
            $articles = DB::select("select * from articles");

            return view('articles.raitingsYComentariosArticulos',compact('articles'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }

    public function raitingsArticulos($article_id , Article $articles , Request $request){
        if ($request->user()->authorizeRole(['administrador'])) {

            $raitings = DB::select(
                "
                select a.id as article_id, a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                from stars s inner join raiting_articles ra on s.id = ra.star_id
                   inner join clients c on ra.client_id = c.id
                   inner join commentary_articles ca on c.id = ca.client_id
                   inner join articles a on ra.article_id = a.id
                   where a.id = 1
                   group by s.id
                   order by s.star;"
            );

            $porcentajes = DB::select(
                "
                    select cantidad.article, sum(cantidad.cantidadCliente) as montoTotal
                     from (select a.title as article ,s.id as estrella, s.star as raiting , count(ra.star_id) as cantidadCliente
                          from stars s inner join raiting_articles ra on s.id = ra.star_id
                               inner join clients c on ra.client_id = c.id
                               inner join commentary_articles ca on c.id = ca.client_id
                               inner join articles a on ra.article_id = a.id
                               where a.id = 1
                               group by s.id
                               order by s.star) as cantidad
                      group by cantidad.article;
                "
            );

            return view('articles.raitingsArticulos',compact('raitings','porcentajes'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }
    }

    public function comentariosArticulos($article_id , $raiting, CommentaryArticle $comentarios , Request $request){
        if ($request->user()->authorizeRole(['administrador'])) {


            $comentarios = DB::select(
                "
                select a.title as article ,s.id as estrella, s.id as raiting , ca.created_at as fecha,
                       ca.comment as cometario, concat_ws(' ',c.last_name,c.mother_last_name,c.first_name,c.second_name) as cliente,
                       ia.url_image as imagen, a.description as description
                  from stars s inner join raiting_articles ra on s.id = ra.star_id
                       inner join clients c on ra.client_id = c.id
                       inner join commentary_articles ca on c.id = ca.client_id
                       inner join articles a on ra.article_id = a.id
                       inner join image_articles ia on a.id = ia.article_id
                       where a.id = $article_id
                       and  s.id = $raiting
                       group by a.title, s.id, s.id, ca.created_at, ca.comment, cliente, ia.url_image, a.description
                       order by ca.created_at  desc;
            "
            );
//            dd($comentarios);
            return view('articles.comentariosArticulos',compact('comentarios'));
        } else {
            abort(403, 'you do not authorized for this web site');
        }

    }
}
