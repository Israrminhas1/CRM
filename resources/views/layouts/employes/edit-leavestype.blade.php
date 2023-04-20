@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Edit Leave Type')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Update Leave Type</h2>
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
                <form role="form" method="post" action="{{url('edit-leavetype/'.$leaves->id)}}" >
                    @csrf
                    <div class="form-body">
                        <div class="caption font-red-sunglo">
                            <span class="text-theme font-weight-bold uppercase "> Basic Info</span>
                            <hr>
                        </div>
                    <div class="row">
                      
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('type_name')) ? 'has-error' : 'has-info'}} ">
                                <div class="input-group">
                                    <label for="form_control_1">Type Name</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span></div>
                                    <input type="text" class="form-control" name="type_name" value="{{old('type_name',$leaves->type_name)}}" placeholder="Type Name">
                                        @if ($errors->any() && $errors->first('type_name'))
                                        <span class="help-block">{{$errors->first('type_name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                       
                    
                    </div>
                 

                   
                    <div class="form-actions noborder">
                        <button type="submit" class="btn btn-primary  plain">Submit</button>
                        <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-leaves-type')}}')">Cancel</button>
                    </div>
                </div>
                </form>
            <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

    @stop

    @section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
  
    @stop
    @section('vendor-script')

        <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    @stop

    @section('page-script')
    <script>
        function cancelFunction(returl)
            {
                window.location.href = returl;
            }
            </script>
@stop
