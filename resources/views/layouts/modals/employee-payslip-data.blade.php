<style> 




.hiddenRow {
    padding: 0 !important;
}
</style>
<div class="container">
	<div class="col-md-12">
    	<div class="panel panel-default">
				
        <div class="panel-body">
            @if ($data)
                
           
            <div class="table-responsive">
					<table class="table table-condensed ">
    <thead>
        <tr>
					<th>#</th>
          {{-- <th>Payslip#</th> --}}
          <th>Employee ID</th>
          <th>Date</th>
          <th>Approved Salary Monthly</th>
          <th>Total Allowances</th>
          <th>Total Deductions</th>
          <th>Net Salary</th>
          <th></th>
        </tr>
    </thead>

    <tbody>
        
        <?php $count=1; ?>
        @foreach ($data as $d)
      
        <tr data-toggle="collapse" data-target="#demo{{ $count }}" class="accordion-toggle">
            <td><button type="button" class="btn btn-primary">{{ $count }}</button></td>
             {{-- <td><input type="text" name="payslip_no[{{ $d['employee_id'] }}]" class="form-control "  value="{{ $d['payslip_no'] }}" readonly></td> --}}
             <td> <input type="text" name="employee[]" class="form-control"  value="{{ $d['employee_id'] }}" readonly></td>
             <td><input type="text" name="date[{{ $d['employee_id'] }}]" class="form-control"  value="{{ $d['date'] }}" readonly></td>
             <td><input type="text" name="approved_salary[{{ $d['employee_id'] }}]" class="form-control approved_salary_ approved_salary{{ $d['employee_id'] }}"  value="{{ $d['approved_salary'] }}" readonly></td>
             <td>  <input type="text" name="total_allowances[{{ $d['employee_id'] }}]"  class="form-control total_allownces_ total_allownces{{ $d['employee_id'] }}"  value="{{ $d['total_allowances'] }}" readonly>  </td>
             <td><input type="text" name="total_deductions[{{ $d['employee_id'] }}]" class="form-control total_deductions_ total_deductions{{ $d['employee_id'] }}"  value="{{ $d['total_deductions'] }}" readonly></td>
             <td><input type="text" name="net_salary[{{ $d['employee_id']  }}]" class="form-control net_salary_ net_salary{{ $d['employee_id'] }}"  value="{{ $d['net_amount'] }}" readonly></td>
             <td> 
                <button  class="btn btn-sm btn-danger btn_remove remove_payslip_row_">X</button>  
              </td>
         </tr>
             
         <tr>

             <td colspan="12" class="hiddenRow">
                             <div class="accordian-body collapse" id="demo{{ $count }}"> 
           
               <table class="table ">
                     <thead>
                        <tr>
                           <th></th>
                            <th>S.N0</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                     </thead>
                                           
                                             <tbody>
                                                
                                                 <tr > <td rowspan="{{ count($breakup[$d['employee_id']])+1  }}" class="text-center">
                                                    Salary BreakUp
                                                </td> 
                                            </tr>
                                           <?php
                                           
                                            $counting=1; 
                                           
                                           ?>
                                            @foreach ($breakup[$d['employee_id']] as $b)
                                            
                                            <tr >
                                                 
                                                <td>{{ $counting++ }}</td>
                                                <td> <input value="{{ $b['name'] }}  " name="salary_breakup[{{ $d['employee_id'] }}][]" type="text" readonly class="form-control"> </td>
                                              
                                                <td> 
                                                    <?php $breakupamount= $d['approved_salary']*$b['percentage']/100 ?>
                                                    <input value="{{ number_format((float)  $breakupamount, 2, '.', '')}}" name="salary_breakupamount[{{ $d['employee_id'] }}][]" type="text" readonly class="form-control">  
                                                </td>
                                            </tr>
                                            @endforeach
                                           
                                        @if($allow[$d['employee_id']])
                                        <tr class="allownce_main_row_{{ $d['employee_id'] }}"> <td rowspan="{{ count($allow[$d['employee_id']])+1  }}" class="text-center">
                                            Other Allowances
                                        </td> 
                                        </tr>
                                        @foreach ($allow[$d['employee_id']] as $e)
                                            
                                        <tr class="rowz allownce_single_row_{{ $d['employee_id'] }}">
                                             
                                            <td>{{ $counting++ }}</td>
                                            <td><input value="{{ $e['allowance_name'] }}" name="allowance_name[{{ $d['employee_id'] }}][]" type="text" readonly class="form-control">  
                                                 </td>
                                            
                                            <td> 
                                                <input type="text"  data-id="{{ $d['employee_id'] }}" class="form-control allowance_val_ allowance_val_{{ $d['employee_id'] }}" name="allowance_amount[{{ $d['employee_id'] }}][]"  value="{{ number_format((float) $e['allowance_amount'], 2, '.', '')  }}" readonly>   
                                            </td>
                                            <td> 
                                                <button type="button" data-id="{{ $d['employee_id'] }}" data-amount="{{ $e['allowance_amount']}}"  class="btn btn-sm btn-danger btn_remove remove_allownce_row_">X</button>  
                                              </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        @if($deduct[$d['employee_id']])
                                        <tr class="deduction_main_row_{{ $d['employee_id'] }}"> <td rowspan="{{ count($deduct[$d['employee_id']])+1  }}" class="text-center">
                                            Deductions
                                        </td> 
                                        </tr>
                                        @foreach ($deduct[$d['employee_id']] as $e)
                                            
                                        <tr class="rowz deduction_single_row_{{ $d['employee_id'] }}">
                                             
                                            <td>{{ $counting++ }}</td>
                                            <td><input value="{{ $e['deduction_name'] }}" name="deduction_name[{{ $d['employee_id'] }}][]" type="text" readonly class="form-control">   </td>
                                            
                                            <td> 
                                           <input type="text"  data-id="{{ $d['employee_id'] }}" class="form-control deduction_val_ deduction_val_{{ $d['employee_id'] }}" name="deduction_amount[{{ $d['employee_id'] }}][]"  value="{{ number_format((float) $e['deduction_amount'], 2, '.', '')  }}"> 
                                            </td>
                                            <td> 
                                                <button type="button" data-id="{{ $d['employee_id'] }}" data-amount="{{ $e['deduction_amount'] }}"   class="btn btn-sm btn-danger btn_remove remove_deduction_row_">X</button>  
                                              </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        @if($dates[$d['employee_id']])
                                        <tr> <td rowspan="{{ count($dates[$d['employee_id']])+2  }}" class="text-center">
                                        
                                        </td> 
                                        </tr>
                                        <tr class="absent_main_row_{{ $d['employee_id'] }}">    <td>{{ $counting++ }}</td><td >
                                         <strong>Absentism</strong>  
                                        </td> 
                                       <td >
                                        <input type="text" readonly class="form-control total_absent_deduction_emp{{ $d['employee_id'] }}" name="total_absent[{{ $d['employee_id'] }}]"  value="{{ $total_absent[$d['employee_id']] }}"> 

                                        </td> 
                                        </tr>
                                        @foreach ($dates[$d['employee_id']] as $e)
                                            
                                        <tr class="rowz absent_single_row_{{ $d['employee_id'] }}" >
                                             
                                            <td>{{ $counting++ }}</td>
                                            <td><input value="{{ $e['dates'] }}" name="absent_dates[{{ $d['employee_id'] }}][]" type="text" readonly class="form-control">  </td>
                                            
                                            <td> 
                                                <input value="{{ $e['amount'] }}" name="absent_amount[{{ $d['employee_id'] }}][]" type="text" readonly class="form-control deduction_val_{{ $d['employee_id'] }}">
                                            </td>
                                            <td> 
                                                <button type="button"  data-id="{{ $d['employee_id'] }}" data-amount="{{ $e['amount'] }}" class="btn btn-sm btn-danger btn_remove remove_absent_row_">X</button>  
                                              </td>
                                        </tr>
                                        @endforeach
                                        @endif
         
                       </tbody>
                    </table>
               
               </div> 

           </td>
         </tr>
         <?php $count++ ?>
        @endforeach
       
        
    </tbody>
    <tfoot>
        <tr>
           
            <td colspan="3" class="text-right">Total</td>
            <td class="total_monthly_salary "  >
            </td>
            <td class="totals_allownces " > </td>
            <td  class="totals_deductions "  >
            </td>
            <td class="total_net_salary " >
            </td>
           
        </tr>
    </tfoot>
</table>
            </div>
            @else
            <div class="text-center"><h5 style="color: red"> Payslip Already generated for this month </h5> </div>
            @endif
            
            </div>
        
          </div> 
        
      </div>
	</div>
       
