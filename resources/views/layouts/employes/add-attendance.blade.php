@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Attendance')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Attendance</h2>
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
                <form role="form" method="post" action="{{url('add-attendance')}}" >
                    @csrf
                    <div class="form-body">
                      
                    <div class="row">
                      
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('employee_id')) ? 'has-error' : 'has-info'}} ">
                                <div class="input-group">
                                    <label for="form_control_1">Select Employee</label>
                                   
                                    <select class="form-control" id="employee_name" name="employee_id" >
                                        <option value="" disabled selected>Select Employee </option>
                                        @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}" {{old('employee_id') == $employee->id ? "selected" : ""}}>{{$employee->full_name}}</option>

                                        @endforeach

                                    </select>
                                </div>
                                @if ($errors->any() && $errors->first('employee_id'))
                                <span class="text-danger w-100 small">{{$errors->first('employee_id')}}</span>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">

                         
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('type_id')) ? 'has-error' : 'has-info'}} ">
                                <div class="input-group" >
                                    <label for="form_control_1">Attendance Type</label>
                                    
                                    <select class="form-control basic-single" id="type_id" name="type_id" >
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="Clock In">Clock In</option>
                                        
                                        <option value="Clock Out">Clock Out</option>
                                      

                                    </select>
                                </div>
                                @if ($errors->any() && $errors->first('type_id'))
                                <span class="text-danger w-100 small">{{$errors->first('type_id')}}</span>
                            @endif
                            </div>
                        </div>
                       
                    
                    </div>
                    <div class="row">
                       
                        <div class="col-md-6">
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('attendance_date')) ? 'has-error' : 'has-info'}}">
                                <label>Date</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" name="attendance_date"  value="{{old('attendance_date')}}" data-date-autoclose="true" class="form-control" placeholder="Select date">
                                    @if ($errors->any() && $errors->first('attendance_date'))
                                    <span class="text-danger w-100 small">{{$errors->first('attendance_date')}}</span>
                                @endif
                                </div>
                            </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('attendance_time')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Time</label>
                                   
                                    <input type="time" name="attendance_time" class="form-control"  value="{{old('attendance_time')}}" >
                                        @if ($errors->any() && $errors->first('attendance_time'))
                                        <span class="text-danger w-100 small">{{$errors->first('attendance_time')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    
                   
                        
                    </div>
                  
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('comment')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Comment</label>
                                   
                                    <input type="text" name="comment" class="form-control"  value="{{old('comment')}}" >
                                        @if ($errors->any() && $errors->first('comment'))
                                        <span class="text-danger w-100 small">{{$errors->first('comment')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn btn-primary  plain">Submit</button>
                        <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-attendance')}}')">Cancel</button>
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
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">

@stop
@section('vendor-script')
<script>
    function deleteleave(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {
                window.location.href="{{url('delete-leave')}}/"+id;
            }
        }
      
</script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
@stop

@section('page-script')
<script> 
 function cancelFunction(returl)
        {
            window.location.href = returl;
        }
  $('#type_id').select2();
        $('#employee_name').select2();
</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

