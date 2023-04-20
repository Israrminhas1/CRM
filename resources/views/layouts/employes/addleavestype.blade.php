@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Add Leaves Type')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Leave Type</h2>
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
                <form role="form" method="post" action="{{url('add-leavestype')}}" >
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
                                    <input type="text" class="form-control" name="type_name" value="{{old('type_name')}}" placeholder="Type Name">
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
    {{-- model start  --}}
    <div class="modal fade" id="add-types" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Leave Type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group c_form_group has-info">
                                <div class="input-group">
                                    <label for="form_control_1">Leave Type Name </label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span></div>
                                    <input type="text"  id="project_type_name" name="project_type_name"  class="form-control"  placeholder="Leave Type Name">
                                    <span class="text-danger text-danger-error text-danger help-type"> This Field Is Required</span>

                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green btn-primary" id="addnewtype">Add</button>
                    <button type="button" class="btn dark btn-dark" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
      
        <!-- /.modal-dialog -->
   
    {{-- model end  --}}
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
