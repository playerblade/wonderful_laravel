<?php

namespace App\Http\Controllers;

use App\Article;
use App\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::select('*')->orderBy('id','desc')->get();
        $articles = Article::all();
        return view('colors.crud.index',compact('colors','articles'));
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
        $color = new Color($request->all());
        $color->name = $request->name;

//        dd($request->hasFile('url_image'));

        if ($request->hasFile('image')){
            $file = $request->file("image");
//            $fileName = $file->getClientOriginalName();
            $fileName = $file->getFilename();
            $file->move(public_path("imagenes/imagenes_articulos/",$fileName));
            $color->image = $fileName;
        }
        $color->save();

        return redirect()->route('colors.index')->with("succes","la imagen se subio correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        $colors_edit = Color::all();
        return view('colors.crud.edit',compact('color','colors_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|string|max:12|min:2',
            'images' => 'required|image|mimes:jpg, png, bmp, jpeg'
        ]);

        $color->update($request->all());
        return redirect()->route('colors.index')->with('success','Color updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return back();
    }
}
