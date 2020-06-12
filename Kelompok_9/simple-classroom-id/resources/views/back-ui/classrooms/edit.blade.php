@extends('layouts.back')
@section('css')
    <style>
        .table-fixed{
            width: 100%;
        }
        .table-fixed tbody {
                height:260px;
                overflow-y:auto;
                width: 100%;
        }
        .table-fixed thead, 
        .table-fixed tbody {
            display:block;
        }
        .table-fixed tbody tr td{
            width: 100%;
        }
        </style>
@endsection
@section('title')
{{$classroom->nama_kelas}}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('classroom_edit', $classroom) }}
@endsection
@section('content')
<div class="row justify-content-md-center">
    <div class="col-xl-5">
        @if(session('successChangeAvatar')) <div
            class="alert alert-success alert-dismissible fade show text-center ava-change" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('successChangeAvatar')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>@endif
        <div class="card card-profile">
            <img src="{{asset('template/back-ui/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder"
                class="card-img-top">
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col">
                        <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                                @error('avatar')
                                <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                                <span class="heading"> {{$classroom->nama_kelas}} </span>
                                <span class="description">{{$classroom->bidang_ilmu}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <p class="h4">
                        {{$classroom->deskripsi}}
                    </p>
                </div>
                <br>
                <div class="text-left">
                    <p class="h5">Token : <i><strong>{{$classroom->token}}</strong> </i> </p>
                    <p class="h5">Pembuat : <i><strong>{{$classroom->user->name}}</strong> </i> </p>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
    <div class="col-xl-5">
        <div class="card">
            <div class="card-body">
                <form action="{{route('classrooms.update', $classroom->id)}}" method="POST">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <h6 class="heading-small text-muted mb-4">Kelas information</h6>
                    <div class="pl-lg-4">
                        @if(session('success')) <div class="alert alert-success alert-dismissible fade show text-center"
                            role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>@endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Nama Kelas</label>
                                    <input type="text" id="input-name" class="form-control" placeholder="name"
                                        name="nama_kelas" value="{{$classroom->nama_kelas}}">
                                    @error('nama_kelas')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Bidang Ilmu</label>
                                    <input type="text" id="input-username" name="bidang_ilmu" class="form-control"
                                        placeholder="bidang_ilmu" value="{{$classroom->bidang_ilmu}}">
                                    @error('bidang_ilmu')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label">Deskripsi</label>
                                    <textarea rows="4" cols="30" class="form-control" name="deskripsi"
                                        placeholder="deskripsi">{{$classroom->deskripsi}} </textarea>
                                    @error('deskripsi')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" name="updateInformation" class="btn btn-primary mt-4">Edit Kelas</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    @endif
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Peserta Kelas</h3>
                            </div>
                            @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
                            <div class="col text-right">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#undangPeserta"><i class="fa fa-user-plus text-white"  aria-hidden="true"></i>&nbsp; Undang</a>
                                <div class="modal fade" id="undangPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Masukan Username Peserta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('classrooms.update', $classroom->token)}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="form-group">
                                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                                                </div>
                                                                <input class="form-control" name="username" type="search" value="{{old('username', null)}}"
                                                                    placeholder="Username">
                                                            </div>
                                                            @error('username')
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
                                                            <button type="submit" name="undangPeserta" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if (session('msgKeluarkanS'))
                    <div class="alert alert-success alert-dismissible fade show text-center ava-change" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-02"></i></span> {{(session('msgKeluarkanS'))}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('msgKeluarkanE'))
                    <div class="alert alert-danger alert-dismissible fade show text-center ava-change" role="alert">
                        <span class="alert-icon"><i class="ni ni-sound-wave"></i></span> {{(session('msgKeluarkanE'))}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table table-fixed">
                            <tbody>
                                @foreach ($participant as $item)
                                <tr>
                                    <td>
                                        <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img alt="Image placeholder" src="{{asset('storage/'.$item->user->avatar)}} " width="36" height="36"
                                                style="object-fit: cover">
                                            </span>
                                            <div class="media-body  ml-2 ">
                                                <span class="mb-0 text-sm  font-weight-bold"><a href="{{route('users.show', $item->user->username)}} " style="color:black">{{$item->user->name}}</a>  </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <form onsubmit="return confirm('Apakah anda yakin mengeluarkan user ini?')" class="d-inline"
                                                action="{{route('classrooms.update', $classroom->token)}} " method="POST"> 
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="user_id" value="{{$item->user->id}}">
                                                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                                                <input type="submit" name="keluarkan" value="Keluarkan" class="dropdown-item">
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Materi Kelas</h3>
                            </div>
                            @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
                            <div class="col text-right">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahMateri"><i class="fa fa-plus text-white"  aria-hidden="true"></i>&nbsp; Materi</a>
                                <div class="modal fade" id="tambahMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                @if(session('msgMateriS')) <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('msgMateriS')}} 
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>@endif
                                                    <form action="{{route('classrooms.theories', $classroom->token)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="classroom_id" value="{{$classroom->id}} ">
                                                        <div class="form-group">
                                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                                                </div>
                                                                <input class="form-control" name="judul_materi" type="search" value="{{old('judul', null)}}"
                                                                    placeholder="Judul Materi">
                                                            </div>
                                                            @error('judul_materi')
                                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                                                </div>
                                                                <textarea name="deskripsi_materi" class="form-control" id="" cols="30" rows="10">{{old('judul', 'Deskripsi')}}</textarea>
                                                            </div>
                                                            @error('deskripsi_materi')
                                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="ni ni-spaceship"></i></span>
                                                                </div>
                                                                <input type="file" name="file_materi" class="form-control" id="">
                                                            </div>
                                                            @error('file_materi')
                                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="tambahMateri" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endif
                            </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg" id="detailMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="">Detail Materi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col" style="width: 10px;" class="sort" data-sort="judul">Judul</th>
                                                                <th scope="col" style="width: 10px;" class="sort" data-sort="deskripsi">Deksripsi</th>
                                                                <th scope="col" style="width: 10px;" class="sort" data-sort="file">File</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                            <tr>
                                                                <td scope="row"  style="width: 10px">
                                                                    <div class="media align-items-center">
                                                                        <div class="media-body">
                                                                            <span class="name mb-0 text-sm" id="judul_materi_detail">Argon Design System</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="deskripsi"  style="width: 10px" id="deskripsi_materi_detail">
                                                                    $2500 USD
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="h5 mt-5" id="file_materi_detail" style="width: 10px"> Tidak ada file</a></td>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="ubahMateri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Materi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                @if(session('msgMateriSU')) <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('msgMateriSU')}} 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>@endif
                                    <form action="{{route('classrooms.update', $classroom->token)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="theory_id" id="theory_id">
                                        <div class="form-group">
                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-tag"></i></span>
                                                </div>
                                                <input class="form-control" name="judul_materi_ubah" id="judul_materi" type="search" value="{{old('judul', null)}}"
                                                    placeholder="Judul Materi">
                                            </div>
                                            @error('judul_materi_ubah')
                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                                </div>
                                                <textarea name="deskripsi_materi_ubah" id="deskripsi_materi" class="form-control" id="" cols="30" rows="10">{{old('judul', 'Deskripsi')}}</textarea>
                                            </div>
                                            @error('deskripsi_materi_ubah')
                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            Current File : <a href="#" id="modalFileName"> Tidak ada file</a>
                                            <br>
                                            <br>
                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-spaceship"></i></span>
                                                </div>
                                                <input type="file" name="file_materi_ubah" id="file_materi" class="form-control" id="">
                                            </div>
                                            @error('file_materi_ubah')
                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="ubahMateri" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table table-fixed">
                            <tbody>
                                @if ($theory->isEmpty())
                                <tr>
                                    <td>{{'Data belum tersedia'}}</td>
                                    
                                </tr>
                                @endif
                                @foreach ($theory as $item)
                                <tr>
                                    <td>
                                        <div class="media align-items-center">
                                            <div class="media-body ml-2">
                                                <span class="mb-0 text-sm  font-weight-bold"><a href="#!"  class="lihatMateri" id="{{$item->id}}" style="color: black">{{$item->judul}}</a>  </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item ubahMateri" href="#" data-toggle="modal" data-target="#ubahMateri" id="{{$item->id}}" class="btn btn-primary btn-sm">Edit</a>
                                            <form onsubmit="return confirm('Apakah anda yakin menghapus materi ini?')" class="d-inline"
                                                action="{{route('classrooms.theories', $classroom->token)}} " method="POST"> 
                                                @csrf
                                                <input type="hidden" name="theory_id" value="{{$item->id}}">
                                                <input type="hidden" name="user_id" value="{{$item->user->id}}">
                                                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                                                <input type="submit" name="hapusMateri" value="Hapus" class="dropdown-item">
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
</div>
@endsection
@section('js')
    <script>
        // Change the selector if needed
        var $table = $('.table-fixed'),
        $bodyCells = $table.find('tbody tr:first').children(),
        colWidth;
        
        // Adjust the width of thead cells when window resizes
        $(window).resize(function() {
        // Get the tbody columns width array
        colWidth = $bodyCells.map(function() {
        return $(this).width();
        }).get();
        
        // Set the width of thead columns
        $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
        });
        }).resize(); // Trigger resize handler

        $(document).ready(function () {
            $('.lihatMateri').click(function(){
                $('#detailMateri').modal('show');
                $('#file_materi_detail').attr("download", "")
                var theory_id = $(this).attr("id");
                var lihatMateri = true;

                $.ajax({
                    url : window.location.href ,
                    method : 'POST',
                    data : {
                        "theory_id":theory_id, 
                        "lihatMateri":lihatMateri,
                        "_token": "{{ csrf_token() }}"},
                    success : function(data){
                        var result = JSON.parse(data);
                        $('#judul_materi_detail').html(result.judul);
                        $('#deskripsi_materi_detail').html(result.deskripsi);
                        if (result.file_name === null) {
                            $('#file_materi_detail').html("Tidak ada file");
                            $('#file_materi_detail').removeAttr('download');
                            $('#file_materi_detail').attr('href', '#');
                            $('#file_materi_detail').css('color', 'grey');
                        }else{
                            $('#file_materi_detail').html(result.file_name);
                            $('#file_materi_detail').css('color', 'blue');
                            $('#file_materi_detail').attr('href', '{{asset("storage/")}}/'+result.file);   
                        }
                    }
                })
            })
            $('.ubahMateri').click(function(){
                $('#modalFileName').attr("download", "")
                var theory_id = $(this).attr("id");
                var ubahMateri = true;

                $.ajax({
                    url : window.location.href ,
                    method : 'POST',
                    data : {
                        "theory_id":theory_id, 
                        "ubahMateri":ubahMateri,
                        "_token": "{{ csrf_token() }}"
                     },
                    success : function(data){
                        var result = JSON.parse(data);
                        $('#theory_id').val(result.id);
                        $('#judul_materi').val(result.judul);
                        $('#deskripsi_materi').html(result.deskripsi);
                        if (result.file_name === null) {
                            $('#modalFileName').html("Belum ada file");
                            $('#modalFileName').removeAttr('download');
                            $('#modalFileName').attr('href', '#');
                            $('#modalFileName').css('color', 'grey');
                        }else{
                            $('#modalFileName').html(result.file_name);
                            $('#modalFileName').css('color', 'blue');
                            $('#modalFileName').attr('href', '{{asset("storage/")}}/'+result.file);   
                        }
                    }
                })
            })
        })

    </script>

    @if (session('msgParticipantE') || session('msgParticipantS') || $errors->has('username') )
    <script>
        $(function() {
                $('#undangPeserta').modal('show');
            });
    </script>
    @endif

    @if (session('msgMateriS') || $errors->has('judul_materi')  || $errors->has('deskripsi_materi') || $errors->has('file_materi'))
    <script>
        $(function() {
                $('#tambahMateri').modal('show');
            });
    </script>
    @endif

    @if ($errors->has('judul_materi_ubah')  || $errors->has('deskripsi_materi_ubah') || $errors->has('file_materi_ubah'))
    <script>
        $(function() {
                $('#ubahMateri').modal('show');
            });
    </script>
    @endif


@endsection