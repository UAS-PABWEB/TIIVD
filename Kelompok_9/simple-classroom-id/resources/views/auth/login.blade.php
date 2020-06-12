@extends('layouts.front')
@section('title')
    Login - SCID
@endsection
@section('content')
<!-- Main content -->
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                        <h1 class="text-white">Selamat Datang!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <!--TODO-->
                    {{-- <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
                        <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">Github</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">Google</span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Silahkan masukan email dan password </small>
                        </div>
                        <form role="form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <!--TODO-->
                            {{-- <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">
                                    <span class="text-muted">{{ __('Remember Me') }}</span>
                                </label>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    @if (Route::has('password.request'))
                    <div class="col-6">
                        <a href="{{ route('password.request') }}" class="text-light">
                            <small>{{ __('Lupa password ?') }}</small>
                        </a>
                    </div>
                    @endif
                    <div class="col-6 text-right">
                        <a href="{{route('register')}} " class="text-light"><small>{{__('Buat akun baru')}} </small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
