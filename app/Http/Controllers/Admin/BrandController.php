<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::latest()->paginate(5);
        return view('admin.brand.index', [
            'brands' => $brand
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'name' => 'required'
        ]);
        Brand::create([
            'slug' => Str::slug(request()->name . uniqid()),
            'name' => request()->name
        ]);
        return redirect()->back()->with('success', 'Brand Created!');
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
        $brand = Brand::where('slug', $id)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand Not Found!');
        }
        return view('admin.brand.edit', [
            'brand' => $brand
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
        $brand = Brand::where('slug', $id)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand Not Found!');
        }
        request()->validate([
            'name' => 'required'
        ]);
        $brand->update([
            'name' => request()->name
        ]);
        return redirect()->back()->with('success', 'Brand Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::where('slug', $id)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand Not Found!');
        }
        $brand->delete();
        return redirect()->back()->with('success', 'Brand Deleted!');
    }
}
