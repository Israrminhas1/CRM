@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Leaves Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Leave Report</h2>
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
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <form class="row input-daterange" method="post" action="{{url('report-leave-range')}}">
                            @csrf
                            <div class="form-group c_form_group col-md-3">
                                Employee <br>
                                <select class="form-control single2" name="userid" >
                                    <option value="" > Select Employee</option>
        
                                    @foreach ($users as $user)
                                    @if (isset($dates))
                                    @if($dates['empid']==$user->id)
                                    <option value="{{$user->id}}" selected> {{$user->full_name}}</option>
                                    @else
                                    <option value="{{$user->id}}"> {{$user->full_name}}</option>
                                   @endif
                                 @else
                                   <option value="{{$user->id}}"> {{$user->full_name}}</option>
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
                            </div>
                            <div class="form-group c_form_group col-md-3">
                                To
                                @if(isset($dates))
                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $dates['to'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                @else
                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                            @endif
                            </div>
                            <div class="form-group c_form_group col-md-3 align-self-end">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-round btn-filter" type="submit"  ><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                    <a href="{{url('report-leave')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>
        
                        </form>
                    </div>
        
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-last-exportable" id="a-table">
                        <thead>
                            <tr>
                                <th width="5%" >#</th>
                             
                                <th>Employee</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Is Paid</th>
                                <th>Reason</th>
                                
                                <th>No Of Days</th>
                                {{-- <th>Assign By</th> --}}
                                <th>Assign Date</th>
                              
                              
                              
                              
                        </thead>
                        <tbody>
                            @if($leaves)
                            <?php $index=1; ?>
                            @foreach($leaves as $leave)
                            <tr>
                                <td>{{ $index++}}</td>
                               
                               
                                <td>{{$leave['name']}}</td>
                                <td>{{$leave['start_date']}}</td>
                                <td>{{$leave['end_date']}}</td>
                                <td>{{$leave['is_paid']}}</td>
                                <td>{{$leave['reason']}}</td>
                                <td>{{$leave['no_of_days']}}</td>
                                {{-- <td>{{$leave['assign_by']}}</td> --}}
                                <td>{{$leave['assign_date']}}</td>
                               
                           
                            </tr>
                            @endforeach
                        @else
                        <tr>
                        <td colspan="9" class="align-center">No data available in table</td>
                        </tr>
                        @endif
                        </tbody>
                    
                    
                     
                      

                    </table>
                </div>
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

