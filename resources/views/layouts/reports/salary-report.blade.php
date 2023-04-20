@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Salary Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Salary Report</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <div class="body">
                @if(Session::has('errorMsg'))
                    <div class="alert alert-danger alert-dismissible fade show">{{Session::get('errorMsg')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                        <form class="row input-daterange" method="post" action="{{url('report-salary')}}">
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
                                BreakUp Type <br>
                                <select class="form-control single2" name="breakupType" >
                                    <option value=""  selected> All types</option>
        
                                    @foreach ($breakupTypes as $breakupType)
                                    @if (isset($dates))
                                  
                                    <option value="{{  $breakupType->id }}"  {{$dates['type'] ==  $breakupType->id  ? "selected" : ""}}> {{  $breakupType->name }}</option>
                                 @else
                                   <option value="{{  $breakupType->id }}"  {{old('breakupType') ==  $breakupType->id? "selected" : ""}}> {{  $breakupType->name }}</option>
                                 @endif

                                    @endforeach
                                </select>
        
                            </div>
                             <div class="form-group c_form_group col-md-3">
                                Status <br>
                                 <select class="form-control single2 custom-select" id="status" name="status" >
                                     <option value=""  selected> All</option>
                                     @if (isset($dates))
                                  
                                     <option value="active"  {{$dates['status'] ==  "active"   ? "selected" : ""}}> Active</option>
                                     <option value="inactive"  {{$dates['status'] ==  "inactive" ? "selected" : ""}}> Inactive</option>
                                  @else
                                    <option value="active"   {{old('status') ==  "active"  ? "selected" : ""}}> Active</option>
                                    <option value="inactive"  {{old('status') ==  "inactive" ? "selected" : ""}}> Inactive</option>
                                  @endif
                                 
                                    
         
                                  
                                 </select>
                                 
 
                             </div>
                            <div class="form-group c_form_group col-md-3 align-self-end">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-round btn-filter" type="submit"  ><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                    <a href="{{url('report-salary')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>
        
                        </form>
                    </div>
        
                </div>
            @if(isset($payrolls))
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-last-exportable" id="a-table">
                        <thead>
                            <tr>
                                <th width="5%" >#</th>
                             
                              
                                <th>Employee</th>
                                <th>Designation</th>
                        
                              
                                <th>Approved Salary</th>
                                <th>Total Allowances</th>
                                <th>Total Deductions</th>
                                <th>Net Salary</th>
                              
                              
                              
                              
                        </thead>
                        <tbody>
                            @if($payrolls)
                            <?php $index=1; ?>
                            @foreach($payrolls as $payroll)
                            <tr>
                                <td>{{ $index++}}</td>
                               
                             
                                <td>{{$payroll->full_name}}</td>
                                <td>{{$payroll->designation}}</td>
                              
                             
                                <td id="{{$payroll->approved_salary}}" class="sumaps">{{$payroll->approved_salary}}</td>
                                <td id="{{$payroll->total_allowance}}" class="sumttl">{{$payroll->total_allowance}}</td>
                                <td id="{{$payroll->total_deduction}}" class="sumddc">{{$payroll->total_deduction}}</td>
                                <td id="{{$payroll->net_amount}}" class="sumnet">{{$payroll->net_amount}}</td>
                           
                            </tr>
                            @endforeach
                        @else
                        <tr>
                        <td colspan="5">No Records Found</td>
                        </tr>
                        @endif
                        </tbody>
                        <tfoot class="thead-dark">
                           
                            <tr>
                                <th colspan="1"   class="text-center">
                                 
                                                        
                                </th>

                              
                                <th colspan="1"  class="text-center">
                                 
                                                            
                                </th>

                                <th colspan="1"  class="text-center">
                         Total
                                </th>
                             

                     

                                <th colspan="1"  id="sumaps" class="text-center">
                              123123
                                </th>

                                <th colspan="1" id="sumttl" class="text-center">
                                      123
                                </th>

                                <th colspan="1" id="sumddc" class="text-center">
                               12312
                                </th>

                                <th colspan="1" id="sumnet" class="text-center">
                                  12312
                                </th>

                                
                               
                            </tr>
                        </tfoot>
                    
                     
                      

                    </table>
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
var sumgsl = 0;
var sumlvd = 0;
var sumlva = 0;
var sumaps = 0;
var sumttl = 0;
var sumddc = 0;
var sumnet = 0;
$(".sumgsl").each(function(){
        var sumgsls = parseInt($(this).attr('id'));
            if (!isNaN(sumgsls)) {
                sumgsl += sumgsls
        }
    });
$(".sumlvd").each(function(){
        var sumlvds = parseInt($(this).attr('id'));
            if (!isNaN(sumlvds)) {
                sumlvd += sumlvds
        }
    });
$(".sumlva").each(function(){
        var sumlvas = parseInt($(this).attr('id'));
            if (!isNaN(sumlvas)) {
                sumlva += sumlvas
        }
    });
$(".sumaps").each(function(){
        var sumapss = parseInt($(this).attr('id'));
            if (!isNaN(sumapss)) {
                sumaps += sumapss
        }
    });
$(".sumttl").each(function(){
        var sumttls = parseInt($(this).attr('id'));
            if (!isNaN(sumttls)) {
                sumttl += sumttls
        }
    });
$(".sumddc").each(function(){
        var sumddcs = parseInt($(this).attr('id'));
            if (!isNaN(sumddcs)) {
                sumddc += sumddcs
        }
    });
$(".sumnet").each(function(){
        var sumnets = parseInt($(this).attr('id'));
            if (!isNaN(sumnets)) {
                sumnet += sumnets
        }
    });
    $('#sumgsl').text(sumgsl.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('#sumlvd').text(sumlvd.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('#sumlva').text(sumlva.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('#sumaps').text(sumaps.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('#sumttl').text(sumttl.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('#sumddc').text(sumddc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $('#sumnet').text(sumnet.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
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

