@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manual Payslip')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Manual Payslip</h2>
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
                   
                    <div class="form-group c_form_group col-md-3">
                        Employees <br>
                         <select class="form-control single2 custom-select" id="employee_id" name="employee_id" >
                             <option value="" disabled selected> Select Employee</option>
                             @foreach ($payrolls as  $payroll)
                                 
                             <option value="{{ $payroll->id }}" >{{ $payroll->full_name }}</option>
                             @endforeach
                           
                             
 
                         </select>
                         <span class="text-danger text-danger-error text-danger help-employee"> This Field Is Required</span>

                     </div>
                          
                            <div class="form-group c_form_group col-md-3">
                               Month <br>
                                <select class="form-control single2 custom-select" id="month" name="month" >
                                    <option value="" disabled selected> Select Month</option>
                                    <option value="01" > Jan</option>
                                    <option value="02" > Feb</option>
                                    <option value="03" > Mar</option>
                                    <option value="04" > Apr</option>
                                    <option value="05" > May</option>
                                    <option value="06" > Jun</option>
                                    <option value="07" > Jul</option>
                                    <option value="08" > Aug</option>
                                    <option value="09" > Sep</option>
                                    <option value="10" > Oct</option>
                                    <option value="11" > Nov</option>
                                    <option value="12" > Dec</option>
                                    
        
                                </select>
                                <span class="text-danger text-danger-error text-danger help-type"> This Field Is Required</span>

                            </div>
                            <div class="form-group c_form_group col-md-3">
                               Year <br>
                                <select class="form-control single2 custom-select" id="year" name="year" >
                                    <option value="" disabled selected> Select Year</option>
                                    <option value="2023" > 2023</option>
                                   
        
                                 
                                </select>
                                <span class="text-danger text-danger-error text-danger help-year"> This Field Is Required</span>

                            </div>
                          
                            <div class="form-group c_form_group col-md-3 ">
                                <br>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-round btn-filter saveData" type="submit"  ><i class="fa fa-fw fa-lg fa-tasks"></i>Generate</button> 
                                </div>
                            </div>
        
                       
                   
        
                </div>
                <form action="{{url('generate-savedata')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12" id="show_payslip_data">
        
        
                        </div>
                      </div>
                   
                    <div class="form-actions noborder">
                        <button type="submit" class="btn btn-primary  plain">Submit</button>
                        <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-payroll')}}')">Cancel</button>
                    </div>
                </form>
                       
       
                  
            </div>

        </div>
    </div>
</div>

@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
@stop
@section('vendor-script')
<script>
 
    function deleteleave(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {
                window.location.href="{{url('delete-payslip')}}/"+id;
            }
        }



</script>
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
@stop

