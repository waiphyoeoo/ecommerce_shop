@extends('admin.layout.master');
@section('content')
    <div>
        <a href="{{ route('brand.create') }}" class="btn btn-dark">Create Brand</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td>Opotion</td>
            </tr>
        </thead>
        <tbody>
           @foreach ($brands as $brand)
           <tr>
            <td>{{ $brand->name }}</td>
            <td>
                <a href="{{ route('brand.edit',$brand->slug) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('brand.destroy',$brand->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('sure for delete?')">
                @csrf
                    @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </td>
        </tr> 
           @endforeach
        </tbody>
    </table>
    {{ $brands->links() }}
@endsection