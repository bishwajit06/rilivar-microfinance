<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/favicons/site.webmanifest')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="title" content="Meta title here">
    <meta name="keywords" content="Meta keywords here">
    <meta name="description" content="Meta description here">
    <meta property="og:image" content="{{asset('assets/img/website-profile.jpg')}}" />
    <title>Riliver MicroFinance App | @yield('title') | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    {{-- custom css --}}
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @stack('css')
  </head>
  <body class="rm-bg-gradient">
    <header>
        <nav class="navbar navbar-expand-lg bg-white py-3">
            <div class="container">
                <a class="navbar-brand" href="#"><img class="px-3" src="{{asset('assets/img/logo-2.png')}}" alt="Logo Image"></span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Service</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    </ul>
                    <div class="ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                            @else
                                <a href="{{route('login')}}" class="btn">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{route('register')}}" class="btn btn-primary">Register</a>
                                @endif
                            @endauth
                    @endif
                        
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container py-5">
        <div class="row my-5 justify-content-between align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bolder">WELCOME TO <span class="text-primary display-3 fw-bold">Riliver MicroFinance</span></h1>
                <p class="fs-5 fw-normal mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim, harum? Aliquam nesciunt</p>
                <a href="{{route('login')}}" class="btn btn-warning px-4 fs-5 mt-3 mb-5">Get started</a>
            </div>
            <div class="col-lg-5">
                <img src="{{asset('assets/img/hero.png')}}" class="img-fluid" alt="Image">
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="text-center mb-4">Our Feature</h2>
        <div class="row g-3">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <h5>Feature One</h5>
                        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <h5>Feature Two</h5>
                        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <h5>Feature Three</h5>
                        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer mt-5">
        <div class="container">
            <div class="d-flex">
                <p class="fw-light">© 2023-2024 Riliver Microcredit, Inc. | All right reserved</p>
                <p class="ms-auto" class="fw-light">v1.1.0</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{ $error }}','Error',{
            closeButton:true,
            progressBar:true,
        });
        @endforeach
        @endif
    </script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#example');
    </script>

    @stack('js')
  </body>
</html>