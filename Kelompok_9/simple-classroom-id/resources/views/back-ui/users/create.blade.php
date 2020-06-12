@extends('layouts.back')

@section('title')
    Tambah User
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('user_create') }}
@endsection
@section('content')

<div class="container">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card bg-secondary border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        @if(session('status')) <div class="alert alert-success text-center">{{session('status')}} </div>@endif
                        <form role="form" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input class="form-control" name="name" type="search" value="{{old('name', null)}}" placeholder="Name*">
                                </div>
                                @error('name')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input class="form-control" name="username" type="search" value="{{old('username', null)}}" placeholder="Username*">
                                </div>
                                @error('username')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email*" value="{{old('email', null)}}" name="email" type="email">
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
                                    <input class="form-control" placeholder="Password*" name="password" type="password">
                                </div>
                                @error('password')
                                   <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password Confrimation*" name="password_confirmation" type="password">
                                </div>
                                @error('password_confirmation')
                                   <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-control-alternative custom-radio">
                                    <input class="custom-control-input" value="Admin" id="adminrole" name="roles" type="radio" {{(old('roles') == 'Admin') ? 'checked' : null}}>
                                    <label class="custom-control-label" for="adminrole">
                                        <span class="text-muted">Admin </span>
                                    </label>
                                </div>
                                <div class="custom-control custom-control-alternative custom-radio">
                                    <input class="custom-control-input" value="User" id="userrole" name="roles" type="radio" {{(old('roles') == 'User') ? 'checked' : null}}>
                                    <label class="custom-control-label" for="userrole">
                                        <span class="text-muted">User </span>
                                    </label>
                                </div>
                                @error('roles')
                                   <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                            </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                        </div>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="3"> {{old('address', 'Alamat')}}</textarea>
                                    </div>
                                @error('address')
                                   <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-tablet-button"></i></span>
                                        </div>
                                        <input class="form-control" value="{{old('phone', null)}}" placeholder="Phone Number" name="phone" type="search">
                                    </div>
                                @error('phone')
                                   <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 mb-2">
                                        <img id="image_preview_container" src="#" alt="preview image"
                                            width="200" height="200" style="object-fit: cover">
                                    </div>
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-image"></i></span>
                                        </div>
                                        <input class="form-control" id="avatar" name="avatar" type="file">
                                    </div>
                                @error('avatar')
                                   <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                                </div>
                                <span class="text-warning"><small><b>field input dengan tanda(*) wajib diisi</b></small> </span>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Create account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function (e) {
            
            $('#image_preview_container').hide();
            $('#avatar').change(function(){
              
                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#image_preview_container').attr('src', e.target.result); 
                  $('#image_preview_container').show();
                }
                reader.readAsDataURL(this.files[0]); 
     
            });
        });
     
    </script>
@endsection