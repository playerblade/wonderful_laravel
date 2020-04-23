<?php

namespace App\Http\Controllers;

use App\makers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->authorizeRole(['administrador'])) {
            
            // $makers= makers::all();

            $makers = DB::select(
                "select id, name as makerss, location, phone_number
                from makers
                -- where a.id = 1
                order by makerss;
            ");
            //        dd($articles);
           return view('makers.index', compact('makers'));
           
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\makers  $makers
     * @return \Illuminate\Http\Response
     */
    public function show(makers $makers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\makers  $makers
     * @return \Illuminate\Http\Response
     */
    public function edit(makers $makers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\makers  $makers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, makers $makers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\makers  $makers
     * @return \Illuminate\Http\Response
     */
    public function destroy(makers $makers)
    {
        //
    }
}
