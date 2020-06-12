@extends('layouts.back')
@section('title')
    Dashboard
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('home') }}
@endsection
@section('content')
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class=" col ">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="card-body">
                    Selamat Datang, <i>{{Auth::user()->name}}</i> !
                </div>
            </div>
        </div>
    </div>
@endsection