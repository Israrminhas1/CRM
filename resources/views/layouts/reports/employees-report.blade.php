@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Employees Report')


@section('content')


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Employees Report</h2>
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
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <form class=" input-daterange" method="post" action="{{url('rate-range')}}">
                                @csrf
                                <div class="row">
                                    <div class="form-group c_form_group col-md-3">
                                        Employee <br>
                                        <select class="form-control single2" name="userid" >
                                            <option value="" disabled selected> Select Employee</option>

                                            @foreach ($users as $user)
                                           @if (isset($userdata))
                                               @if($userdata['userid']==$user->id)
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
                                        @if(isset($userdata))
                                        <input class="form-control" type="text" data-provide="datepicker" value="{{ $userdata['from'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                        @else
                                        <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                        @endif                                            </div>
                                    <div class="form-group c_form_group col-md-3">
                                        To
                                        @if(isset($userdata))
                                        <input class="form-control" type="text" data-provide="datepicker" value="{{ $userdata['to'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                        @else
                                        <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                    @endif

                                    </div>
                                    <div class="form-group c_form_group col-md-3 ">
                                        <br>
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-round btn-filter"  type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                            <a href="{{url('report-employees')}}" class="btn btn-dark btn-round btn-filter"   ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable" id="a-table">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Employee Id</th>
                                <th>Name</th>
                                <th>Mobile Phone</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th>Joining Date</th>
                                <th>Active</th>
                                
                                {{-- <th width="10%">Action</th> --}}
                        </thead>

                        <tbody>
                            @if($employees)
                            <?php $index=1; ?>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$index++}} 
                                </td>
                    
                                <td>{{$employee->id}}</td>
                                <td>{{$employee->full_name}}</td>
                                <td>{{$employee->mobile_phone}}</td>
                                <td >{{$employee->emp_address}}</td>
                                <td>{{$employee->salary}}</td>
                                <td>{{$employee->joining_date}}</td>
                                <td >
                                    @if ($employee->is_deleted =='N')
                                       <span class="badge badge-success"> {{ "YES" }}</span>
                                   @else
                                   <span class="badge badge-warning"> {{ "NO" }}</span>
                                    @endif
                                    </td>
                                {{-- <td>@if(in_array('edit-employees', $rights_array))<a href="{{url('edit-employees/'.$employee->id)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>&nbsp;&nbsp;@endif @if(in_array('edit-roles-employees', $rights_array))<a href="{{url('edit-roles-employees/'.$employee->id)}}" class="btn btn-outline btn-circle btn-sm green"><i class="fa fa-edit"></i> View/Edit Rights </a>&nbsp;&nbsp;@endif @if(in_array('delete-employees', $rights_array))<a href="javascript:;" onclick="deleteemployee({{$employee->id}});" class="btn btn-outline btn-circle dark btn-sm black">
                                                <i class="fa fa-trash-o"></i> Delete </a>@endif</td>
                                </tr> --}}
                                {{-- <td class="float-right">
                                    <div class="btn-group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary rounded-circle "   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa  fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                        @if(in_array('edit-employees/', $rights_array))
                                        <a href="{{url('edit-employees/'.$employee->id)}}" class="dropdown-item "><i class="fa fa-edit"></i> Edit </a>
                                       @endif
                                       @if(in_array('view-employees-document/', $rights_array))  
                                            <a href="{{url('view-employees-document/'.$employee->id)}}" class="dropdown-item"><i class="fa fa-file"></i> Documents </a>
                                        @endif
                                        @if(in_array('delete-employee/', $rights_array))  
                                        <a href="javascript:;" onclick="deleteemployee({{$employee->id}});" class="dropdown-item" >
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
        
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Rate of Employee Joining This Year</h2>
            </div>
            <div class="body">
                <div id="chart-bar2" style="height: 300px"></div>
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
    function deleteemployee(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {
                window.location.href="{{url('delete-employee')}}/"+id;
            }
        }
        $(document).ready(function() {
        $('.single2').select2({
    width: '100%',
    theme: "bootstrap" // need to override the changed default
});
    });
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
 
 
    
   $.ajax({
    type: "get",
     url: "rate-employee",

    dataType: "json",
  
   
    success: function(response) {
       
     
        var myvalues=['data1'];
        
    myvalues.push(response["1"]);
    myvalues.push(response["2"]);
    myvalues.push(response["3"]);
    myvalues.push(response["4"]);
    myvalues.push(response["5"]);
    myvalues.push(response["6"]);
    myvalues.push(response["7"]);
    myvalues.push(response["8"]);
    myvalues.push(response["9"]);
    myvalues.push(response["10"]);
    myvalues.push(response["11"]);
    myvalues.push(response["12"]);
    



console.log(myvalues);
    

     

c3.generate({
    bindto: '#chart-bar2', // id of chart wrapper
    data: {
        columns: [
            // each columns data
            myvalues
            
          
        ],
        type: 'bar', // default type of chart
        colors: {
            'data1': '#61bda1',
           
        },
        names: {
            // name of each serie
            'data1': 'No of Employees',
            
        }
     
    },
    axis: {
        y: {
            tick: {
                values: [1, 2, 3,4,5,6,7,8,9]
    }
  },
        x: {
            type: 'category',
            // name of each category
            categories: ['Jan','Feb','Mar','April','May','June','July','Aug','Sep','Oct','Nov','Dec']
        },
    },
    bar: {
        width: 16
    },
    legend: {
        show: true, //hide legend
    },
    padding: {
        bottom: 20,
        top: 0
    },
});

    }
});



</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<script src="{{ asset('assets/js/pages/charts/c3.js') }}"></script>
<script src="{{ asset('assets/js/pages/charts/apex.js') }}"></script>


@stop

