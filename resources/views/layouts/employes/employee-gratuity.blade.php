@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Employee Gratuity')


@section('content')


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Employee Gratuity</h2>
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
            <div class="table-toolbar">
                <form class=" input-daterange" method="post" action="{{url('employee-gratuity')}}">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                           
                                @csrf
                                <div class="row">
                                    <div class="form-group c_form_group col-md-3">
                                        Employee <br>
                                        <select class="form-control single2" name="employee" >
                                            <option value="" disabled selected> Select Employee</option>

                                            @foreach ($employees as $employee)
                 
                     @if (isset($employ))
                         
                     <option value="{{$employee->id}}" {{old('employee',$employee->id) == $employ->id ? "selected" : ""}}> {{$employee->full_name}}</option>
                     @else
                     <option value="{{$employee->id}}" {{old('employee') == $employee->id ? "selected" : ""}}> {{$employee->full_name}}</option>
                         
                     @endif
                  
                    @endforeach
                                        </select>
                                        @if ($errors->any() && $errors->first('employee'))
                                        <span class="text-danger w-100 small">{{$errors->first('employee')}}</span>
                                    @endif
                                    </div>
                              
                                 

                                    <div class="form-group c_form_group col-md-3 ">
                                        <br>
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-round btn-filter"  type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Calculate</button>
                                            <a href="{{url('employee-gratuity')}}" class="btn btn-dark btn-round btn-filter"   ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>

                                        </div>
                                    </div>

                                </div>
                            
                        </div>
                    </div>

                </div>
            </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                  @if(isset($gratuitys))
                  <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable-gratuity" id="a-table">
                     <thead>
               
                     <tr>
                        <td ><h6>Name</h6></td>
                           
                          
                        <td  >{{ $gratuitys['name']}}</td>
                   
                    </tr>
                </thead>
                    <tbody>
                           
                            <tr>
                                <td ><h6>Designation</h6></td>
                           
                           
                                <td  >{{ $gratuitys['designation']}}</td>
                           
                            </tr>
                            <tr>
                                <td ><h6>Phone</h6></td>
                           
                         
                                <td  >{{ $gratuitys['phone']}}</td>
                           
                            </tr>
                            <tr>
                                <td><h6>Joining Date</h6></td>
                           
                         
                                <td  >{{ $gratuitys['joining_date']}}</td>
                           
                            </tr>
                            <tr>
                                <td ><h6>Ending Date</h6></td>
                           
                          
                                <td  >{{ $gratuitys['ending_date']}}</td>
                           
                          
                                
                            </tr>
                            <tr>
                                <td  ><h6>Years</h6></td>
                                <td  >{{ $gratuitys['years']}}</td>
                            </tr>
                            <tr>
                                <td  ><h6>Amount</h6></td>
                           
                       
                                <td  >{{ $gratuitys['amount']}}</td>
                           
                            </tr>
                        
                            {{-- @foreach($gratuitys as $gratuity)
                            <tr>
                                <td >{{ $index++}}</td>
                               
                                <td >{{ $gratuity['name']}}</td>
                                <td>{{ $gratuity['designation']}}</td>
                                <td>{{ $gratuity['phone']}}</td>
                                <td>{{ $gratuity['joining_date']}}</td>
                                <td>{{ $gratuity['ending_date']}}</td>
                                <td>{{ $gratuity['years']}}</td>
                                <td>{{ $gratuity['amount']}}</td>
                            </tr>
                            @endforeach --}}
                     
                     
                        </tbody>
                   
                    
                     
                      

                    </table>
                  </div>
                    @endif
                </div>
              </div>
          </div>
        </div>
    </div>
</div>

    @stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
@stop
@section('vendor-script')
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@stop

@section('page-script')
<script>
    //  $("#status").trigger("change");
   
    $(document).ready(function() {
        $('.single2').select2({
    theme: "bootstrap" // need to override the changed default
});
    });
</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>

@stop
