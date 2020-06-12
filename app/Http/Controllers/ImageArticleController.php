<?php

namespace App\Http\Controllers;

use App\Article;
use App\ImageArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->authorizeRole(['administrador'])) {

            $articles= Article::all();

            $image_articles = DB::select(
                "select ai.id,ai.is_main, a.title as article, ai.url_image
                from articles a inner join image_articles ai
                on a.id = ai.article_id
                -- where a.id = 1
                order by a.title;
            ");
            //        dd($articles);
           return view('articles_images.index', compact('articles','image_articles'));
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
        $image_articles = new ImageArticle();
        $image_articles->article_id = $request->article_id;
        if ($request->hasFile('url_image')) {
            $file = $request->file("url_image");
            $fileName = $file->getFilename();
            $file->move(public_path("imagenes/imagenes_articulos/", $fileName));
            $image_articles->url_image = $fileName;
        }
        $image_articles->is_main = 0;
        $image_articles->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageArticle  $imageArticle
     * @return \Illuminate\Http\Response
     */
    public function show(ImageArticle $imageArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageArticle  $imageArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageArticle $imageArticle)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageArticle  $imageArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageArticle $imageArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageArticle  $imageArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageArticle $imageArticle)
    {
        //
    }
}
