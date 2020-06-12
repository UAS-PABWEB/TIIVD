<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') - SCID</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('template/back-ui/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('template/back-ui/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/back-ui/vendor/@fortawesome/fontawesome-free/css/all.min.css')}} " type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('template/back-ui/css/argon.css?v=1.2.0')}}" type="text/css">
    @yield('css')
</head>
<body>
        <!-- Sidenav -->
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                <!-- Brand -->
                <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="javascript:void(0)">
                        <img src="{{asset('template/back-ui/img/brand/blue_scid.png')}}" class="navbar-brand-img" alt="...">
                    </a>
                </div>
                <div class="navbar-inner">
                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                        <!-- Nav items -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{route('home')}}">
                                    <i class="ni ni-tv-2 text-primary"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{route('users.index')}} ">
                                    <i class="ni ni-single-02 text-yellow"></i>
                                    <span class="nav-link-text">User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('classrooms*') ? 'active' : '' }}" href="{{route('classrooms.index')}} ">
                                    <i class="ni ni-hat-3 text-primary"></i>
                                    <span class="nav-link-text">Kelas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Search form -->
                        {{-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Search" type="text">
                                </div>
                            </div>
                            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </form> --}}
                        <!-- Navbar links -->
                        <ul class="navbar-nav align-items-center  ml-md-auto ">
                            <li class="nav-item d-xl-none">
                                <!-- Sidenav toggler -->
                                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                    data-target="#sidenav-main">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item d-sm-none">
                                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                    <i class="ni ni-zoom-split-in"></i>
                                </a>
                            </li>
                        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="media align-items-center">
                                        <span class="avatar avatar-sm rounded-circle">
                                            <?php $url = (Auth::user()->avatar) ? Auth::user()->avatar : 'avatars/default.png'  ?>
                                            <img alt="Image placeholder" src="{{asset('storage/'.$url)}}" width="36" height="36" style="object-fit: cover">
                                        </span>
                                        <div class="media-body  ml-2  d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right ">
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Welcome!</h6>
                                    </div>
                                    <a href="{{route('users.show', Auth::user()->username)}} " class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                        <span>My profile</span>
                                    </a>
                                    {{-- <a href="#!" class="dropdown-item">
                                        <i class="ni ni-settings-gear-65"></i>
                                        <span>Settings</span>
                                    </a> --}}
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="header bg-primary pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center py-4">
                            <div class="col-lg-6 col-7">
                                <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    @yield('breadcrumb')
                                    {{-- <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Default</li>
                                    </ol> --}}
                                </nav>
                            </div>
                            <div class="col-lg-6 col-5 text-right">
                                @yield('add_data')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt--6">
                @yield('content')   
                <!-- Footer -->
                <footer class="footer pt-0">
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
                                        <a href="#" class="nav-link" target="_blank">Landing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" target="_blank">About
                                            Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" target="_blank">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
                </div>
            </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{asset('template/back-ui/vendor/jquery/dist/jquery.min.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/js-cookie/js.cookie.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}} "></script>
    <script src="{{asset('template/back-ui/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}} "></script>
    <!-- Argon JS -->
    <script src="{{asset('template/back-ui/js/argon.js?v=1.2.0')}} "></script>
    @yield('js')
</body>
</html>
