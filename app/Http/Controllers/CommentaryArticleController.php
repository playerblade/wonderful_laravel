<?php

namespace App\Http\Controllers;

use App\CommentaryArticle;
use App\RaitingArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentaryArticleController extends Controller
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

        $raitingArticles = new RaitingArticle();
        $raitingArticles->article_id = $request->article_id;
        $raitingArticles->user_id = Auth::user()->id;
        $raitingArticles->star_id = $request->star;
        $raitingArticles->save();

        // dd($request->estrellas);
        $comentario = new CommentaryArticle();
        $comentario->article_id = $request->article_id;
        $comentario->user_id = Auth::user()->id;
        $comentario->comment = $request->comment;
        $comentario->is_main = 1;
        $comentario->save();

        return back()->with('success','Comentario enviado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommentaryArticle  $commentaryArticle
     * @return \Illuminate\Http\Response
     */
    public function show(CommentaryArticle $commentaryArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommentaryArticle  $commentaryArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentaryArticle $commentaryArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommentaryArticle  $commentaryArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentaryArticle $commentaryArticle)
    {
        // dd($request->all());
        // $commentaryArticle->article_id = $request->article_id;
        // $commentaryArticle->user_id = $request->user_id;
        // $commentaryArticle->comment = $request->comment;
        // $commentaryArticle->is_main = 1;
        // $commentaryArticle->update();
        // dd($commentaryArticle->update());
        DB::table('commentary_articles')->where('article_id',$request->article_id)->where('user_id',$request->user_id)
            ->update(['comment' => $request->comment]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommentaryArticle  $commentaryArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentaryArticle $commentaryArticle)
    {
        //
    }


}
