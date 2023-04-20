<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/animate-css/vivify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/mooli.min.css') }}">

<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ui/dialogs.js') }}"></script>
<style>
table, tr, td{
  
  border: 1px solid #000;
  border-collapse: collapse;
}
.table tr td, .table tr th {
   
    border-color: black!important;
    
}
.table td, .table th {
    padding: 0.25rem!important;
   
}

</style>
</head>
<body>
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-xl-5 col-md-5 col-sm-12">
                <img  src="{{ asset('assets/images/Maintenance-logo-black.png') }}"  style="max-height: 100px;
                max-width: 300px;
                "   >
               
            </div>
           
        </div>
    </div>
    <div  class="row clearfix" style="padding-left: 72px;padding-right: 72px;">
    
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Payslip</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table  ">
                            <thead>
                                <tr>
    
                                    <th><strong>Employee Name:</strong></th>
                                    <td>{{ $payrolls->full_name }}</td>
                                    <th><strong>Month:</strong></th>
                                    <td>{{ $rowspan['month'] }}</td>
    
                                <tr>
                                <tr>
    
                                    <th><strong>Employee id:</strong></th>
                                    <td>{{ $payrolls->employee_id }}</td>
                                    <th><strong>Designation:</strong></th>
                                    <td>{{ $payrolls->designation }}</td>
                                <tr>
                                <tr>
    
                                    <th><strong>Joining Date:</strong></th>
                                    <td>{{ $payrolls->joining_date}}</td>
                                    <th><strong>Payslip No:</strong></th>
                                    <td>{{ $payrolls->payslip_no}}</td>
                                <tr>
                            
    
                            </thead>
    
                        </table>
                    </div>
                    <br>
                    <hr>
                    <div class="table-responsive">
                        <table class="table  ">
                            <thead>
                                <tr>
    
                                    <th>Employee Name:</th>
                                    <td>{{ $payrolls->full_name }}</td>
                                    <th>Month:</th>
                                    <td>{{ $rowspan['month'] }}</td>
    
                                <tr>
                                <tr>
    
                                    <th>Employee id:</th>
                                    <td>{{ $payrolls->employee_id }}</td>
                                    <th>Designation:</th>
                                    <td>{{ $payrolls->designation }}</td>
                                <tr>
                                <tr>
    
                                    <th>Joining Date:</th>
                                    <td>{{ $payrolls->joining_date}}</td>
                                    <th>Payslip No:</th>
                                    <td>{{ $payrolls->payslip_no}}</td>
                                <tr>
                            
    
                            </thead>
    
                        </table>
                    </div>
                    <br>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                                <tr> 
    <th></th>
    <th>S.No</th>
    <th>Title</th>
    <th>Amount</th>
                                
    
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <?php $index=1; ?>
                                    <th rowspan="{{ $rowspan['breakup_count'] }}" class="text-center"><h4>Salary Breakup</h4></th>
                              
    
                                </tr>
                                @if ($data['salarybreakup'])
                                @foreach ($data['salarybreakup'] as $breakup)
                                <tr>
                                    <td>{{ $index++ }}</td>
                               
                                    <td>{{ $breakup['name']}}</td>
                                    <td>{{ number_format((float)  $breakup['amount'], 2, '.', '')  }}</td>
                                </tr>
                                @endforeach
                            @endif
                                    {{-- <tr>
                                        <td>{{ $index++ }}</td>
                                   
                                        <td>Gross Salary</td>
                                        <td>{{ $payrolls->gross_salary }}</td>
                                    </tr>
                                <tr>
                                    <td>{{ $index++ }}</td>
                                   
                                    <td>Leaves Deduction</td>
                                    <td>{{ $payrolls->total_leave_deduction }}</td>
                                </tr>
                                <tr>
    
                                    <td>{{ $index++ }}</td>
                                   
                                    <td>Absents Deduction</td>
                                    <td>{{ $payrolls->total_absent_deduction }}</td>
                                </tr> --}}
                                <tr>
    
                                  
                                   
                                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                                    <td>{{ $payrolls->approved_salary }}</td>
                                </tr>
                                @if ($data['allowance'])
                                <tr>
    
                                    <th rowspan="{{ $rowspan['allow_count'] }}" class="text-center"><h4>Total Allowances</h4></th>
                                  
    
                                </tr>
    
                               
                                @foreach ($data['allowance'] as $allowance)
                                <tr>
                                    <td>{{ $index++ }}</td>
                               
                                    <td>{{ $allowance['name'] }}</td>
                                    <td>{{ number_format((float) $allowance['amount'], 2, '.', '') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                <td colspan="2" class="text-right"><strong>Total</strong></td>
                                <td>{{ number_format((float) $payrolls->total_allowances, 2, '.', '')}}</td>
                            </tr>
    
    
                                @endif
                                   
    
                                  
                                   
                                  
                               
                                <tr>
    
                                    <th rowspan="{{ $rowspan['deduct_count'] }}" class="text-center"><h4>Total Deductions</h4></th>
                                  
    
                                </tr>
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>Total Leaves Deductions</td>
                                    <td>{{ number_format((float) $payrolls->total_leave_deduction, 2, '.', '')  }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $index++ }}</td>
                               
                                    <td>Total Absent Deductions</td>
                                    <td>{{ number_format((float) $payrolls->total_absent_deduction, 2, '.', '') }}</td>
                                </tr>
                                @if ($data['deduction'])
                                @foreach ($data['deduction'] as $deduction)
                                <tr>
                                    <td>{{ $index++ }}</td>
                               
                                    <td>{{ $deduction['name'] }}</td>
                                    <td>{{ number_format((float) $deduction['amount'], 2, '.', '') }}</td>
                                </tr>
                                @endforeach
                                    
                                @endif
                               
                              
                                {{-- <tr>
    
                                    <th class="text-center"><h4>Total absents</h4></th>
                                  
    
                                </tr> --}}
                               
                               
                             
                              
                                <tr>
    
                                  
                                   
                                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                                    <td>{{ $payrolls->total_deductions }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong> Net Salary</strong></td>
                                    <td>{{number_format((float) $payrolls->net_amount, 2, '.', '')   }}</td>
                                </tr>
                                        </tbody>
                            
    
                        </table>
                    </div>
                </div>
    
                <div style="width: 100%!important;margin-top: 10px!important;">
                
                    <span><b style="font-size: 16px!important;">Note:</b>&nbsp; This is a computer generated payslip,it does not require any signature or stamp.</span>
          
                  </div>
            </div>
        </div>
    </div>
    
</body>
</html>




<!-- Page header section  -->








