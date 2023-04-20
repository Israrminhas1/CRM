@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Users Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Users Report</h2>
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
                        <form class="row input-daterange" method="post" action="{{url('report-users-range')}}">
                            @csrf
                            <div class="form-group c_form_group col-md-4">
                                From
                                @if(isset($dates))
                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $dates['from'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                @else
                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                @endif
                            </div>
                            <div class="form-group c_form_group col-md-4">
                                To
                                @if(isset($dates))
                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $dates['to'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                @else
                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                            @endif
                            </div>
                            <div class="form-group c_form_group col-md-4 align-self-end">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-round" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                    <a href="{{url('report-users')}}" class="btn btn-dark btn-round" ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable " >
                        <thead>
                            <tr>

                              
                                <th width="5%"><strong># </strong></th>
                         
                                <th ><strong>User ID </strong></th>
                                    <th><strong> Name </strong></th>
                                    <th class="numeric"><strong> Email </strong></th>
                                    <th><strong> Role </strong></th>
                                    <th><strong> Created at </strong></th>
                                    {{-- <th width="10%"> Action </th> --}}
                                </tr>
                        </thead>

                        <tbody>
                            @if($users)
                           <?php $index=1; ?>
                            @foreach($users as $user)
                            <tr>
                                
                                <td>{{$index++}}  
                                </td>
                              
                                
                               
                                <td>{{$user->id}}</td>
                                <td>{{$user->uname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->rname}}</td>
                                <td>{{$user->created_at}}</td>
                                {{-- <td class="float-right">
                                   
                                   
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-primary rounded-circle "   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa  fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if(in_array('edit-users', $rights_array))<a href="{{url('edit-users/'.$user->id)}}" class="dropdown-item">
                                                    <i class="fa fa-edit"></i> Edit </a>
                                                @endif
                                                @if(in_array('edit-roles-users', $rights_array))<a href="{{url('edit-roles-users/'.$user->id)}}" class="dropdown-item">
                                                    <i class="fa fa-edit"></i> View/Edit Rights </a>
                                                @endif
                                                @if(in_array('delete-users', $rights_array))<a href="javascript:;" onclick="deleteUser({{$user->id}});" class="dropdown-item ">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
                                                @endif
                                            </div>
                                      
                             
                                    </div>
                                </td> --}}
                            </tr>
                           
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">No Records Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
          <div class="header">
              <h2>Total Users</h2>
          </div>
          <div class="body">
              <div id="apex-basic-bar2"></div>
          </div>
        </div>

    </div>
</div>

@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
@stop
@section('vendor-script')
<script>
    function deleteUser(id)
    {
        if(confirm('Are you sure you want to delete?'))
        {
            window.location.href="{{url('delete-users')}}/"+id;
        }
    }

</script>
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/charts/apex.js') }}"></script>
@stop

@section('page-script')
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@php
  if(isset($users_key)){
    $s_to_json=json_encode((array) $users_key);
  }else{
    $s_to_json = '';
  }
@endphp
<script>
  $(document).ready(function(){

    var fromPHP=<?php echo $s_to_json; ?>;

    bars_key = [];
    bars_val = [];

    $.each(fromPHP, function(key, value) {      
      bars_key.push(key);
      bars_val.push(value);
    });
    

    var options = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false,
            },
        },
        colors: ['#1b6079'],
        grid: {
            yaxis: {
                lines: {
                    show: false,
                }
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        },
        plotOptions: {
            bar: {
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            name: 'Total Users',
            data: bars_val,
        }],
        xaxis: {
            categories: bars_key,
        }
    }

   var chart = new ApexCharts(
        document.querySelector("#apex-basic-bar2"),
        options
    );
    
    chart.render();



  })
</script>
@stop
