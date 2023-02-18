@extends('admin.layout.master');
@section('content')
    <div>
        <a href="{{ route('product.index') }}" class="btn btn-dark">All Products</a>
    </div>
    <hr>
    <h3>Add For 
        <span class="text-danger">{{ $product->name }}</span>
    </h3>
    <form action="{{ url('/admin/product-remove/'.$product->slug) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="tatal_quantity">Enter Total Quantity</label>
        <input type="text" name="total_quantity" id="total_quantity" class="form-control">
    </div>
    <input type="submit" value="Remove" class="btn btn-danger" >
</form>
@endsection