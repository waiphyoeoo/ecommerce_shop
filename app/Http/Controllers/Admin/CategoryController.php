<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'mm_name' => 'required'
        ]);
        Category::create([
            'slug' => Str::slug(request()->name) . uniqid(),
            'name' => request()->name,
            'mm_name' => request()->mm_name
        ]);
        return redirect()->back()->with('success', 'Category Successed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('slug', $id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'mm_name' => 'required'
        ]);
        $category = Category::where('slug', $id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }
        $category->update([
            'name' => $request->name,
            'mm_name' => $request->mm_name
        ]);
        return redirect()->back()->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('slug', $id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category is deleted!');
    }
}
