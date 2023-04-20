@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage Employees Document')


@section('content')

<!-- Page header section  -->


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Employees Document</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <div class="body">
                @if(Session::has('errorMsg'))
                    <div class="alert alert-danger">{{Session::get('errorMsg')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(Session::has('successMsg'))
                    <div class="alert alert-success">{{Session::get('successMsg')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
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
                    <form role="form" method="post"  enctype="multipart/form-data" action="{{url('add-employees-document')}}" >
                        @csrf
                        <div class="form-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('employee')) ? 'has-error' : 'has-info'}}">
                                    <div class="input-group">
                                        <label for="form_control_1">Employees List</label>
                                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span></div>
                                        <select name="employee" class="form-control single2">
                                            {{-- <option value="{{old('visa_title')}}"  selected="selected">{{!empty(old('visa_title')) ? old('visa_title') : "Select Employe"}}</option>  --}}
                                            <option  value="" disabled selected>Select Employee</option>
                                            @foreach ($employees as $employee)
                                                <option  value="{{$employee->id}}" {{old('employee') == $employee->id ? "selected" : ""}}>{{$employee->full_name}}</option>
                                            @endforeach

                                        </select>

                                            @if ($errors->any() && $errors->first('employee'))
                                            <span class="help-block">{{$errors->first('employee')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('document_type')) ? 'has-error' : 'has-info'}}">
                                    <label for="form_control_1">Document Type</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-chain"></i>
                                        </span></div>
                                        <select name="document_type" class="form-control single2">
                                            {{-- <option value="{{old('visa_title')}}"  selected="selected">{{!empty(old('visa_title')) ? old('visa_title') : "Select Employe"}}</option>  --}}
                                            <option  value="" disabled selected>Select Type</option>
                                            <option value="Emirates ID" {{old('document_type') == 'Emirates ID' ? "selected" : ""}}>Emirates ID</option>
                                            <option value="Passport" {{old('document_type') == 'Passport' ? "selected" : ""}}>Passport</option>
                                            <option value="Visa Page" {{old('document_type') == 'Visa Page' ? "selected" : ""}}>Visa Page</option>
                                            <option value="Employee Contract" {{old('document_type') == 'Employee Contract' ? "selected" : ""}}>Employee Contract</option>
                                            <option value="Medical Insurance" {{old('document_type') == 'Medical Insurance' ? "selected" : ""}}>Medical Insurance</option>
                                            <option value="Driving License" {{old('document_type') == 'Driving License' ? "selected" : ""}}>Driving License</option>
                                            <option value="Other"  {{old('document_type') == 'Other' ? "selected" : ""}}>Other</option>
                                        </select>
                                            @if ($errors->any() && $errors->first('document_type'))
                                            <span class="help-block">{{$errors->first('document_type')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('doc_expiry')) ? 'has-error' : 'has-info'}}">
                                    <label for="form_control_1">Expiry Date</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-calendar-minus-o"></i>
                                        </span></div>
                                        <input name="doc_expiry" type="text"  data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" class="form-control "  value="{{old('doc_expiry')}}" placeholder="Expiry Date">
                                        @if ($errors->any() && $errors->first('doc_expiry'))
                                        <span class="help-block">{{$errors->first('doc_expiry')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('attachments')) ? 'has-error' : 'has-info'}}">
                                    <label for="form_control_1">Attachments</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-file"></i>
                                        </span></div>
                                        <input type="file" name="attachments" class="form-control "  value="{{old('attachments')}}" placeholder="Attachments">
                                            @if ($errors->any() && $errors->first('attachments'))
                                            <span class="help-block">{{$errors->first('attachments')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>





                        </div>
                        <div class="form-actions noborder">
                            <button type="submit" class="btn btn-primary">Submit</button>
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
        function cancelFunction(returl)
        {
            window.location.href = returl;
        }
        $(document).ready(function() {
            $('.single2').select2({
                theme: "bootstrap" // need to override the changed default
            });
        });
    </script>
    @stop
