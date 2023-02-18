@extends('admin.layout.master')
@section('content')

<div>
    <a href="{{ route('category.index') }}" class="btn btn-dark">All Category</a>
</div>
<hr>
    <form action="{{ route('category.update',$category->slug) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="name">Enter Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name..." value="{{ old('name',$category->name) }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="mm_name">Enter Category Name(MM)</label>
        <input type="text" class="form-control" name="mm_name" id="mm_name" placeholder="Enter Category Name(MM)..." value="{{ old('mm_name',$category->mm_name) }}">
        @error('mm_name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <input type="submit" class="btn btn-primary" value="Update">
    </form>
@endsection