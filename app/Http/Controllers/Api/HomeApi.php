<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeApi extends Controller
{
    public function home()
    {

        $category  = Category::withCount('products')->get();
        $product = Product::with('brand')->paginate(6);
        return response()->json([
            'success' => true,
            'data' => [
                'category' => $category,
                'product' => $product
            ]
        ]);
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('brand', 'colors', 'category')->get();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found!');
        }
        return response()->json([
            'success' => true,
            'data' => [
                'product' => $product
            ]
        ]);
    }
    public function viewCount($slug)
    {
        $product = Product::where('slug', $slug);
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found!');
        }
        $product->update([
            'view_count' => DB::raw('view_count+' . 1)
        ]);
        return response()->json([
            'success' => true,
            'data' => 'View Added'
        ]);
    }
}
