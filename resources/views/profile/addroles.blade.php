@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage User Roles')


@section('content')


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add User Roles</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <!-- Begin: life time stats -->
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
                <form action="{{url('add-roles')}}" name="permission-form" method="post">
                    @csrf
                    <!-- Begin: life time stats -->
                    <div class="table-responsive">
                        <div>
                            <div class="form-group {{(@$errors->any() && $errors->first('name')) ? 'has-error' : ''}}">
                                <label class="control-label">Role Title</label>
                                <input type="text" name="role_name" placeholder="Enter Role Title"  value="{{old('role_name')}}" class="form-control">
                                @if ($errors->any() && $errors->first('role_name'))
                                <span class="help-block">{{$errors->first('role_name')}}</span>
                                @endif
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Module Name</th>
                                <th>Access Rights</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($menus)
                                    @foreach($menus as $key => $val)
                                    <tr>
                                        <td colspan="2">
                                            <label class="switch">
                                                <input type="checkbox" name="master-check[]" id="master-{{$key}}" value="{{$key}}" onclick="mark_child_checkbox({{$key}});" class="md-check">
                                                <span class="slider round"></span>
                                            </label>
                                            <label for="master-{{$key}}">
                                                <strong>{{$val['name']}}</strong>
                                            </label>
                                            {{-- <div class="md-checkbox">
                                                <input type="checkbox" name="master-check[]" id="master-{{$key}}" value="{{$key}}" onclick="mark_child_checkbox({{$key}});" class="md-check">
                                                <label for="master-{{$key}}">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                <strong>{{$val['name']}}</strong></label>
                                            </div> --}}
                                        </td>
                                    </tr>
                                        @foreach($val['child'] as $child)
                                    <tr>
                                        <td>{{$child->name}}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" name="view-check[]" id="view-{{$key}}-{{$child->id}}" class="md-check" value="{{$child->id}}">
                                                <span class="slider round"></span>
                                            </label>

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="2">No Records Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- End: life time stats -->
                    </div>
                    <div class="form-actions right">
                        <button type="submit" class="btn btn-primary mt-ladda-btn ladda-button" data-style="expand-right">
                        Add Role </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        @stop


@section('page-script')
<script>

    function mark_child_checkbox(top_menu_id)
    {
        var mastercheckbox=document.getElementById('master-'+top_menu_id);

        var view_arr=document.getElementsByName("view-check[]");
        var view_length=view_arr.length;


        if(mastercheckbox.checked==true)
        {
            for(k=0;k<view_length;k++)
            {
                var vid = view_arr[k].id;
                var chvid = vid.search('-'+top_menu_id+'-');
                if(chvid > 0)
                document.getElementById(vid).checked = true;
            }
        }
        else
        {
            for(k=0;k<view_length;k++)
            {
                var vid = view_arr[k].id;
                var chvid = vid.search('-'+top_menu_id+'-');
                if(chvid > 0)
                document.getElementById(vid).checked = false;
            }
        }

    }
</script>
@stop
