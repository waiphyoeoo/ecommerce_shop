@extends('admin.layout.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-selection{
        height: 45px!important;
    }
</style>
@endsection
@section('content')
<div >
        <a href="{{ route('product.index') }}" class="btn btn-dark">All Products</a>
    </div>
    <hr>
    <h3>Add For 
        <span class="text-danger">{{ $product->name }}</span>
    </h3>
    <form action="{{ url('/admin/product-add/'.$product->slug) }}" method="POST" >
    @csrf
    <div class="form-group">
        <label for="supplier">Choose Supplier</label>
        <select name="supplier_slug" id="supplier">
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="total_quantity">Enter Total Quantity</label>
        <input type="number" name="total_quantity" id="total_quantity" class="form-control">
    </div>
    <div class="form-group">
        <label for="des">Enter Description</label>
        <textarea name="description" id="des" class="form-control"></textarea>
    </div>
    <input type="submit" value="Add" class="btn btn-primary">
    </form>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(function(){
        $('#supplier').select2();
        });
</script>
@endsection