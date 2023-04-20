@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Payroll Report')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Payroll Report</h2>
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
                        <form class="row input-daterange" method="post" action="{{url('report-payroll')}}">
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
                                Month <br>
                                 <select class="form-control single2 custom-select" id="month" name="month" >
                                     <option value="" disabled selected> Select Month</option>
                                     @if(isset($dates))

                                     <option value="01" {{$dates['month'] == "01" ? "selected" : ""}} > Jan</option>
                                     <option value="02" {{$dates['month'] == "02" ? "selected" : ""}} > Feb</option>
                                     <option value="03" {{$dates['month'] == "03" ? "selected" : ""}} > Mar</option>
                                     <option value="04" {{$dates['month'] == "04" ? "selected" : ""}} > Apr</option>
                                     <option value="05" {{$dates['month'] == "05" ? "selected" : ""}} > May</option>
                                     <option value="06" {{$dates['month'] == "06" ? "selected" : ""}} > Jun</option>
                                     <option value="07" {{$dates['month'] == "07" ? "selected" : ""}} > Jul</option>
                                     <option value="08" {{$dates['month'] == "08" ? "selected" : ""}} > Aug</option>
                                     <option value="09" {{$dates['month'] == "09" ? "selected" : ""}} > Sep</option>
                                     <option value="10" {{$dates['month'] == "10" ? "selected" : ""}} > Oct</option>
                                     <option value="11" {{$dates['month'] == "11" ? "selected" : ""}} > Nov</option>
                                     <option value="12" {{$dates['month'] == "12" ? "selected" : ""}} > Dec</option>
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
                                     @if(isset($dates))
                                     <option value="2023" {{($dates['year']) == "2023" ? "selected" : ""}} > 2023</option>
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
                                    <a href="{{url('report-payroll')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                </div>
                            </div>
        
                        </form>
                    </div>
        
                </div>
                @if (isset($payrolls))
                    
             
              <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-last-exportable" id="a-table">
                        <thead>
                            <tr>
                                <th width="5%" >#</th>
                             
                              
                                <th>Employee</th>
                                <th>Designation</th>
                                <th>Date</th>
                               
                              
                                <th>Approved Salary</th>
                                <th>Total Allowances</th>
                                <th>Total Deductions</th>
                                <th>Net Salary</th>
                                <th>Date Issued</th>
                              
                              
                              
                              
                        </thead>
                        <tbody>
                            @if($payrolls)
                            <?php $index=1; ?>
                            @foreach($payrolls as $payroll)
                            <tr>
                                <td>{{ $index++}}</td>
                               
                             
                                <td>{{$payroll->full_name}}</td>
                                <td>{{$payroll->designation}}</td>
                                <td>{{date('M-Y',strtotime($payroll->date.'-01'))}}</td>
                        
                                <td id="{{$payroll->approved_salary}}" class="sumaps">{{$payroll->approved_salary}}</td>
                                <td id="{{$payroll->total_allowances}}" class="sumttl">{{$payroll->total_allowances}}</td>
                                <td id="{{$payroll->total_deductions}}" class="sumddc">{{$payroll->total_deductions}}</td>
                                <td id="{{$payroll->net_amount}}" class="sumnet">{{$payroll->net_amount}}</td>
                                <td >{{$payroll->created_on}}</td>
                           
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
                                <th colspan="1" >
                                 
                                                
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

                                <th colspan="1" >
                                 
                                                
                                </th>
                               
                            </tr>
                        </tfoot>
                    
                     
                      

                    </table>
                </div> 
            </div>
            @endif
        </div>
        @if (isset($payrolls))
            <div class="card">
                <div class="row textcenter">
                <div class="col-md-12">
                    <div class="header">
                    <h2>Payroll</h2>
                    </div>
                    <div class="body dflex justifycontent-center">
                    <div id="payroll-pie"></div>
                    </div>
                </div>
                </div>
            </div>
        @endif
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
<script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>

<script>

   var options = {
      series: [sumddc, sumaps, sumttl],
      chart: {
      width: 450,
      type: 'pie',
    },
    labels: ['Total Deductions ' +  sumddc, 'Approved Salary ' + sumaps, 'Total Allowances ' + sumttl],
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 400
        },
        legend: {
          position: 'bottom'
        }
      }
    }]
    };

    var chart = new ApexCharts(document.querySelector("#payroll-pie"), options);
    chart.render();
  
</script>

@stop

