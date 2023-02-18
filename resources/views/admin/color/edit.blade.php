@extends('admin.layout.master');
@section('content')
    <div>
        <a href="{{ route('color.index') }}" class="btn btn-dark">All Color</a>
    </div>
    <hr>
    <form action="{{ route('color.update',$color->slug) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="name">Enter Color Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$color) }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    </div>
    <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection