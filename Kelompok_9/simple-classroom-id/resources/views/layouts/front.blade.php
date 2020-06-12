<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('template/back-ui/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('template/back-ui/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/back-ui/vendor/@fortawesome/fontawesome-free/css/all.min.css')}} " type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('template/back-ui/css/argon.css?v=1.2.0')}}" type="text/css">
</head>
<body class="bg-default">
    <div id="app">
        <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="dashboard.html">
                    <img src="{{asset('template/back-ui/img/brand/white_scid.png')}} ">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                    aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="dashboard.html">
                                    <img src="{{asset('template/back-ui/img/brand/blue.png')}} ">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="d-lg-none" />
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <span class="nav-link-inner--text">{{ __('Login') }}</span>
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">
                                <span class="nav-link-inner--text">{{ __('Register') }}</span>
                            </a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                        
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')    
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2020 <a href="#" class="font-weight-bold ml-1"
                            target="_blank">KELOMPOK 9</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                        <a href="{{ url('/') }} " class="nav-link" target="_blank">Landing</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#!" class="nav-link" target="_blank">About
                                Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link" target="_blank">Contact</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{asset('template/back-ui/vendor/jquery/dist/jquery.min.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/js-cookie/js.cookie.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}} "></script>
    <!-- Argon JS -->
    <script src="{{asset('template/back-ui/js/argon.js?v=1.2.0')}} "></script>
</body>
</html>
