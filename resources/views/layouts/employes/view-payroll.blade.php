@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Payslip')


@section('content')

<!-- Page header section  -->
<div class="block-header">
    <div class="row clearfix">
        <div class="col-xl-5 col-md-5 col-sm-12">
            <h1>Employee Payslip</h1>
           
        </div>
        <div class="col-xl-7 col-md-7 col-sm-12 text-md-right">
           
            <button onclick="PrintPayslipDetails({{ $payrolls->payslip_no }})"  class="btn btn-primary theme-bg btn-round plain text-white">Print</button>
          
        </div>
    </div>
</div>
<div id="printit" class="row clearfix">

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
                                <td>{{number_format((float) $breakup['amount'], 2, '.', '') }}</td>
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

                              
                               
                                <td colspan="3" class="text-right"><strong>Total Approved Salary</strong></td>
                                <td>{{number_format((float) $payrolls->approved_salary, 2, '.', '')  }}</td>
                            </tr>
                            @if ($data['allowance'])
                            <tr>

                                <th rowspan="{{ $rowspan['allow_count'] }}" class="text-center"><h4>Total Allowances</h4></th>
                              

                            </tr>

                           
                            @foreach ($data['allowance'] as $allowance)
                            <tr>
                                <td>{{ $index++ }}</td>
                           
                                <td>{{ $allowance['name'] }}</td>
                                <td>{{number_format((float)  $allowance['amount'], 2, '.', '')  }}</td>
                            </tr>
                            @endforeach
                            <tr>
                            <td colspan="2" class="text-right"><strong>Total Allowances</strong></td>
                            <td>{{ number_format((float) $payrolls->total_allowances, 2, '.', '') }}</td>
                        </tr>


                            @endif
                               

                              
                               
                              
                           
                            <tr>

                                <th rowspan="{{ $rowspan['deduct_count'] }}" class="text-center"><h4>Total Deductions</h4></th>
                              

                            </tr>
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>Leaves Deductions</td>
                                <td>{{ number_format((float) $payrolls->total_leave_deduction, 2, '.', '')    }}</td>
                            </tr>
                            @if ($data['deduction'])
                            @foreach ($data['deduction'] as $deduction)
                            <tr>
                                <td>{{ $index++ }}</td>
                           
                                <td>{{ $deduction['name'] }}</td>
                                <td>{{number_format((float) $deduction['amount'], 2, '.', '')   }}</td>
                            </tr>
                            @endforeach
                                
                            @endif
                            <tr>

                                <th rowspan="{{ $rowspan['absent_count'] }}" class="text-center"></th>
                                
                              

                            </tr>
                            <tr>

                               
                                <th colspan="2" class="text-center">Absents</th>
                              

                            </tr>
                            {{-- <tr>

                                <th class="text-center"><h4>Total absents</h4></th>
                              

                            </tr> --}}
                           
                            @if ($data['absent'])
                            @foreach ($data['absent'] as $absent)
                            <tr>
                                <td>{{ $index++ }}</td>
                           
                                <td>{{ $absent['date'] }}</td>
                                <td>{{number_format((float)  $absent['amount'], 2, '.', '')  }}</td>
                            </tr>
                            @endforeach
                                
                            @endif
                            <tr>

                              
                               
                                <td colspan="3" class="text-right"><strong>Total Deductions</strong></td>
                                <td>{{number_format((float)  $payrolls->total_deductions, 2, '.', '')   }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong> Net Salary</strong></td>
                                <td>{{ number_format((float)  $payrolls->net_amount, 2, '.', '')  }}</td>
                            </tr>
                                    </tbody>
                        

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
@stop
@section('vendor-script')

<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@stop

@section('page-script')
<script>
function PrintPayslipDetails(n){
    
     
      var divContents = document.getElementById("printit").innerHTML;
      let url = "{{ url('print-payslip') }}"+"/"+n;
      let printWindow = window.open(url, 'Print', 'width=1200,height=700');
      printWindow.addEventListener('load', function() {
        printWindow.print();
      }, true);
    //   a.document.write('<html>');
    //         a.document.write('<body > <h1>Div contents are <br>');
    //         a.document.write(divContents);
    //         a.document.write('</body></html>');
    //         a.document.close();
    //         a.print();
    }
</script>
@stop
