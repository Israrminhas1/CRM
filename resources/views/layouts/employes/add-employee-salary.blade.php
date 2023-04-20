@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Payslip')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
         
            <div class="body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="post" action="{{url('add-employee-salary')}}" >
                    @csrf
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group c_form_group {{(@$errors->any() && $errors->first('employee_id')) ? 'has-error' : 'has-info'}} ">
                        <div class="input-group">
                            <label for="form_control_1">Select Employee</label>
                           
                            <select class="form-control" id="employee_name" name="employee_id" onchange="getSalary(value)" >
                                <option value="" disabled selected>Select Employee </option>
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id}}" {{old('employee_id') == $employee->id ? "selected" : ""}}>{{$employee->full_name}}</option>

                                @endforeach

                            </select>
                        </div>
                        @if ($errors->any() && $errors->first('employee_id'))
                        <span class="text-danger w-100 small">{{$errors->first('employee_id')}}</span>
                    @endif
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group c_form_group {{(@$errors->any() && $errors->first('basic_salary')) ? 'has-error' : 'has-info'}}">
                        <div class="input-group">
                            <label for="form_control_1">Basic Salary</label>
                            
                            <input type="number" name="basic_salary" id="basic_salary" class="form-control"  value="{{old('basic_salary','0')}}" placeholder="Basic Salary E.g 5000">
                                @if ($errors->any() && $errors->first('basic_salary'))
                                    <span class="text-danger w-100 small">{{$errors->first('basic_salary')}}</span>
                                @endif
                        </div>
                    </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Percentage</th>
                            <th>Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody id="BreakUp_titles">
                        <tr >
                            <td rowspan="5"><h2>Salary Breakup</h2></td>
                        </tr>
                        {{-- <tr>
                            <td scope="row">Basic Salary</td>
                            <td></td>
                            <td ><input type="number" id='basic_salarytable'  readonly value="0"  class="form-control name_list" /></td>
                     
                        </tr>
                        <tr>
                            <td scope="row">Leaves Deduction</td>
                            <input type="hidden" id="leavesdc" name="leaves" value="0"   class="form-control name_list" />
                            <td id="leavesd"></td>
                            <td ><input type="number" id="leavescalc" name="leave_deductions"  value="0"  readonly class="form-control name_list" /></td>
                     
                        </tr>
                        <tr>
                            <td scope="row">Absents Deduction</td>
                            <input type="hidden" id="absentsdc" name="absents"  value="0"   class="form-control name_list" />
                            <td id="absentsd"></td>
                            <td ><input type="number" id="absentscalc" name="absent_deductions" readonly value="0"  class="form-control name_list" /></td>
                   
                        </tr>
                        <tr>
                            <td scope="row">Total</td>
                            <td></td>
                            <td ><input type="number" id="totalcalc" readonly  value="0"  class="form-control name_list" /></td>
                   
                        </tr> --}}
                       
                       
                    </tbody>
                </table>
            </div>
              
              <div action="#" class="mt-repeater form-horizontal">
                <div class="caption font-red-sunglo">
                    <span class="caption-subject bold uppercase ">Allowances</span>
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            {{-- <th style="width: 20% !important;">Items</th> --}}
                            <th style="width: 24% !important;">Allowance Type</th>
                            <th style="width: 20% !important;">Amount</th>
                            
                            <th style="width: 10% !important;">Action</th>
                        </tr>
                        <tr>
                            <td>
                                <select   id="workers-1" class="form-control name_list basic-single">
                                    <option value=""  disabled selected>Select Allowance </option>
                                    @foreach ($allowances as $allowance)
                                    
                                    <option value="{{ $allowance->id }}"   >{{ $allowance->name }}</option>
                                    
                                    @endforeach
                                
                                </select>
                                <span class="help-block help-block-error text-danger help-allowance"> This Field Is Required</span>

                            </td>
                            <td><input type="number" id="allowamount-1"  value="0"  class="form-control name_list" />
                                <span class="help-block help-block-error text-danger help-allowanceamount"> This Field Is Required</span>

                            </td>
                           
                            
                            <td><button type="button" name="add" id="add" class="btn btn-primary" >Add</button></td>
                        </tr>
                        <tfoot>
                            <td colspan="2"></td>
                            <td colspan="1">Total:<input type="text" id="allowtotal"  value="0"  class="form-control name_list" readonly /></td>
                        </tfoot>
                    </table>
                </div>
            </div>
       
            <div action="#" class="mt-repeater form-horizontal">
                <div class="caption font-red-sunglo">
                    <span class="caption-subject bold uppercase ">Deductions</span>
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamic_field2">
                        <tr>

                            <th style="width: 24% !important;">Deduction Type</th>
                            <th style="width: 20% !important;">Amount</th>
                           
                            <th style="width: 10% !important;">Action</th>
                        </tr>
                        <tr>
                            <td>
                                <select  id="deduction-1" class="form-control basic-expense">
                                    <option value=""  disabled selected >Select Deduction </option>
                                    @foreach ($deductions as $deduction)
                                    
                                    <option value="{{ $deduction->id }}" >{{ $deduction->name }}</option>
                                    
                                    @endforeach
                                </select>
                                <span class="help-block help-block-error text-danger help-deduction"> This Field Is Required</span>

                            </td>
                            <td><input type="number" id="deductamount-1"  value="0"  class="form-control name_list" />
                                <span class="help-block help-block-error text-danger help-deductionamount"> This Field Is Required</span>

                            </td>
                            

                            <td><button type="button" name="add" id="addexpense" class="btn btn-primary" >Add</button></td>
                        </tr>
                        <tfoot>
                            <td colspan="2"></td>
                            <td colspan="1">Total:<input type="text" id="allowdeducttotal"  value="0"  class="form-control name_list" readonly/></td>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 ml-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('sub_total')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;text-align: -webkit-right;">
                                <div class="input-group"  style="padding-top: 15px;">

                                        Sub Total

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('sub_total')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;">
                                <div class="input-group">

                                    <input type="number" name="sub_total" id="sub_total" class="form-control"  value="{{old('sub_total','0')}}" readonly style="text-align: end">

                                        @if ($errors->any() && $errors->first('sub_total'))
                                        <span class="help-block">{{$errors->first('sub_total')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('allowance_charges')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;text-align: -webkit-right;">
                                <div class="input-group"  style="padding-top: 15px;">

                                        Total Allowances

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('allowance_charges')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;">
                                <div class="input-group">

                                    <input readonly type="number" id="allowance_charges" name="allowance_charges" class="form-control"  value="{{old('allowance_charges','0')}}"  style="text-align: end">

                                        @if ($errors->any() && $errors->first('allowance_charges'))
                                        <span class="help-block">{{$errors->first('allowance_charges')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('shipping_charges')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;text-align: -webkit-right;">
                                <div class="input-group"  style="padding-top: 15px;">

                                        Total Deductions

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('deduction_charges')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;">
                                <div class="input-group">

                                    <input readonly type="number" id="deduction_charges" name="deduction_charges" class="form-control"  value="{{old('deduction_charges','0')}}"  style="text-align: end">

                                        @if ($errors->any() && $errors->first('deduction_charges'))
                                        <span class="help-block">{{$errors->first('deduction_charges')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('total_amount')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;text-align: -webkit-right;">
                                <div class="input-group" style="padding-top: 15px;">

                                        Net Salary

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  {{(@$errors->any() && $errors->first('net_salary')) ? 'has-error' : 'has-info'}} " style="margin: 0px;padding: 0px;">
                                <div class="input-group">

                                    <input type="number" name="net_salary" id="net_salary" class="form-control"  value="{{old('net_salary','0')}}"  style="text-align: end" readonly>

                                        @if ($errors->any() && $errors->first('net_salary'))
                                        <span class="help-block">{{$errors->first('net_salary')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  




                  
                    <div class="form-actions noborder">
                        <button type="submit" class="btn btn-primary  plain">Submit</button>
                        <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-salary')}}')">Cancel</button>
                    </div>
               
                </form>
             
            </div>
        </div>
    </div>
</div>
       {{-- model start  --}}
       <div class="modal fade" id="add-worker" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Allowance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group c_form_group has-info">
                                <div class="input-group">
                                    <label for="form_control_1">Allowance Name</label>
                                  
                                    <input type="text"  id="allowance_name" name="allowance_name"  class="form-control"  placeholder="Allowance Name">
                                    <span class="help-block help-block-error text-danger help-type"> This Field Is Required</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green btn-primary" id="addnew-worker">Add</button>
                    <button type="button" class="btn dark btn-dark" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- model end  --}}

        {{-- model start  --}}
    <div class="modal fade" id="add-expense" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Deduction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group c_form_group has-info">
                                <div class="input-group">
                                    <label for="form_control_1">Deduction Name</label>
                                   
                                    <input type="text"  id="deduction_name" name="deduction_name"  class="form-control"  placeholder="Deduction Name">
                                    <span class="help-block help-block-error text-danger help-expense"> This Field Is Required</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addnew-expense">Add</button>
                    <button type="button" class="btn dark btn-dark" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- model end  --}}
 
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
    function cancelFunction(returl)
        {
            window.location.href = returl;
        }
        wrk_id =null;
        total_salary=0;
        net_salary=0;
    $('.help-type').hide();
    $('.help-expense').hide();
    $('#employee_name').select2();
    console.log('working');
    $('#workers-1').select2().on('select2:open', () => {
        $('#select2-workers-1-results').parent(".select2-results:not(:has(a))").append('<a class=" btn btn-dark" data-toggle="modal" href="#add-worker" title="Add Project Types" id="addnewworkers" style="width: -webkit-fill-available;"><strong>Add Allowance Type</strong></a>') ;
				});
     $('#project_id').select2();
    $(document).on('click', '#addnewworkers', function(){
        $('#workers-1').select2("close");


        });
        
    $(document).on('click', '#addnew-worker', function(){
        allowance_name =  $('#allowance_name').val();
        if(allowance_name === null || allowance_name === "" ){
            $('.help-type').show();
        }else{
            $('.help-type').hide();
            $.ajax({
                type: "post",
                url: "{{url('insert-allowance-model')}}",
                data: {"_token": "{{ csrf_token() }}", allowance_name : allowance_name},
                dataType:"json",
                success: function(response){
                  console.log(response);
                  wrk_id = response;
                    ht = '<option value="'+response+'" selected>'+allowance_name+'</option>' ;
                    
                    $('#add-worker').modal('hide');
                    $("#workers-1").append(ht) ;
                    $('#allowance_name').val('');
                    $("#workers-1").val(response).trigger("change");
                    //if request if made successfully then the response represent the data

                }
            });
        }

    });

    $('#deduction-1').select2().on('select2:open', () => {
        $('#select2-deduction-1-results').parent(".select2-results:not(:has(a))").append('<a class=" btn btn-dark" data-toggle="modal" href="#add-expense" title="Add Project Types" id="addnewexpense" style="width: -webkit-fill-available;"><strong>Add Deduction Type</strong></a>') ;
				});
    $(document).on('click', '#addnewexpense', function(){
        $('#deduction-1').select2("close");


        });
        $(document).on('click', '#addnew-expense', function(){
        deduction_name =  $('#deduction_name').val();
        if(deduction_name === null || deduction_name === "" ){
            $('.help-expense').show();
        }else{
            $('.help-expense').hide();
            $.ajax({
                type: "post",
                url: "{{url('insert-deduction-model')}}",
                data: {"_token": "{{ csrf_token() }}", deduction_name : deduction_name},
                dataType:"json",
                success: function(response){
                    exp_id = response;
                    hts = '<option value="'+response+'" selected>'+deduction_name+'</option>' ;
                   
                    $('#add-expense').modal('hide');
                    $("#deduction-1").append(hts);
                    $('#deduction_name').val('');
                    $("#deduction-1").val(response).trigger("change");
                    //if request if made successfully then the response represent the data

                }
            });
        }

    });
    totaldeductamount=0
    totalamount=0
    
    $("#basic_salary").keyup(function(){
     
        net_salary=0;
        total_salary=0;
    salary=$("#basic_salary").val();
    
    
    total_salary=salary;
    net_salary=net_salary+total_salary-totaldeductamount+totalamount;
$('#net_salary').val(net_salary);
  
    
    $('#sub_total').val(total_salary);
    sume=[];
    for(i=0;i<mycount;i++){
        perc=$('#perc-'+i).html();
    
   
    perce =parseInt(perc);
    calce=perce/100;
    percalce=total_salary*calce;
    sume.push(percalce);
    $('#data-'+i).html(percalce);
    
}
sumse = sume.reduce((partialSum, a) => partialSum + a, 0);
$('#totalbreakup').html(sumse);
  });
//     $("#allowamount-1").keyup(function(){
       
    

//    kamount= $('#allowamount-1').val();
//    kamount =parseInt(kamount);
//    totalamount=totalamount+kamount;
//    $('#allowtotal').val(totalamount);
        
   
//   });

    function getSalary(n){
        if(n){
            console.log(n);
                $.ajax({
                type: 'get',
        url:  "{{url('get-employee-data')}}"+"/"+n,
       
        success: function (res) {
          
            console.log(res);
            if(res=='' || res==null){
                alert("Employee salary already added");
                $('#net_salary').val('0');
                net_salary=0;
                total_salary=0;
                basic_salary=0;
                // $('#basic_salarytable').val('0');
                $('#basic_salary').val('0');
                $('#sub_total').val('0');
                
                $("#employee_name").select2().val('').trigger("change");
                $('#BreakUp_titles').empty();
                $("#BreakUp_titles").append('<tr><td rowspan="4"><h2>Salary Breakup</h2></td></tr>');
            }
            else {
                mycount =   res['records'].length;
                $('#sub_total').val('0');
var records=res['records'];
var sum=[];
$('#BreakUp_titles').empty();
a=0;
a=parseInt(res['records'].length);
a=a+1;
$("#BreakUp_titles").append('<tr><td rowspan="'+a+'"><h2>Salary Breakup</h2></td></tr>');

for(i=0;i<res['records'].length;i++){
    perc=res['records'][i].percentage;
    basic_salary=res['salary'];
    basic_salary =parseInt(basic_salary);
    perc =parseInt(perc);
    calc=perc/100;
    percalc=basic_salary*calc;
    sum.push(percalc);
    
    $("#BreakUp_titles").append(' <tr><td>'+res['records'][i].name+'</td><td id="perc-'+i+'">'+res['records'][i].percentage+'</td><td id="data-'+i+'">'+percalc+'</td></tr>');
}
sums = sum.reduce((partialSum, a) => partialSum + a, 0);
console.log(sums);
 $("#BreakUp_titles").append('<tr><td colspan="'+3+'" class="text-right">Total</td><td id="totalbreakup">'+sums+'</td></tr>');

 $('#net_salary').val('0');
 net_salary=0;
            total_salary=basic_salary;
        net_salary=net_salary+total_salary+totalamount-totaldeductamount;
$('#net_salary').val(net_salary);
$('#sub_total').val(basic_salary);
$('#basic_salary').val(basic_salary);
            //     daySalary=0;
            // //     leavescalc=0;
            // // absentscalc=0;
            // net_salary=0;
            // basic_salary=res['salary'];
            // // leaves=res['leaves'];
            // // absents=res['absents'];
            // daySalary= res['salary']/30;
            // leavescalc=res['leaves']*daySalary;
            // absentscalc=res['absents']*daySalary;
            // leavescalc =parseInt(leavescalc);
            // absentscalc =parseInt(absentscalc);
            // $('#basic_salary').val('0');
          
        // $('#absentsd').html('');
        // $('#leavesd').html('');
        // $('#absentsd').val('');
        // $('#leavesd').val('');
        // $('#absentscalc').val('');
        // $('#leavescalc').val('');
        // $('#totalcalc').val('');
        // $('#basic_salarytable').val('');
        // $('#sub_total').val('');
        // // $("#type_id").select2().val('').trigger("change");
     
        // $('#absentsd').html(res['absents']);
        // $('#leavesd').html(res['leaves']);
        // $('#absentsdc').val(res['absents']);
        // $('#leavesdc').val(res['leaves']);
        // $('#absentscalc').val(absentscalc);
        // $('#leavescalc').val(leavescalc);
        // $('#totalcalc').val(total_salary);
        // $('#basic_salarytable').val(res['salary']);
        // $('#basic_salary').val(res['salary']);
        // $('#sub_total').val(total_salary);
        // $('#id_expire_date').val(res['idcard_expire_date']);
        // $('#license_no').val(res['license_no']);
        // $('#license_expire_date').val(res['license_expire_date']);
        
        // $("#isactive").select2().val(res['is_active']).trigger("change");
        // $("#type_id").select2().val(res['vehicle_id']).trigger("change");
        }
    }
      });
            }
           
        
    }
    i=1;
    totalamount=0;
    $('.help-allowance').hide();
    $('.help-allowanceamount').hide();
      $('#add').click(function(){
         var workers = $('#workers-1').val();

         var workerstext = $('#workers-1 option:selected').text();
         var allowamount = $('#allowamount-1').val();
         if(workers=='' || workers==null){
            $('.help-allowance').show();
         } else if(allowamount==0 || allowamount==null){
            $('.help-allowance').hide();
            $('.help-allowanceamount').show();
         }
         else {
            $('.help-allowance').hide();
            $('.help-allowanceamount').hide();
         allwamount=parseInt(allowamount);
        totalamount = totalamount+allwamount;
        console.log(totalamount,' ',allwamount);
        $('#allowtotal').val(totalamount);
        $('#allowance_charges').val(totalamount);

        net_salary=net_salary+allwamount;

        $('#net_salary').val(net_salary);
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="allowance_id[]" id="workers-'+i+'" class="form-control ">  <option value="'+workers+'" >'+workerstext+'</option></select></td><td><input type="text" readonly id="allowamount-'+i+'" name="allowance_amount[]" value="'+allowamount+'"  class="form-control " /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      
        
    
      
        $('#workers-1').val('').trigger("change");
       
        $('#workers-1 option:selected').text('Select Allowance');
        $('#allowamount-1').val('0');
         }
      });
      //deduction
    e=1;
    totaldeductamount=0;
    $('.help-deduction').hide();
    $('.help-deductionamount').hide();
      $('#addexpense').click(function(){
        console.log('werwe');
         var deduct = $('#deduction-1').val();

         var deducttext = $('#deduction-1 option:selected').text();
         var deductamount = $('#deductamount-1').val();
         if(deduct=='' || deduct==null){
           
           $('.help-deduction').show();
        }
        else if(deductamount==0 || deductamount==null){
           $('.help-deduction').hide();
           $('.help-deductionamount').show();
        }
        else {
           $('.help-deduction').hide();
           $('.help-deductionamount').hide();
         dedctamount=parseInt(deductamount);
         totaldeductamount = totaldeductamount+dedctamount;

$('#allowdeducttotal').val(totaldeductamount);
$('#deduction_charges').val(totaldeductamount);
net_salary=net_salary-dedctamount;
$('#net_salary').val(net_salary);
           e++;
           $('#dynamic_field2').append('<tr id="rowz'+e+'"><td><select  name="deduction_id[]" id="deduction-'+e+'" class="form-control ">  <option value="'+deduct+'" >'+deducttext+'</option></select></td><td><input type="text" readonly id="deductamount-'+e+'" name="deduct_amount[]" value="'+deductamount+'"  class="form-control " /></td><td><button type="button" name="remove" id="'+e+'" class="btn btn-danger btn_remove2">X</button></td></tr>');
      
        
    
      
        $('#deduction-1').val('').trigger("change");
       
 $('#deduction-1 option:selected').text('Select Deduction');
        $('#deductamount-1').val('0');
        
        }
      });
      $(document).on('click', '.btn_remove', function(){
        console.log(totalamount);
                var button_id = $(this).attr("id");
                var am = $('#allowamount-'+button_id).val();
                console.log(am);
                amw=parseInt(am);
                totalamount = totalamount-amw;
                net_salary=net_salary-amw;
                $('#net_salary').val(net_salary);
                $('#allowtotal').val(totalamount);
                $('#allowance_charges').val(totalamount);
                $('#row'+button_id+'').remove();
                

            });
      $(document).on('click', '.btn_remove2', function(){
        console.log(totalamount);
                var button_id2 = $(this).attr("id");
                var dm = $('#deductamount-'+button_id2).val();
                console.log(dm);
                dmw=parseInt(dm);
                totaldeductamount =  totaldeductamount-dmw;
                net_salary=net_salary+dmw;
                $('#net_salary').val(net_salary);
                $('#allowdeducttotal').val(totaldeductamount);
                $('#deduction_charges').val(totaldeductamount);
                $('#rowz'+button_id2+'').remove();
                

            });
</script>
@stop
