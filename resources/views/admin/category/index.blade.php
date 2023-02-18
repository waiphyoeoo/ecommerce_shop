@extends('admin.layout.master')
@section('content')
    <div>
        <a href="{{route('category.create')}}" class="btn btn-primary">Create Category</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Name(MM)</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->mm_name }}</td>
                <td>
                    <a href="{{ route('category.edit',$category->slug) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('category.destroy',$category->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Sure for Delete?')">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger" >
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection