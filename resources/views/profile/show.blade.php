@extends('layout.master')
@section('parentPageTitle', 'Pages')
@section('title', 'My Profile')

@section('content')
<?php $user = DB::table('users')->where('id',auth()->user()->id )->first(); ?>
<!-- Page header section  -->
<div class="block-header">
    <div class="row clearfix">
        <div class="col-xl-5 col-md-5 col-sm-12">
            <h1>Hi, {{ Auth::user()->name }}</h1>
            <span>@yield('title')</span>
        </div>
        {{-- <div class="col-xl-7 col-md-7 col-sm-12 text-md-right">
            <div class="d-flex align-items-center justify-content-lg-end mt-4 mt-lg-0 flex-wrap vivify pullUp delay-550">
                <div class="border-right pr-4 mr-4 mb-2 mb-xl-0">
                    <p class="text-muted mb-1">Purchases <span id="mini-bar-chart3" class="mini-bar-chart"></span></p>
                    <h5 class="mb-0">6,520</h5>
                </div>
                <div class="border-right pr-4 mr-4 mb-2 mb-xl-0">
                    <p class="text-muted mb-1">Today’s profit <span id="mini-bar-chart2" class="mini-bar-chart"></span></p>
                    <h5 class="mb-0">$541.00 M</h5>
                </div>
                <div class="mb-3 mb-xl-0">
                    <p class="text-muted mb-1">Balance <span id="mini-bar-chart1" class="mini-bar-chart"></span></p>
                    <h5 class="mb-0">$982.60 M</h5>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@if(Session::has('errorMsg'))

<div class="alert alert-danger alert-dismissible fade show">{{Session::get('errorMsg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
</div>
@endif
@if(Session::has('successMsg'))
<div class="alert alert-success alert-dismissible fade show">{{Session::get('successMsg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row clearfix">

    <div class="col-xl-4 col-lg-4 col-md-5">
        <div class="card">
            <div class="header">
                <div class="">
                    <div class="card social theme-bg">
                        <div class="profile-header d-flex justify-content-between justify-content-center">
                            <div class="d-flex">
                                <div class="mr-3">
                                    @if (Auth::user()->profile_photo_path)
                                        <img src="{{ asset(Auth::user()->profile_photo_path) }}" class="user-photo" alt="{{ Auth::user()->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/user.png') }}" class="user-photo" alt="User Profile Picture">
                                    @endif
                                </div>
                                <div class="details">
                                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                    <span class="text-light">User</span>
                                    {{-- <p class="mb-0"><span>Posts: <strong>321</strong></span> <span>Followers: <strong>4,230</strong></span> <span>Following: <strong>560</strong></span></p> --}}
                                </div>
                            </div>
                            {{-- <div>
                                <button class="btn btn-default">Follow</button>
                                <button class="btn btn-dark">Message</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <br>
                <h2>Info</h2>

            </div>
            <div class="body">

                <small class="text-muted">Email address: </small>
                <p>{{ Auth::user()->email }}</p>
                <hr>
                {{-- <small class="text-muted">Mobile: </small>
                <p>+ 202-222-2121</p>
                <hr>
                <small class="text-muted">Birth Date: </small>
                <p class="m-b-0">October 17th, 93</p>
                <hr>
                <small class="text-muted">Social: </small>
                <p><i class="fa fa-twitter m-r-5"></i> twitter.com/example</p>
                <p><i class="fa fa-facebook  m-r-5"></i> facebook.com/example</p>
                <p><i class="fa fa-github m-r-5"></i> github.com/example</p>
                <p><i class="fa fa-instagram m-r-5"></i> instagram.com/example</p> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-7">
        <div class="card">
            <div class="header">
                <h2>Basic Information</h2>
                <ul class="header-dropdown dropdown">
                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu theme-bg">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form role="form" method="post" action="{{url('updateProfileInformation')}}" enctype="multipart/form-data" >
                <div class="row clearfix">

                        @csrf
                        <div class="col-lg-6 form-group c_form_group">

                            <label class="control-label">Name</label>
                            <input type="text" name="name" placeholder="Name" value="{{$user->name}}" class="form-control" /> </div>
                        <div class="col-lg-6 form-group c_form_group">
                            <label class="control-label">Email</label>
                            <input type="text" name="email" placeholder="Email" value="{{$user->email}}"  class="form-control" />
                        </div>

                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{$user->profile_photo_path !== "" ? asset($user->profile_photo_path) : asset('assets/images/user.png')}}" alt="" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="photo"> </span>
                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary theme-bg">Update</button>
                    {{-- <button type="button" class="btn btn-default">Cancel</button> --}}
                </form>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h2>Account Data</h2>
            </div>
            <div class="body">
                <form role="form" method="post" action="{{url('updateuserpassword')}}">
                <div class="row clearfix">

                    <div class="col-lg-12 col-md-12">
                        <hr>
                            @csrf
                            <div class="form-group c_form_group">
                                <label class="control-label">Current Password</label>
                                <input type="password"  name="current_password" class="form-control" placeholder="Your Current Password" /> </div>
                            <div class="form-group c_form_group">
                                <label class="control-label">New Password</label>
                                <input type="password" minlength="6" id="password" name="password" class="form-control" placeholder="Enter New Password" /> </div>
                            <div class="form-group c_form_group">
                                <label class="control-label">Re-type New Password</label>
                                <input type="password" minlength="6" id="confirm_password" name="confirm_password" class="form-control" placeholder="Re-type New Password" />
                                <span id='message'></span>
                            </div>
                            {{-- <div class="margin-top-10">
                                <button type="submit" class="btn green"> Change Password </button>

                            </div> --}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary theme-bg">Update</button>
                    <button type="button" class="btn btn-default">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link href="{{asset('assets/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('vendor-script')
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@stop

@section('page-script')

<script src="{{asset('assets/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script>
$(' #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
      $('#message').html('Match').css('color', 'green');
    } else
      $('#message').html('Not Matched').css('color', 'red');
  });
</script>
@stop
