@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{ url('/admin/product-transactions') }}" class="btn btn-outline-success">Add Transactions</a>
    <a href="{{ url('/admin/product-remove-transactions') }}" class="btn btn-success">Remove Transactions</a>
</div>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Remove Quantity</th>
            <th>Sell Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $t)
        <tr>
            <td>{{ $t->product->name }}</td>
            <td>
                <img src="{{ asset('/images/'.$t->product->image) }}" alt="image" class="img-thumbnail" width="200px" height="200px">
            </td>
            <td>{{ $t->total_quantity }}</td>
            <td>{{ $t->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection