@extends('admin.layout.master')
@section('content')
    <div>
        <a href="{{ route('product.create') }}" class="btn btn-dark">Product Create</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Remain Qty</th>
                <th>Add Or Remove</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td><img src="{{ asset("/images/" . $product->image) }}" alt="image" width="200px" height="200px"  class='img-thumbnail'></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->total_quantity }}</td>
                <td>
                    <a href="{{ url('/admin/product-remove',$product->slug) }}" class="btn btn-warning">-</a>
                    <a href="{{ url('/admin/product-add',$product->slug) }}" class="btn btn-dark">+</a>
                </td>
                <td>
                    <a href="{{ route('product.edit',$product->slug) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('product.destroy',$product->slug) }}" class="d-inline" method="POST" onsubmit="return confirm('sure for delete!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    {{ $products->links() }}
@endsection