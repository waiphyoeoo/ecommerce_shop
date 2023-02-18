@extends('admin.layout.master')
@section('content')
<div>
    <a href="{{ route('category.index') }}" class="btn btn-dark">All Category</a>
</div>
<hr>
    <form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Enter Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name...">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="mm_name">Enter Category Name(MM)</label>
        <input type="text" class="form-control" name="mm_name" id="mm_name" placeholder="Enter Category Name(MM)...">
        @error('mm_name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <input type="submit" class="btn btn-primary" value="Create">
    </form>
@endsection