<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = Category::all();
       $sub_categories = DB::select("
           select sc.id as id , c.category as category , sc.sub_category as sub_category
           from categories c inner join sub_categories sc on c.id = sc.category_id;
       ");
       return view('subCategories.crud.index',compact('sub_categories','categories'));
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
            'category_id' => 'required',
            'sub_category' => 'required'
        ]);
        SubCategory::create($request->all());

        return redirect()->route('sub_categories.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = DB::select("
           select c.id as id , c.category as category
           from categories c inner join sub_categories sc on c.id = sc.category_id
           where sc.id = $subCategory->id;
        ");
        $sub_categories = DB::select("
           select sc.id as id , c.category as category , sc.sub_category as sub_category
           from categories c inner join sub_categories sc on c.id = sc.category_id;
       ");
        return view('subCategories.crud.edit',compact('subCategory','sub_categories','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'sub_category' => 'required|string|max:250|unique:sub_category'
        ]);

        $subCategory->update($request->all());
        return redirect()->route('sub_categories.index')->with('success','Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
