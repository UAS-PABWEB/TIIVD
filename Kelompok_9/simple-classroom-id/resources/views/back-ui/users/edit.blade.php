@extends('layouts.back')
@section('title')
    {{$user->username}}
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('user_edit', $user) }}
@endsection
@section('content')
    <div class="row justify-content-md-center">
            <div class="col-xl-4 order-xl-2 col-centered">
                <div class="card card-profile">
                    <img src="{{asset('template/back-ui/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <form action="{{route('users.update', $user->id)}} " method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="PUT" name="_method">
                                        <?php $url = ($user->avatar) ? $user->avatar : 'avatars/default.png' ?>
                                        <img type="image" id="imageClick" src="{{asset('storage/'.$url)}}" width="150" height="150" style="object-fit: cover" class="rounded-circle" title="Ubah Gambar">
                                        <input type="file" id="avatar" name="avatar" style="display:none" onchange="form.submit()">
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                         @error('avatar')
                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                        @enderror
                                        <span class="heading">10</span>
                                        <span class="description">Kelas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">
                                {{$user->name}}
                            </h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{$user->address}}
                            </div>
                            <br>
                            @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $user->id)  
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ubahpassword">
                                Ubah password
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $user->id)
            <div class="modal fade" id="ubahpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(session('successChangePassword')) <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('successChangePassword')}} 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>@endif
                            <form action="{{route('users.update',$user->id)}} " method="post">
                            @csrf
                            <input type="hidden" value="PUT" name="_method">
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Old Password" name="old_password" type="password">
                                </div>
                                @if (session('notMatch'))
                                    <span class="text-danger"><small><b><i>{{session('notMatch')}}</i></b></small> </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="New Password" name="new_password" type="password">
                                </div>
                                @error('new_password')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="New Password Confrimation" name="conf_password" type="password">
                                </div>
                                @error('conf_password')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="updatePassword" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-xl-8 order-xl-1">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.update', $user->id)}}" method="POST">
                            @csrf
                            <input type="hidden" value="PUT" name="_method">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                @if(session('success')) <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('success')}} 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>@endif
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-name">Nama</label>
                                            <input type="text" id="input-name" class="form-control" placeholder="name" name="name" value="{{$user->name}}"> 
                                            @error('name')
                                                <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" id="input-username" name="username" class="form-control"
                                                placeholder="username" value="{{$user->username}}"> 
                                                @error('username')
                                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" name="email" class="form-control"
                                                placeholder="email" value="{{$user->email}}"> 
                                                @error('email')
                                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-phone">Phone</label>
                                            <input type="text" id="input-phone" class="form-control" placeholder="phone" name="phone"
                                                value="{{$user->phone}} ">
                                            @error('phone')
                                                <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (Auth::user()->roles == 'Admin')
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-roles">Roles</label>
                                            <div class="custom-control custom-control-alternative custom-radio">
                                                <input class="custom-control-input" value="Admin" id="adminrole" name="roles" type="radio" {{($user->roles == 'Admin') ? 'checked' : null}}>
                                                <label class="custom-control-label" for="adminrole">
                                                    <span class="text-muted">Admin </span>
                                                </label>
                                            </div>
                                            <div class="custom-control custom-control-alternative custom-radio">
                                                <input class="custom-control-input" value="User" id="userrole" name="roles" type="radio" {{($user->roles == 'User') ? 'checked' : null}}>
                                                <label class="custom-control-label" for="userrole">
                                                    <span class="text-muted">User </span>
                                                </label>
                                            </div>
                                            @error('roles')
                                                <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Address</label>
                                            <textarea rows="4" cols="30" class="form-control" name="address" placeholder="address">{{$user->address}} </textarea>
                                            @error('address')
                                                <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <button type="submit" name="updateInformation" class="btn btn-primary mt-4">Edit User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
@endsection
@section('js')
    @if (session('notMatch') || $errors->has('new_password') || $errors->has('conf_password') || session('successChangePassword'))
        <script>
        $(function() {
            $('#ubahpassword').modal('show');
        });
        </script>
    @endif

    @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $user->id)
    <script>
        $("#imageClick").click(function() {
            $("input[id='avatar']").click();
        });
    </script> 
    @endif
    
@endsection
