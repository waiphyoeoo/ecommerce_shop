<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::latest()->paginate(2);
        return view('admin.color.index', [
            'colors' => $colors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
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
        Color::create([
            'slug' => Str::slug(request()->name . uniqid()),
            'name' => request()->name
        ]);
        return redirect()->back()->with('success', 'Color Created!');
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
        $color = Color::where('slug', $id)->first();
        if (!$color) {
            return redirect()->back()->with('error', 'Color Not Found!');
        }
        return view('admin.color.edit', [
            'color' => $color
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
        $color = Color::where('slug', $id)->first();
        if (!$color) {
            return redirect()->back()->with('error', 'Color Not Found!');
        }
        request()->validate([
            'name' => 'required'
        ]);
        $color->update([
            'name' => request()->name
        ]);
        return redirect()->back()->with('success', 'Color Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::where('slug', $id)->first();
        if (!$color) {
            return redirect()->back()->with('error', 'Color Not Found!');
        }
        $color->delete();
        return redirect()->back()->with('success', 'Color Deleted!');
    }
}
