@extends('layouts.back')
@section('title')
    Tambah Kelas
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('classroom_create') }}
@endsection
@section('content')

<div class="container">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card bg-secondary border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    @if(session('status')) <div class="alert alert-success text-center">{{session('status')}} </div>
                    @endif
                    <form role="form" action="{{route('classrooms.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" name="nama_kelas" type="search" value="{{old('nama_kelas', null)}}"
                                placeholder="Nama Kelas*">
                            </div>
                            @error('nama_kelas')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-book-bookmark"></i></span>
                                </div>
                                <input class="form-control" name="bidang_ilmu" type="search"
                                value="{{old('bidang_ilmu', null)}}" placeholder="Bidang Ilmu">
                            </div>
                            @error('bidang_ilmu')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                </div>
                                <textarea name="deskripsi" class="form-control" id="" cols="30"
                                    rows="3"> {{old('deskripsi', 'Deskripsi')}}</textarea>
                            </div>
                            @error('deskripsi')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">Create class</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection