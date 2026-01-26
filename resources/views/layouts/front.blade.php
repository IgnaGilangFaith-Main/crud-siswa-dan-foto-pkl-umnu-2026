<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran Siswa PKL | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('icon/icon1.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('css')
</head>

<body>
    <div class="d-flex flex-column min-vh-100">
        {{-- Navbar  --}}
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark sticky-top">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a href="{{ url('/') }}" data-aos="fade" class="">
                        <img src="{{ asset('icon/elmuna2.png') }}" alt="Logo" width="40%">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            @if (auth()->check())
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                                <a class="nav-link" href="{{ url('/login') }}">Login</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container my-3">
            @yield('content')
        </div>

        {{-- Footer  --}}
        <footer class="py-5 bg-dark mt-auto">
            <div>
                <p class="m-0 text-center text-white">Copyright &copy; Elmuna Kebumen {{ date('Y') }}</p>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ url('/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        AOS.init();
    </script>
    @stack('js')
</body>

</html>
