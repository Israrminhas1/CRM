@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Attendance Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Monthly Attendance Report</h2>
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
                        <form class="row input-daterange" method="post" action="{{url('report-monthly-attendance')}}">
                            @csrf
                            <div class="form-group c_form_group col-md-3">
                                Employee Status <br>
                                <select class="form-control single2" name="status" >
                                    <option value=""  selected disabled> Select Status</option>
                                    @if(isset($datas))
                                    <option value="active" {{$datas['status'] == "active" ? "selected" : ""}} > Active</option>
                                    <option value="inactive" {{$datas['status'] == "inactive" ? "selected" : ""}}> Inactive</option>
                                    @else
                                    <option value="active" {{old('status') == "active" ? "selected" : ""}} > Active</option>
                                    <option value="inactive" {{old('status') == "inactive" ? "selected" : ""}}> Inactive</option>

                                    @endif
                                 
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
                                    <a href="{{url('report-monthly-attendance')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>
        
                        </form>
                    </div>
        
                </div>
                @if(isset($datas))
                <h6 class="text-center">Monthly Attendance Report of {{  $datas['monthname'] }} {{ $datas['year'] }}</h6>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable js-exportable-new" id="a-table">
                        <thead>
                            @if(isset($ecc['date']))
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Designation</th>
                                <th>Joining Date</th>
                            @foreach ($ecc['date'] as $key => $d)
                                
                         
                           
                                <th width="1%"  class="p-1">{{ $d }} 
                                <br>
                                {{ substr($ecc['day'][$key],0,1)   }}
                                </th>
                            
                              
                              
                        
                            @endforeach
                        </tr>
                              @endif
                        </thead>
                       
                    
                        <tbody>
                            @if(isset($ecc['emp']))
                            <?php $index=1;  ?>
                            @foreach ($ecc['emp'] as $key=> $employ)

                            <tr>
                                <td width="1%"  class="pb-1">{{$index++}}</td>
                                <td width="1%"  class="pb-1"> {{ $ecc['details'][$key]['name'] }}</td>
                                <td width="1%"  class="pb-1"> {{ $ecc['details'][$key]['designation'] }}</td>
                                <td width="1%"  class="pb-1"> {{ $ecc['details'][$key]['joining_date'] }}</td>
                                @foreach ($employ as  $e)
                              
                                @if ($e=='A')
                                            
                                <td width="1%"  class="p-1 text-red">{{ $e }}</td>
                                @else
                                <td width="1%"  class="p-1 text-green" >{{ $e }}</td>
                                    
                                @endif
                             
                                    
                                @endforeach
                            </tr>
                           
                            @endforeach
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

