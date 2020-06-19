<?php

namespace App\Http\Controllers;

use App\Article;
use App\ColorArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorArticleController extends Controller
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
        $request->validate([
            'article_id' => 'required',
            'color_id' => 'required'
        ]);
        $color_article = new ColorArticle();
        $color_article->article_id = $request->article_id;
        $color_article->color_id = $request->color_id;
        $color_article->quantity = $request->quantity;
        $color_article->save();

//        $query_article = DB::select("select a.stock as stock from articles a where a.id = $request->article_id;");

        $query_article = DB::table('articles')
                         ->where('id',$request->article_id)
                         ->select('stock')->first();

//        dd($query_article->stock);

        $article = Article::find($request->article_id);
        $article->stock = $query_article->stock + $request->quantity;
        $article->update();

        return redirect()->route('colors.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ColorArticle  $colorArticle
     * @return \Illuminate\Http\Response
     */
    public function show(ColorArticle $colorArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ColorArticle  $colorArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(ColorArticle $colorArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ColorArticle  $colorArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColorArticle $colorArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ColorArticle  $colorArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColorArticle $colorArticle)
    {
        //
    }
}
