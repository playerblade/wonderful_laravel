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
        //
        $article= new ImageArticle();
        $article->article_id = $request->article_id;
        $article->url_image = $request->url_image;
        $article->is_main = 1;
        
        // if ($request->user()->authorizeRole(['administrador'])) { 
        //     $request->validate([
        //     ]);
            
        //     ImageArticle::create($request->all());

        //     return redirect()->route('articles_images.index')
        //     ->with('success','Product created successfully.');

        // } else {
        //     abort(403, 'you do not authorized for this web site');
        // }

        

        if($request->hasFile('url_image')){
            /*si la imagen que subes es distinta a la que está por defecto
            entonces eliminaría la imagen anterior, eso es para evitar
            acumular imagenes en el servidor*/
          if($article->url_image != '1.jpg'){
            Storage::delete('public/imagenesimagenes_articulos/'.$article->url_image);
          }


            //Get filename with the extension
          $filenamewithExt = $request->file('url_image')->getClientOriginalName();

          //Get just filename
          $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);

          //Get just ext
          $extension = $request->file('url_image')->guessClientExtension();

          //FileName to store
          $fileNameToStore = time().'.'.$extension;

          //Upload Image
          $path = $request->file('url_image')->storeAs('public/imagenesimagenes_articulos/',$fileNameToStore);



        } else {

            $fileNameToStore = $article->url_image;
            
            // $fileNameToStore="1.jpg";
        }

         $article->url_image=$fileNameToStore;
        //  dd($article->url_image=$fileNameToStore);
        //  $article->is_main = 1;
        $article->save();
        return Redirect::to("image_articles");
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
