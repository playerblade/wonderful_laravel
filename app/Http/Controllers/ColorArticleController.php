<?php

namespace App\Http\Controllers;

use App\ColorArticle;
use Illuminate\Http\Request;

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
        ColorArticle::create($request->all());
        return redirect()->route('categories.index')
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
