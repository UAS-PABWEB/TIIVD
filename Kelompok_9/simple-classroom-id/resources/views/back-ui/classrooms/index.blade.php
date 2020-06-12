@extends('layouts.back')
@section('add_data')
    <a href="{{route('classrooms.create')}} " class="btn btn-sm btn-neutral">Buat Kelas</a>
    <a href="#" data-toggle="modal" data-target="#ikutiKelas" class="btn btn-sm btn-neutral">Ikuti Kelas</a>
    <div class="modal fade" id="ikutiKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukan Token</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('classrooms.create_participant')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-key-25"></i></span>
                                </div>
                                <input class="form-control" name="token" type="search" value="{{old('token', null)}}"
                                placeholder="Token">
                            </div>
                            @error('token')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                            @if (session('msgParticipantE'))
                                <span class="text-danger"><small><b><i>{{session('msgParticipantE')}}</i></b></small> </span>
                            @endif
                            @if (session('msgParticipantS'))
                                <span class="text-success"><small><b><i>{{session('msgParticipantS')}}</i></b></small> </span>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title')
    Kelas
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('classroom') }}
@endsection
@section('content')
<div class="row ">
    <div class="col-xl-4 col-md-6 mt--3">
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0" action="{{route('classrooms.index') }} ">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="keyword" value="{{Request::get('keyword')}}" placeholder="Search" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>
        </div>
</div>
<div class="row mt-4">
    @if ($classrooms->isEmpty())
    <div class="container text-center mt-6 mb-6">
        <span>Maaf tidak ada data yang ditemukan</span>
    </div>
    @endif
    @foreach ($classrooms as $item)
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h2 font-weight-bold mb-0"><a style="color:black" href="{{route('classrooms.show', $item->token)}} ">{{$item->nama_kelas}}</a>  </span>
                        <h5 class="card-title text-uppercase text-muted mb-0">{{$item->bidang_ilmu}} </h5>
                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $item->user_id)
                                <a class="dropdown-item" href="{{route('classrooms.show', $item->token)}} " class="btn btn-primary btn-sm">Show & Edit</a>
                                <form onsubmit="return confirm('Apakah anda yakin menghapus kelas ini dan beserta isinya?')" class="d-inline"
                                    action="{{route('classrooms.destroy', $item->id)}}" method="POST"> @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete" class="dropdown-item">
                                </form>
                                @else
                                <form onsubmit="return confirm('Apakah anda yakin akan keluar dari kelas ini?')" class="d-inline"
                                    action="{{route('classrooms.update', Auth::user()->id)}}" method="POST"> @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="classroom_id" value="{{$item->id}} ">
                                    <input type="submit" name="keluarKelas" value="Keluar" class="dropdown-item">
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-5 mb-0 text-sm">
                    <span class="text-nowrap">{{$item->user->name}}</span>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        {{$classrooms->appends(Request::all())->links()}}
    </ul>
</nav>
@endsection
@section('js')
@if (session('msgParticipantE') || session('msgParticipantS') || $errors->has('token') )
<script>
    $(function() {
            $('#ikutiKelas').modal('show');
        });
</script>
@endif

@endsection