@section('page-script')
<script>
    function to_fixed_func(v) 
  {
    
    return v.toFixed(2)

  }
  function total_monthly_salary() 
  {

      let total_monthly_salary = 0;

      $('.approved_salary_').each(function()
      {

          total_monthly_salary += Number($(this).val())

      })

      $('.total_monthly_salary').html(to_fixed_func(total_monthly_salary))
    

  }

  function all_allownces() 
  {
      
      let totals_allownces = 0;

      $('.total_allownces_').each(function()
      {

          totals_allownces += Number($(this).val())

      })

      $('.totals_allownces').html(to_fixed_func(totals_allownces))

  }

  function all_deductions() 
  {
      
      let totals_deductions = 0;

      $('.total_deductions_').each(function()
      {

          totals_deductions += Number($(this).val())

      })

      $('.totals_deductions').html(to_fixed_func(totals_deductions))

  }
  function total_net_salary()
  {

    let total_net_salaryt = 0;

      $('.net_salary_').each(function()
      {

          total_net_salaryt += Number($(this).val())

      })

      $('.total_net_salary').html(to_fixed_func(total_net_salaryt))


  }
  function total_allownces(id) 
  {


      let total_allownces = 0;

      $('.allowance_val_'+id).each(function()
      {

          total_allownces += Number($(this).val())

      })

      $('.total_allownces'+id).val(to_fixed_func(total_allownces))

      return total_allownces
    
    
  }
  function total_deductions(id) 
  {

    let total_deductions = 0;

      $('.deduction_val_'+id).each(function()
      {

          total_deductions += Number($(this).val())

      })

      $('.total_deductions'+id).val(to_fixed_func(total_deductions))

    return total_deductions;
    
    
  }
  $(document).on('click','.remove_absent_row_',function () {
alert("Are you sure you want to remove?")
let id = $(this).attr('data-id')
  
let amount = $(this).attr('data-amount')

let net_val = $('.net_salary'+id).val()

let net_salary = Number(amount) + Number(net_val)

$('.net_salary'+id).val(to_fixed_func(Number(net_salary)))

$(this).closest('.rowz').remove()


let total_absent_deduction_val = $('.total_absent_deduction_emp'+id).val()      
total_absent_deduction_val = Number(total_absent_deduction_val) - Number(amount)




$('.total_absent_deduction_emp'+id).val(to_fixed_func(Number(total_absent_deduction_val)))

if($('.absent_single_row_'+id).length == 0)
{

  $('.absent_main_row_'+id).remove()

}

 total_deductions(id)
all_deductions()
total_net_salary()

})
$(document).on('click','.remove_allownce_row_,.remove_deduction_row_',function () {
    alert("Are you sure you want to remove?")
let id = $(this).attr('data-id')

$(this).closest('.rowz').remove()

if($(this).hasClass('remove_allownce_row_'))
{
  

  if($('.allownce_single_row_'+id).length == 0)
  {

    $('.allownce_main_row_'+id).remove()

  }

}
else
{

  $(this).closest('.row').remove()

  if($('.deduction_single_row_'+id).length == 0)
  {

    $('.deduction_main_row_'+id).remove()

  }

}

let allowances = total_allownces(id)

let deductions = total_deductions(id)

let approved_salary = $('.approved_salary'+id).val()

$('.net_salary'+id).val(to_fixed_func(Number(approved_salary) + allowances - deductions))

all_allownces()
all_deductions()
total_net_salary()

})
$('.plain').hide();
$('.help-type').hide();
$('.help-year').hide();
$('.help-employee').hide();
     $(".saveData").click(function(){
        let month = $('#month').val()
        let year = $('#year').val()
        let employee_id = $('#employee_id').val()
        if(employee_id === null || employee_id === ""  ){
            $('.help-employee').show();
        }  else if(month === null || month === "" ){
            $('.help-employee').hide();
            $('.help-type').show();
          
        }else if(year === null || year === "" ){
            $('.help-type').hide();
            $('.help-employee').hide();
            $('.help-year').show();
        }
        else {
            $('.help-type').hide();
            $('.help-year').hide();
            $('.help-employee').hide();
        $.ajax({

        url : "{{ url('manual-payslip') }}",
        data : {"_token": "{{ csrf_token() }}", employee_id : employee_id , month : month, year : year},
        method : 'post',
        dataType : 'json',
        success:function(data)
        {
           
            $('#show_payslip_data').empty()

            $('#show_payslip_data').html(data.html)
           
            if(data.type==1)
            {
                total_monthly_salary() 
            total_net_salary()
            all_allownces()
            all_deductions()
              $('.plain').show()

            }
            else
            {
            
              $('.plain').hide()
            }
        }


        })
    }
     })
     $(document).on('keyup','.deduction_val_,.allowance_val_',function () {
      

      let id = $(this).attr('data-id')

      let allowances = total_allownces(id)

      let deductions = total_deductions(id)
      
      let approved_salary = $('.approved_salary'+id).val()
      console.log(allowances);
console.log("deduct",deductions);
console.log("approve",approved_salary);
      $('.net_salary'+id).val(to_fixed_func(Number(approved_salary) + allowances - deductions))

      all_allownces()
      all_deductions()
      total_net_salary()

  })
  $(document).on('click','.remove_payslip_row_',function () {
    alert("Are you sure you want to remove?")

        $(this).closest('tr').next().remove();
        $(this).closest('tr').remove();
  
        total_monthly_salary()
        all_allownces()
        all_deductions()
        total_net_salary()
  
  
    })
        function cancelFunction(returl)
            {
                window.location.href = returl;
            }
            
</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

