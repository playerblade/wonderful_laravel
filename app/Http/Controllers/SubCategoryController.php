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
       $categories = Category::select('*')->orderBy('categories.category','asc')->get();
       $sub_categories = DB::table('sub_categories')
                         ->join('categories','sub_categories.category_id','=','categories.id')
                         ->select('sub_categories.*','categories.category')
                         ->orderBy('sub_categories.id','desc')->get();

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
            'sub_category' => 'required|string|max:250|unique:sub_categories'
        ]);

        $sub_category = new SubCategory();
        $sub_category->category_id = $request->category_id;
        $sub_category->sub_category = ucfirst($request->sub_category);
        $sub_category->save();

        return redirect()->route('sub_categories.index')->with('success','Product created successfully.');
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
        $categories = Category::select('*')->orderBy('categories.category','asc')->get();

        $sub_categories = DB::select("
           select sc.id as id , c.category as category , sc.sub_category as sub_category ,sc.created_at
           from categories c inner join sub_categories sc on c.id = sc.category_id
           order by sc.id desc;
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
        $subCategory->delete();
        return back();
    }
}
