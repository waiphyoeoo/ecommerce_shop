@extends('admin.layout.master')
@section('content')
    <div>
        <a href="{{ route('color.create') }}" class="btn btn-dark">Create Color</a>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Opotion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
            <tr>
                <td>{{ $color->name }}</td>
                <td>
                    <a href="{{ route('color.edit',$color->slug) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('color.destroy',$color->slug) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
                </td>
            </tr
            @endforeach
        </tbody>
    </table>
    {{ $colors->links() }}
@endsection