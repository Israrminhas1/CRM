@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage Users')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Update User</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <div class="body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <!-- BEGIN FORM-->
                    <form method="post" action="{{url('edit-users/'.$user->id)}}" class="horizontal-form">
                    @csrf
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{(@$errors->any() && $errors->first('name')) ? 'has-error' : ''}}">
                                        <label class="control-label">Name</label>
                                        <input type="text" name="name" placeholder="Enter User Name"  value="{{old('name',$user->name)}}" class="form-control">
                                        @if ($errors->any() && $errors->first('name'))
                                        <span class="help-block">{{$errors->first('name')}}</span>
                                        @endif
                                    
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group {{(@$errors->any() && $errors->first('email')) ? 'has-error' : ''}}">
                                        <label class="control-label">Email</label>
                                        <input type="text" name="email" placeholder="Enter User Email"  value="{{old('email',$user->email)}}" class="form-control">
                                        @if ($errors->any() && $errors->first('email'))
                                        <span class="help-block">{{$errors->first('email')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <!--/span-->

                                <div class="col-md-4">
                                    <div class="form-group {{(@$errors->any() && $errors->first('password')) ? 'has-error' : ''}}">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="password" placeholder="Enter New Password"  value="{{old('password')}}" class="form-control">
                                        @if ($errors->any()  && $errors->first('password'))
                                        <span class="help-block">{{$errors->first('password')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                @if($roles)
                                <div class="form-group {{(@$errors->any() && $errors->first('name')) ? 'has-error' : ''}}">
                                    <label class="control-label">Role Title</label>
                                    <select name="role_name" class="form-control">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$user->role_id == $role->id ? "selected" : ""}}>{{$role->name}}</option>
                                    @endforeach
                                    </select>
                                    @if ($errors->any() && $errors->first('role_name'))
                                    <span class="help-block">{{$errors->first('role_name')}}</span>
                                    @endif
                                </div>
                                @endif
                                </div>
                            </div>
                            <!--/row-->

                        </div>
                        <div class="form-actions right">
                            <a class="btn btn-default" href="{{ url()->previous() }}">Cancel</a>

                            <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-right">
                            <span class="ladda-label">Save User</span>
                    <span class="ladda-spinner"></span></button>


                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>

    @stop

