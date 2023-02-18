<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\productRemoveTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->select('name', 'image', 'slug', 'total_quantity')->paginate(5);
        return view('admin.product.index', [
            'products' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $color = Color::all();
        $brand = Brand::all();
        $supplier = Supplier::all();
        return view('admin.product.create', [
            'categories' => $category,
            'colors' => $color,
            'brands' => $brand,
            'suppliers' => $supplier
        ]);
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
            "name" => 'required|string',
            "description" => "required|string",
            "total_quantity" => "required|integer",
            "sale_price" => "required|integer",
            "buy_price" => "required|integer",
            "discount_price" => "required|integer",
            "supplier_slug" => "required|string",
            "category_slug" => "required|string",
            "brand_slug" => "required|string",
            "color_slug.*" => 'required|string',
            "image" => 'required|mimes:jpg,png,jpeg,webp|max:4048'
        ]);
        //image upload
        $image = request()->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        //product store
        $category = Category::where('slug', request()->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }

        $brand = Brand::where('slug', request()->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand Not Found!');
        }
        $supplier = Supplier::where('id', request()->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier Not Found!');
        }
        $colors = [];
        foreach ($request->color_slug as $c) {
            $color =  Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'Color Not Found!');
            }
            $colors[] = $color->id;
        }
        $product =  Product::create([
            'name' => request()->name,
            'description' => request()->description,
            'slug' => uniqid() . Str::slug(request()->name),
            'image' => $image_name,
            'total_quantity' => request()->total_quantity,
            'sale_price' => request()->sale_price,
            'buy_price' => request()->buy_price,
            'discount_price' => request()->discount_price,
            'supplier_id' => $supplier->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'view_count' => 0,
            'like_count' => 0
        ]);
        // product add transaction
        ProductAddTransaction::create([
            'supplier_id' => $supplier->id,
            'product_id' => $product->id,
            'total_quantity' => request()->total_quantity,
            'description' => request()->description
        ]);

        //product_color
        $p = Product::find($product->id);
        $p->colors()->sync($colors);

        return redirect()->back()->with('success', 'Product Created!');
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
        $supplier =  Supplier::all();
        $category = Category::all();
        $brand = Brand::all();
        $color = Color::all();
        $product = Product::where('slug', $id)->with('supplier', 'category', 'brand', 'colors')->first();
        return view('admin.product.edit', [
            'suppliers' => $supplier,
            'categories' => $category,
            'brands' => $brand,
            'colors' => $color,
            'product' => $product

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
        // dd(request()->all());
        $product = Product::where('slug', $id)->first();
        request()->validate([
            "name" => 'required|string',
            "description" => "required|string",
            "total_quantity" => "required|integer",
            "sale_price" => "required|integer",
            "buy_price" => "required|integer",
            "discount_price" => "required|integer",
            "supplier_slug" => "required|string",
            "category_slug" => "required|string",
            "brand_slug" => "required|string",
            "color_slug.*" => 'required|string',
            "image" => 'mimes:jpg,png,jpeg,webp|max:2048'
        ]);
        //image update
        $image = request()->image === null ? $product->image : request()->file('image');
        if ($request->image !== null) {
            $image_name = request()->file('image')->getClientOriginalName();
            $image->move(public_path('/images/'), $image_name);
        } else {
            $product->image;
        }
        //product store
        $category = Category::where('slug', request()->category_slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category Not Found!');
        }

        $brand = Brand::where('slug', request()->brand_slug)->first();
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand Not Found!');
        }
        $supplier = Supplier::where('id', request()->supplier_slug)->first();
        if (!$supplier) {
            return redirect()->back()->with('error', 'Supplier Not Found!');
        }
        $colors = [];
        foreach ($request->color_slug as $c) {
            $color =  Color::where('slug', $c)->first();
            if (!$color) {
                return redirect()->back()->with('error', 'Color Not Found!');
            }
            $colors[] = $color->id;
        }
        $product->update([
            'name' => request()->name,
            'description' => request()->description,
            'image' =>  request()->image === null ? $product->image : request()->file('image')->getClientOriginalName(),
            'total_quantity' => request()->total_quantity,
            'sale_price' => request()->sale_price,
            'buy_price' => request()->buy_price,
            'discount_price' => request()->discount_price,
            'supplier_id' => $supplier->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id
        ]);
        //product add transction
        $productaddtransctions = ProductAddTransaction::find($product->id)->first();
        $productaddtransctions->update([
            'total_quantity' => request()->total_quantity
        ]);
        //product_color
        $product->colors()->sync($colors);

        return redirect()->back()->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find product
        $product = Product::where('slug', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found!');
        }
        //delete image
        File::delete(public_path('/images/' . $product->first()->image));
        //delete product_color
        Product::find($product->first()->id)->colors()->sync([]);
        //delete product
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted!');
    }
    public function imageUpload()
    {
        $file = request()->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);
        return asset('/images/' . $file_name);
    }
    public function productAdd($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found!');
        }
        $supplier = Supplier::all();
        return view('admin.product.productAdd', [
            'product' => $product,
            'suppliers' => $supplier
        ]);
    }
    public function storeproductAdd($slug)
    {
        request()->validate([
            'supplier_slug' => 'required',
            'total_quantity' => 'required|integer',
            'description' => 'required'
        ]);
        $product = Product::where('slug', $slug)->first();
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => request()->supplier_slug,
            'total_quantity' => request()->total_quantity,
            'description' => request()->description
        ]);
        $product->update([
            'total_quantity' => DB::raw('total_quantity+' . request()->total_quantity)
        ]);
        return redirect()->back()->with('success', 'Add Transaction');
    }
    public function productremove($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('admin.product.productRemove', [
            'product' => $product
        ]);
    }
    public function storeproductremove($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found!');
        }
        request()->validate([
            'total_quantity' => 'required|integer'
        ]);
        productRemoveTransaction::create([
            'product_id' => $product->id,
            'total_quantity' => request()->total_quantity
        ]);
        $product->update([
            'total_quantity' => DB::raw('total_quantity-' . request()->total_quantity)
        ]);
        return redirect()->back()->with('success', 'Remove Transactions');
    }
    public function productTransactions()
    {
        $transactions = ProductAddTransaction::with('product')->paginate(5);
        return view('admin.product.addTransactions', [
            'transactions' => $transactions
        ]);
    }
    public function productremovetransactions()
    {
        $transactions = productRemoveTransaction::with('product')->paginate(2);
        return view('admin.product.removeTransactions', [
            'transactions' => $transactions
        ]);
    }
}
