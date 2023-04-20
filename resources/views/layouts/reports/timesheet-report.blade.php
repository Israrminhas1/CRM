@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Timesheet Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Timesheet Report</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <div class="body">
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
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form class="row input-daterange" method="post" action="{{url('report-timesheet')}}">
                            @csrf
                            <div class="form-group c_form_group col-md-3">
                                Employee <br>
                                <select class="form-control single2" name="userid" >
                                    <option value=""  selected> All Employees</option>
        
                                    @foreach ($users as $user)
                                    @if (isset($dates))
                                  
                                    <option value="{{$user->id}}" {{$dates['empid'] == $user->id ? "selected" : ""}}> {{$user->full_name}}</option>
                                 @else
                                   <option value="{{$user->id}}" {{old('userid') == $user->id ? "selected" : ""}}> {{$user->full_name}}</option>
                                 @endif
                                    @endforeach
                                </select>
        
                            </div>
                            <div class="form-group c_form_group col-md-3">
                                From
                                @if(isset($dates))
                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $dates['from'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                @else
                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                @endif
                                @if ($errors->any() && $errors->first('start_date'))
                                <span class="text-danger w-100 small">{{$errors->first('start_date')}}</span>
                            @endif
                            </div>
                            <div class="form-group c_form_group col-md-3">
                                To
                                @if(isset($dates))
                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $dates['to'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                @else
                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                            @endif
                            @if ($errors->any() && $errors->first('end_date'))
                            <span class="text-danger w-100 small">{{$errors->first('end_date')}}</span>
                        @endif
                            </div>
                            <div class="form-group c_form_group col-md-3 align-self-end">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-round btn-filter" type="submit"  ><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                    <a href="{{url('report-timesheet')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>
        
                        </form>
                    </div>
        
                </div>
                @if (isset($data))
                    
             
                <div class="table-responsive">
                      <table class="table table-striped table-hover dataTable js-last-exportable" id="a-table">
                          <thead>
                              <tr>
                                  <th width="5%" >#</th>
                               
                                
                                  <th>Employee</th>
                                 
                                  <th>Date</th>
                                 
                                
                                  <th>Clock In</th>
                                  <th>Clock Out</th>
                                  <th>Total Hours</th>
                                
                                
                                
                                
                                
                          </thead>
                          <tbody>
                              @if($data)
                              <?php $index=1; ?>
                              @foreach($data as $d)
                              <tr>
                                  <td>{{ $index++}}</td>
                                 
                               
                                  <td>{{$d['name']}}</td>
                                  <td>{{$d['date']}}</td>
                              
                          
                                  <td>{{$d['clock_in']}}</td>
                                  <td>{{$d['clock_out']}}</td>
                                  <td>{{$d['time']}}</td>
                           
                             
                              </tr>
                              @endforeach
                          @else
                          <tr>
                          <td colspan="7" class="text-center">No Records Found</td>
                          </tr>
                          @endif
                          </tbody>
                       
                      
                       
                        
  
                      </table>
                  </div> 
              </div>
              @endif
            </div>
        </div>
    </div>
</div>


@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/c3/c3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
@stop
@section('vendor-script')
<script>

</script>

<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>
@stop

@section('page-script')
<script> 
    $('.single2').select2({
    width: '100%',
    theme: "bootstrap" // need to override the changed default
});
</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<script src="{{ asset('assets/js/pages/charts/c3.js') }}"></script>
<script src="{{ asset('assets/js/pages/charts/apex.js') }}"></script>


@stop

