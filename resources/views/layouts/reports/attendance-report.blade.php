@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Attendance Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Attendance Report</h2>
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
                        <form class="row input-daterange" method="post" action="{{url('report-attendance')}}">
                            @csrf
                            <div class="form-group c_form_group col-md-3">
                                Employee <br>
                                <select class="form-control single2" name="userid" >
                                    <option value=""  selected> All Employees</option>
        
                                    @foreach ($users as $user)
                                    @if (isset($datas))
                                  
                                    <option value="{{$user->id}}" {{$datas['empid'] == $user->id ? "selected" : ""}}> {{$user->full_name}}</option>
                                 @else
                                   <option value="{{$user->id}}" {{old('userid') == $user->id ? "selected" : ""}}> {{$user->full_name}}</option>
                                 @endif
                                    @endforeach
                                </select>
        
                            </div>
                            <div class="form-group c_form_group col-md-3">
                                Month <br>
                                 <select class="form-control single2 custom-select" id="month" name="month" >
                                     <option value="" disabled selected> Select Month</option>
                                     @if(isset($datas))

                                     <option value="01" {{$datas['month'] == "01" ? "selected" : ""}} > Jan</option>
                                     <option value="02" {{$datas['month'] == "02" ? "selected" : ""}} > Feb</option>
                                     <option value="03" {{$datas['month'] == "03" ? "selected" : ""}} > Mar</option>
                                     <option value="04" {{$datas['month'] == "04" ? "selected" : ""}} > Apr</option>
                                     <option value="05" {{$datas['month'] == "05" ? "selected" : ""}} > May</option>
                                     <option value="06" {{$datas['month'] == "06" ? "selected" : ""}} > Jun</option>
                                     <option value="07" {{$datas['month'] == "07" ? "selected" : ""}} > Jul</option>
                                     <option value="08" {{$datas['month'] == "08" ? "selected" : ""}} > Aug</option>
                                     <option value="09" {{$datas['month'] == "09" ? "selected" : ""}} > Sep</option>
                                     <option value="10" {{$datas['month'] == "10" ? "selected" : ""}} > Oct</option>
                                     <option value="11" {{$datas['month'] == "11" ? "selected" : ""}} > Nov</option>
                                     <option value="12" {{$datas['month'] == "12" ? "selected" : ""}} > Dec</option>
                                     @else

                                     <option value="01" {{old('month') == "01" ? "selected" : ""}} > Jan</option>
                                     <option value="02" {{old('month') == "02" ? "selected" : ""}} > Feb</option>
                                     <option value="03" {{old('month') == "03" ? "selected" : ""}} > Mar</option>
                                     <option value="04" {{old('month') == "04" ? "selected" : ""}} > Apr</option>
                                     <option value="05" {{old('month') == "05" ? "selected" : ""}} > May</option>
                                     <option value="06" {{old('month') == "06" ? "selected" : ""}} > Jun</option>
                                     <option value="07" {{old('month') == "07" ? "selected" : ""}} > Jul</option>
                                     <option value="08" {{old('month') == "08" ? "selected" : ""}} > Aug</option>
                                     <option value="09" {{old('month') == "09" ? "selected" : ""}} > Sep</option>
                                     <option value="10" {{old('month') == "10" ? "selected" : ""}} > Oct</option>
                                     <option value="11" {{old('month') == "11" ? "selected" : ""}} > Nov</option>
                                     <option value="12" {{old('month') == "12" ? "selected" : ""}} > Dec</option>
                                     @endif
                                     
         
                                 </select>
                                 @if ($errors->any() && $errors->first('month'))
                                 <span class="text-danger w-100 small">{{$errors->first('month')}}</span>
                             @endif
 
                             </div>
                             <div class="form-group c_form_group col-md-3">
                                Year <br>
                                 <select class="form-control single2 custom-select" id="year" name="year" >
                                     <option value="" disabled selected> Select Year</option>
                                     @if(isset($datas))
                                     <option value="2023" {{($datas['year']) == "2023" ? "selected" : ""}} > 2023</option>
                                     @else
                                     <option value="2023" {{old('year') == "2023" ? "selected" : ""}} > 2023</option>

                                     @endif
                                    
         
                                  
                                 </select>
                                 @if ($errors->any() && $errors->first('year'))
                                 <span class="text-danger w-100 small">{{$errors->first('year')}}</span>
                             @endif
 
                             </div>
                            <div class="form-group c_form_group col-md-3 align-self-end">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-round btn-filter" type="submit"  ><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                    <a href="{{url('report-attendance')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>
        
                        </form>
                    </div>
        
                </div>
                @if(isset($rowspan))
                <h6 class="text-center">Attendance Summary Report of {{  $rowspan['month'] }} {{ $datas['year'] }}</h6>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-last-exportable" id="a-table">
                        <thead>
                            <tr>
                                <th width="5%" >#</th>
                             
                                <th>Employee</th>
                                <th>Designation</th>
                                <th>Month Days</th>
                                <th>Off Days</th>
                                <th>Working Days</th>
                                
                                <th>Present</th>
                                <th>Leaves</th>
                                <th>Absent</th>
                              
                              
                              
                              
                        </thead>
                       
                    
                        <tbody>
                            @if(isset($finaldata))
                            <?php $index=1; ?>
                            @foreach($finaldata as $f)
                            <tr>
                                <td>{{ $index++}}</td>
                               
                             
                                <td>{{$f['name']}}</td>
                                <td>{{$f['designation']}}</td>
                                <td >{{$f['monthdays']}}</td>
                                <td >{{$f['offdays']}}</td>
                                <td >{{$f['workingdays']}}</td>
                                <td >{{$f['present']}}</td>
                                <td >{{$f['leave']}}</td>
                                <td >{{$f['absent']}}</td>
                           
                            </tr>
                            @endforeach
                        @else
                        <tr>
                        <td colspan="10" class="text-center">No Records Found</td>
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

