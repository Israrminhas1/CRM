@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Employee Status')


@section('content')


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Employee Status</h2>
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
            <form method="post" action="{{url('add-employee-status')}}" enctype="multipart/form-data">
                @csrf
        <div class="row">
            <div class="form-group c_form_group col-md-6 {{(@$errors->any() && $errors->first('employee')) ? 'has-error' : 'has-info'}}">
                Employee <br>
                <select class="form-control single2" name="employee" >
                    <option value="" disabled selected> Select Employee</option>

                    @foreach ($employees as $employee)
                 
                     
                      <option value="{{$employee->id}}" {{old('employee') == $employee->id ? "selected" : ""}}> {{$employee->full_name}}</option>
                  
                    @endforeach
                </select>
                @if ($errors->any() && $errors->first('employee'))
                <span class="text-danger w-100 small">{{$errors->first('employee')}}</span>
            @endif
            </div>
            <div class="form-group c_form_group col-md-6  {{(@$errors->any() && $errors->first('status')) ? 'has-error' : 'has-info'}}">
                Select Status <br>
                <select class="form-control single2" name="status" id="status" onchange="showForm(value)">
                    <option value="" disabled selected> Select Status</option>
 
                 
                     
                      <option value="active" {{old('status') == 'active' ? "selected" : ""}}>Active</option>
                      <option value="inactive"  {{old('status') == 'inactive' ? "selected" : ""}}>Inactive</option>
                      <option value="fired"  {{old('status') == 'fired' ? "selected" : ""}}>Fired </option>
                      <option value="resign"  {{old('status') == 'resign' ? "selected" : ""}}>Resign</option>
                  
             
                </select>
                @if ($errors->any() && $errors->first('status'))
                <span class="text-danger w-100 small">{{$errors->first('status')}}</span>
            @endif
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('document')) ? 'has-error' : 'has-info'}}">
                    <div class="input-group">
                        <label for="form_control_1">Attachment</label>
                      
                        <input type="file" name="document" class="form-control"  value="{{old('document')}}" >
                        @if ($errors->any() && $errors->first('document'))
                            <span class="help-block">{{$errors->first('document')}}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 end-date">
                <div class="form-group c_form_group   {{(@$errors->any() && $errors->first('enddate')) ? 'has-error' : 'has-info'}}">
                    <div class="input-group">
                        <label for="form_control_1">End Date</label>
                        
                        <input type="text" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd"  class="form-control end-date-form"  value="{{old('enddate')}}" placeholder="Enter End Date">
                            @if ($errors->any() && $errors->first('enddate'))
                            <span class="text-danger w-100 small">{{$errors->first('enddate')}}</span>
                        @endif
                    </div>
                </div>
            </div>
         
            <div class="col-md-12">
                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('reason')) ? 'has-error' : 'has-info'}}">
                    <div class="input-group">
                        <label for="form_control_1">Reason</label>
                        
                       <textarea name="reason" id="" class="form-control" ></textarea>
                            @if ($errors->any() && $errors->first('reason'))
                            <span class="text-danger w-100 small">{{$errors->first('reason')}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions noborder">
            <button type="submit" class="btn btn-primary  plain">Submit</button>
            <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-employees')}}')">Cancel</button>
        </div>
    </form>
          </div>
        </div>
    </div>
</div>

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
    //  $("#status").trigger("change");
    $(".end-date").hide();
     $("#status").trigger("change");
  function showForm(n){
   if(n=='fired' || n=='resign'){
$(".end-date").show()
$(".end-date-form").attr("name", "enddate");

   } else {
    $(".end-date").hide()
    $(".end-date-form").removeAttr("name");
   }
  }
    $(document).ready(function() {
        $('.single2').select2({
    theme: "bootstrap" // need to override the changed default
});
    });
</script>
@stop
