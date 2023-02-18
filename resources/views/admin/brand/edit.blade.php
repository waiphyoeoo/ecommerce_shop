@extends('admin.layout.master')
@section('content')
    <div >
        <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brands</a>
    </div>
    <hr>
    <form action="{{ route('brand.update',$brand->slug) }}" method="POST">
        @csrf
        @method('PATCH')
    <div class="form-group">
        <label for="name">Enter Brand Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Brand Name" value="{{ old('name',$brand->name) }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection