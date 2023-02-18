<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        return view('home');
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $category = Category::withCount('products')->get();
        if (!$product) {
            return redirect('/')->with('error', 'Product Not Found!');
        }
        return view('show', [
            'categories' => $category,
            'slug' => $slug
        ]);
    }
}
