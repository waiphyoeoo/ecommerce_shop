@extends('admin.layout.master')
@section('content')
    <div >
        <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brands</a>
    </div>
    <hr>
    <form action="{{ route('brand.store') }}" method="POST">
        @csrf
    <div class="form-group">
        <label for="name">Enter Brand Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Brand Name">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <input type="submit" value="Create" class="btn btn-primary">
    </form>
@endsection