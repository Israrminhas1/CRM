@extends('layout.authentication')
@section('title', 'Login')


@section('content')

    <div class="auth_brand">
        <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/Maintenance-logo-black.png') }}"  class="d-inline-block img-fluid align-top mr-2" alt=""></a>
    </div>
    <div class="card">
        <div class="header">
            <p class="lead">Login to your account</p>
        </div>
        <div class="body">
            @if(Session::has('errorMsg'))
                <div class="alert alert-danger alert-message-display">{{Session::get('errorMsg')}}</div>
                @endif
                @if(Session::has('successMsg'))
                <div class="alert alert-success alert-message-display">{{Session::get('successMsg')}}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-message-display">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group c_form_group">
                    <label  for="email" value="{{ __('Email') }}">Email</label>
                    <input type="email" name="email" id="email" class="form-control" :value="old('email')" required autofocus placeholder="Enter your email address">
                </div>
                <div class="form-group c_form_group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password"  required autocomplete="current-password" >
                </div>
                <div class="form-group clearfix">
                    <label class="fancy-checkbox element-left">
                        <input type="checkbox" id="remember_me" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-dark btn-lg btn-block" >LOGIN</button>
                <div class="bottom">
                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="{{route('password.request')}}">Forgot password?</a></span>
                    <span>Don't have an account? <a href="{{route('register')}}">Register</a></span>
                </div>
            </form>
        </div>
    </div>

@stop
