<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css') }}">
    {{-- Tostify css link --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>
<body>
        <div class="container  mt-5 mr-5">
            <div class="row ml-5 ">
                <div class="col-md-4 offest-4 ml-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Admin Login
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                                {{-- @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror --}}
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                {{-- @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror --}}
                            </div>
                            <input type="submit" value="Login" class="btn btn-primary">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- tostify js link --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <style>
            .toastify{
                background-image: unset
            }
        </style>
       @if (session('error'))
       <script>
                Toastify({
        text: "{{ session('error') }}",
        className: "bg-danger",
        position:'center'
        }).showToast();
</script>
       @endif
    </body>
</html>