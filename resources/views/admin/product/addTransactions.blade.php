@extends('admin.layout.master')
@section('content')

<div>
        <a href="{{ url('/admin/product-transactions') }}" class="btn btn-{{url()->current()=='http://localhost:8000/admin/product-transactions' ? '': 'outline-'  }}success">Add Transactions</a>
        <a href="{{ url('/admin/product-remove-transactions') }}" class="btn btn-outline-success">Remove Transactions</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Add Quantity</th>
                <th>Description</th>
                <th>Buy Date</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($transactions as $t)
           <tr>
                <td>{{ $t->product->name }}</td>
                <td>
                    <img src="{{ asset('/images/'.$t->product->image) }}" alt="image" width="100px" height="100px" class="img-thumbnail">
                </td>
                <td>{{ $t->total_quantity }}</td>
                <td>{!! $t->description !!}</td>
                <td>{{ $t->created_at }}</td>
            </tr>
           @endforeach
        </tbody>
    </table>
    {{ $transactions->links() }}
    @endsection