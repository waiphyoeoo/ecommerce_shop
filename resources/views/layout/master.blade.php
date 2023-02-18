<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecommerce-Shop</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet"
                href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/css/argon-design-system.min.css">
        <style>
                #header {
                        height: 60vh;
                        background: linear-gradient(#007bff, white);
                        border-bottom-left-radius: 10%;
                        border-bottom-right-radius: 10%;
                }

                #header .nav-link {
                        color: white !important;
                }

                #header img {
                        width: 60% !important;

                }
        </style>
        @yield('css')
</head>

<body>
        <!-- Header -->
        <div class="container-fluid" id="header">
                <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand text-white" href="#">Ecommerce-Shop</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                                <a class="nav-link" href="#">Home </a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link" href="#">Your Order</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        User
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" href="#">Login</a>
                                                        <a class="dropdown-item" href="#">Register</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Welcome Guy!</a>
                                                </div>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link disabled" href="#" tabindex="-1"
                                                        aria-disabled="true">
                                                        Cart
                                                        <small class="badge badge-danger" id="cart">7</small>
                                                </a>
                                        </li>
                                </ul>
                                <form class="form-inline" action="{{ url('/') }}" method="GET">
                                        <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                                aria-label="Search" name="search">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                </form>
                        </div>
                </nav>
                <div class="container mt-5">
                        <div class="row">
                                <div class="col-md-6">
                                        <h1>Welcome From Ecommerce Shopping Website</h1>
                                        {{-- <p>
                                                Lorem ips, 
                                        </p> --}}
                                        <a href="" class="btn btn-outline-primary">SignUp</a>
                                        <a href="" class="btn btn-primary">Login</a>
                                </div>
                                <div class="col-md-6 text-center">
                                        <img class=""
                                                src="https://wp.xpeedstudio.com/seocify/home-fifteen/wp-content/uploads/sites/27/2020/03/home17-banner-image-min.png"
                                                alt="">
                                </div>
                        </div>
                </div>
        </div>
        <!-- End Header -->
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/argon-design-system-free@1.2.0/assets/js/argon-design-system.min.js"></script>
        @yield('script')
        <script>
        window.updateCart = cart =>{
             const cartCount = document.getElementById('cart');
             cartCount.innerText = cart;
        }
        window.updateCart(0);
        window.auth = @json(auth()->guard('web')->user());
        </script>
</body>

</html>
