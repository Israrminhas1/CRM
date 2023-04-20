@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Add leaves')


@section('content')


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Leaves</h2>
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
                <form role="form" method="post" action="{{url('add-leaves')}}" >
                    @csrf
                    <div class="form-body">
                        <div class="caption font-red-sunglo">
                            <span class="text-theme font-weight-bold uppercase "> Basic Info</span>
                            <hr>
                        </div>
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
                                    <label for="form_control_1">Leave Type</label>
                                    
                                    <select class="form-control basic-single" id="type_id" name="type_id" >
                                        <option value="" disabled selected>Select Leave Type</option>
                                        @foreach ($types as $type)
                                        <option value="{{$type->id}}" {{old('type_id') == $type->id ? "selected" : ""}}>{{$type->type_name}}</option>

                                        @endforeach

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
                            <div class="form-group c_form_group">
                                <label>Paid/Unpaid</label>

                                <label class="fancy-radio custom-color-green" style="width: auto;margin-bottom: 0px">
                                    <input type="radio" id="radio14" value="paid" name="ispaid" {{old('ispaid') == 'paid' ? "checked" : "checked"}} >
                                    <span><i></i> Paid </span> </label>


                                <label class="fancy-radio custom-color-green" style="width: auto;margin-bottom: 0px">
                                    <input type="radio" id="radio15" value="unpaid" name="ispaid"  {{old('ispaid') == 'unpaid' ? "checked" : ""}} >
                                    <span><i></i> Unpaid </span> </label>


                              

                            </div>
                        </div>
                    
                   
                        <div class="col-md-6">
                            {{-- <div class="form-group c_form_group {{(@$errors->any() && $errors->first('leave_date')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Leave Date</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </span></div>
                                    <input type="text"  data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" name="leave_date" class="form-control"  value="{{old('leave_date')}}" placeholder="Leave Date">
                                        @if ($errors->any() && $errors->first('leave_date'))
                                        <span class="text-danger w-100 small">{{$errors->first('leave_date')}}</span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="form-group c_form_group {{(@$errors->any() && ($errors->first('start')) || $errors->first('end')) ? 'has-error' : 'has-info'}}">
                                <label>Leave Date</label>                                    
                                <div class="input-daterange input-group" data-provide="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" value="{{old('start')}}" placeholder="Start date">
                                    <span class="input-group-addon range-to">to</span>
                                    <input type="text" class="input-sm form-control" name="end"  value="{{old('end')}}"placeholder="End date">
                                </div>
                                @if ($errors->any() && $errors->first('start'))
                                <span class="text-danger w-100 small">{{$errors->first('start')}}</span>
                            @endif
                            @if ($errors->any() && $errors->first('end'))
                            <span class="text-danger w-100 small">{{$errors->first('end')}}</span>
                        @endif
                            </div>
                    </div>
                  
                  




                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn btn-primary  plain">Submit</button>
                        <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-leaves-record')}}')">Cancel</button>
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
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
    @stop
    @section('vendor-script')

        <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    @stop

    @section('page-script')
<script>
    function cancelFunction(returl)
        {
            window.location.href = returl;
        }
    $('.help-type').hide();
    $('#employee_name').select2();
    $('#type_id').select2({theme: "bootstrap"}).on('select2:open', () => {
        $('#select2-type_id-results').parent(".select2-results:not(:has(a))").append('<a class=" btn btn-dark" data-toggle="modal" href="#add-types" title="Add Project Types" id="btn-add-new-project-type" style="width: -webkit-fill-available;"><strong>Add Leave Type</strong></a>') ;
				});
    $(document).on('click', '#btn-add-new-project-type', function(){
        $('#type_id').select2("close");


        });
    $(document).on('click', '#addnewtype', function(){
        type_name =  $('#project_type_name').val();
       
        if(type_name === null || type_name === "" ){
            $('.help-type').show();
        }else{
            
            $('.help-type').hide();
            $.ajax({
                type: "post",
                url: "{{url('insert-leave-typemodel')}}",
                data: {"_token": "{{ csrf_token() }}", type_name : type_name },
                dataType:"json",
                success: function(response){
                   
                    ht = '<option value="'+response+'" selected>'+type_name+'</option>' ;
                    $('#add-types').modal('hide');
                    $("#type_id").append(ht) ;
                    $('#project_type_name').val('');
               
                    //if request if made successfully then the response represent the data

                }
            });
        }

    });
</script>
@stop
