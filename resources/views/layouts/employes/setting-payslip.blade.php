@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage Payroll')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Payslip Setting</h2>
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
            <h6> Salary Breakup </h6>
                <table id="SalaryBreakUp-grid"  class="table table-striped table-hover dataTable " cellpadding="0" cellspacing="0" border="0" class="display" style="border-top:0px solid; border-color:#3c8dbc; border-left:none;border-right:none;width:50%;">
                    <thead style="background-image: none;">
                      <tr >
                        <th width="5%"># </th>
                      
                        <th >Name </th>
                        <th > <button class="btn btn-primary float-right" onclick="clearRecord()" data-toggle="modal" data-target="#SalaryBreakUpTypeModal" ><i class="fa fa-plus"></i></button> </th>
      
                       
      
                      </tr>
                    </thead>
                    <tbody >
                    
                        @if($breakupTypes)
                        <?php $index=1; ?>
                        @foreach($breakupTypes as $breakupType)
                        <tr>
                            <td>{{$index++}}</td>
                       
                           
                            <td>{{$breakupType->name}}</td>
                            <td class="pr-1 pl-1">
                                <div class="btn-group float-right">
                                    <button id="btnGroupDrop1" type="button" class="btn rounded-circle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa  fa-ellipsis-v icon-sizes"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        
                                        <a data-toggle="modal" data-target="#SalaryBreakUpModal"  class="dropdown-item BreakUpModalOpen" title="Add BreakUp Record" data-type="{{ $breakupType->id }}"><i class="fa fa-edit"></i>Edit</a>
                                        <a  title="View Record" class="dropdown-item view_salary_breakups" data="{{ $breakupType->id }}"><i class="fa fa-windows"></i> View</a>

                                        {{-- @if(in_array('delete-leavetype/', $rights_array))
                                        <a href="javascript:;" onclick="deleteleave({{$breakupType->id}});" class="dropdown-item" >
                                        <i class="fa fa-trash-o"></i> Delete </a>
                                        @endif --}}
                                        </div>
                            </div>
    
                            </td>
                          
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="6">No Records Found</td>
                        </tr>
                        @endif
                       </tbody>
              </table>

            <h6> Allowances </h6>  
            <table id="SalaryBreakUp-grid"  class="table table-striped table-hover dataTable " cellpadding="0" cellspacing="0" border="0" class="display" style="border-top:0px solid; border-color:#3c8dbc; border-left:none;border-right:none;width:50%;">
                <thead style="background-image: none;">
                  <tr >
                    <th width="5%"># </th>
                  
                    <th >Name </th>
                    <th > <button class="btn btn-primary float-right" onclick="getAllowance()" data-toggle="modal" data-target="#allowancemodel" ><i class="fa fa-plus"></i></button> </th>
  
                   
  
                  </tr>
                </thead>
                <tbody >
                
                    @if($allowances)
                    <?php $index=1; ?>
                    @foreach($allowances as $allowance)
                    <tr>
                        <td>{{$index++}}</td>
                   
                       
                        <td>{{$allowance->name}}</td>
                        <td class="pr-1 pl-1">
                          <div class="btn-group float-right">
                              <button id="btnGroupDrop1" type="button" class="btn rounded-circle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa  fa-ellipsis-v icon-sizes"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                  
                                  <a data-toggle="modal" data-target="#SalaryAllowance" onclick="getSalaryAllowance('{{ $allowance->name }}',{{ $allowance->id }})"  class="dropdown-item" title="Edit Allowance" data-type="{{ $allowance->id }}"><i class="fa fa-edit"></i>Edit</a>
                                  <a href="javascript:;" title="Delete Record" onclick="deleteallowance({{$allowance->id  }})" class="dropdown-item"  data="{{ $allowance->id }}"><i class="fa fa-trash-o"></i>Delete</a>

                               
                                  </div>
                      </div>

                      </td>
                        
                      
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="6">No Records Found</td>
                    </tr>
                    @endif
                   </tbody>
               </table> 
            
            <h6> Deductions </h6>  
            <table id="SalaryBreakUp-grid"  class="table table-striped table-hover dataTable " cellpadding="0" cellspacing="0" border="0" class="display" style="border-top:0px solid; border-color:#3c8dbc; border-left:none;border-right:none;width:50%;">
                <thead style="background-image: none;">
                  <tr >
                    <th width="5%"># </th>
                  
                    <th >Name </th>
                    <th > <button class="btn btn-primary float-right" onclick="getDeduction()"  data-toggle="modal" data-target="#add-expense" ><i class="fa fa-plus"></i></button> </th>
  
                   
  
                  </tr>
                </thead>
                <tbody >
                
                    @if($deductions)
                    <?php $index=1; ?>
                    @foreach($deductions as $deduction)
                    <tr>
                        <td>{{$index++}}</td>
                   
                       
                        <td>{{$deduction->name}}</td>
                        <td class="pr-1 pl-1">
                          <div class="btn-group float-right">
                              <button id="btnGroupDrop1" type="button" class="btn rounded-circle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa  fa-ellipsis-v icon-sizes"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                  
                                  <a data-toggle="modal" data-target="#SalaryDeduction" onclick="getSalaryDeduction('{{ $deduction->name }}',{{ $deduction->id }})"  class="dropdown-item " title="Add BreakUp Record" data-type="{{ $deduction->id }}"><i class="fa fa-edit"></i>Edit</a>
                                  <a href="javascript:;" title="Delete Record" onclick="deletededuction({{$deduction->id  }})" class="dropdown-item " data="{{ $deduction->id }}"><i class="fa fa-trash-o"></i>Delete</a>

                               
                                  </div>
                      </div>

                      </td>
                        
                      
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="6">No Records Found</td>
                    </tr>
                    @endif
                   </tbody>
               </table> 
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="allowancemodel" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
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
<div class="modal fade" id="SalaryAllowance" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Edit Allowance</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
              <div class="row">

                  <div class="col-md-12">
                      <div class="form-group c_form_group has-info">
                          <div class="input-group">
                              <label for="form_control_1">Allowance Name</label>
                            
                              <input type="hidden"  id="update_allowance_id"  >
                              <input type="text"  id="update_allowance_name" name="allowance_name"  class="form-control"  placeholder="Allowance Name">
                              <span class="help-block help-block-error text-danger edit-help-type"> This Field Is Required</span>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn green btn-primary" id="updatenew-worker">Update</button>
              <button type="button" class="btn dark btn-dark" data-dismiss="modal">Close</button>

          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="SalaryDeduction" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Edit Dedcution</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
              <div class="row">

                  <div class="col-md-12">
                      <div class="form-group c_form_group has-info">
                          <div class="input-group">
                              <label for="form_control_1">Dedcution Name</label>
                            
                              <input type="hidden"  id="update_deduction_id"  >
                              <input type="text"  id="update_deduction_name" name="deduction_name"  class="form-control"  placeholder="Allowance Name">
                              <span class="help-block help-block-error text-danger edit-help-expense"> This Field Is Required</span>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn green btn-primary" id="updatenew-expense">Update</button>
              <button type="button" class="btn dark btn-dark" data-dismiss="modal">Close</button>

          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="SalaryBreakUpModal" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Salary Break Up Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-10">
                    <label>Title</label>
                    <!-- <input type="text" id="BreakUptitle" class="form-control" placeholder="Break Up Title" /> -->
                    <select name="BreakUptitle" id="BreakUptitle" class="form-control">
                      <option value="">select title</option>
                      <option value="Basic Salary">Basic Salary</option>
                      <option value="Conveyance Allowance">Conveyance Allowance</option>
                      <option value="Residence Allowance">Residence Allowance</option>
                      <option value="Communication Allowance">Communication Allowance</option>
                    </select>
                      <input type="hidden" id="BreakUpTypeId" value="0"/>
                      <input type="hidden" id="BreakUpId" value="0"/>
                      <input type="hidden" id="oldBreakupPercentage" value="0"/>
                    </div>
                    <div class="col-sm-2">
                    <label>Percentage</label>
                      <input type="number" id="BreakUpPercentage" class="form-control" placeholder="%" />
                    </div>
              
                   </div>
                   <div class="form-group">
                       <table class="table table-condensed" id="BreakUpTable">
                           <thead>
                               <tr>
                                   <th>Sr</th>
                                   <th>Title</th>
                                   <th>Percentage</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody id="BreakUp_titles">
              
              
                           </tbody>
                       </table>
                   </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary BreakUp_save" >save</button>
                <button type="button" class="btn dark btn-dark" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="ViewSalaryBreakUpModal" tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Salary Break Up Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Title</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody id="ViewBreakUpTable">
        
        
                        </tbody>
                    </table>
                </div>
        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div id="SalaryBreakUpTypeModal" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Salary Break Up Type Add</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Break Up Title</label>
                <input type="hidden" id="BreakUpTypeTitleId">
                <input type="text" class="form-control" id="BreakUpTypeName" placeholder="Break Up Title" />
                <!-- <input type="hidden" id="title_id"/>
                <input type="hidden" id="title_type"/> -->
            </div>
            <div class="form-group">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="breakUpTitles">
   
                    </tbody>
                </table>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default Close_BreakUp_Type" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary BreakType_Save" data-dismiss="modal">Save</button>
         </div>
      </div>
  
    </div>
</div>
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
    function deleteallowance(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {
                window.location.href="{{url('delete-allowance')}}/"+id;
            }
        }
    function deletededuction(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {
                window.location.href="{{url('delete-deduction')}}/"+id;
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
  
   function getAllowance(){
    $('.help-type').hide();
    $('#allowance_name').val('')
}
   function getDeduction(){
    $('.help-expense').hide();
    $('#deduction_name').val('')
}

function getSalaryAllowance(n,b){
  $('.edit-help-type').hide();
  console.log(n)
  $('#update_allowance_name').val(n);
  $('#update_allowance_id').val(b);
}
function getSalaryDeduction(n,b){
  $('.edit-help-expense').hide();
  console.log(n)
  $('#update_deduction_name').val(n);
  $('#update_deduction_id').val(b);
}
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
                  
                  
                  location.reload();
                       

                  $('#add-worker').modal('hide');
                    
                   
                    
                    //if request if made successfully then the response represent the data

                }
            });
        }

    });
   $(document).on('click', '#updatenew-worker', function(){
    console.log('asd');
    e= $('#update_allowance_id').val();
    
        allowance_name =  $('#update_allowance_name').val();
        if(allowance_name === null || allowance_name === "" ){
            $('.edit-help-type').show();
        }else{
            $('.edit-help-type').hide();
            $.ajax({
                type: "post",
                url: "{{url('update-allowance-model')}}/"+e,
                data: {"_token": "{{ csrf_token() }}", allowance_name : allowance_name},
                dataType:"json",
                success: function(response){
                  console.log(response);
                  
                  
                  location.reload();
                       

                  $('#add-worker').modal('hide');
                  $('#SalaryAllowance').modal('hide');
                    // $('#allowance_name').val('');
                    
                    //if request if made successfully then the response represent the data

                }
            });
        }

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
            
                  location.reload();
                       
                    $('#add-expense').modal('hide');
                
                  
                    //if request if made successfully then the response represent the data

                }
            });
        }

    });
    $(document).on('click', '#updatenew-expense', function(){
      e= $('#update_deduction_id').val();
        deduction_name =  $('#update_deduction_name').val();
        if(deduction_name === null || deduction_name === "" ){
            $('.edit-help-expense').show();
        }else{
            $('.edit-help-expense').hide();
            $.ajax({
                type: "post",
                url: "{{url('update-deduction-model')}}/"+e,
                data: {"_token": "{{ csrf_token() }}", deduction_name : deduction_name},
                dataType:"json",
                success: function(response){
            
                  location.reload();
                       
                    $('#add-expense').modal('hide');
                
                  
                    //if request if made successfully then the response represent the data

                }
            });
        }

    });
     $(".BreakUp_save").click(function(){

let totalPercentage = 0;

var BreakUpId = $('#BreakUpId').val();

var BreakUpPercentage = $("#totalPercentage").val();

var Percentage = $("#BreakUpPercentage").val();

if(BreakUpId != '')
{

  let OldBreakUpPercentage = $("#oldBreakupPercentage").val();

  totalPercentage = Number(BreakUpPercentage) + Number(Percentage) - Number(OldBreakUpPercentage)

}
else
{

  totalPercentage = Number(BreakUpPercentage) + Number(Percentage)

}
console.log(totalPercentage);
if(totalPercentage <= 100){
var BreakUpName = $("#BreakUptitle").val();
var typeid = $("#BreakUpTypeId").val();
if(BreakUpName!="" && Percentage!=""){
  $.ajax({
      url:"{{ url('insert-salary-breakup')}}",
      type:"post",
      data:{"_token": "{{ csrf_token() }}",
      BreakUpName:BreakUpName,
      typeid:typeid,
      BreakUpId:BreakUpId,
      Percentage:Percentage},
      dataType:"json",
      success:function(res){
     console.log(res);
        if(res=='true'){
           
          location.reload();
        }else if(res=='false'){
          alert('Record Already Added');
        }else if(res=='Data Updated'){
          location.reload();
          alert('Record Updated Successfully');
        }
      }
  })
}else{
  alert("You Can Not Add Null Values");
}
}else{
alert('You Can Add Only 100%');
}

})
$(document).on("click",".BreakUpModalOpen",function(){
            type = $(this).attr("data-Type");
            $("#BreakUpTypeId").val(type);


              $("#BreakUpPercentage").val('');
              $("#BreakUptitle").val('');
              
              $("#BreakUpId").val('');
              $("#oldBreakupPercentage").val('');
               
            $("#BreakUp_titles").empty();

            $.ajax({
                url:"{{url('fetch-breakup')}}",
                method:'post',
                dataType:"json",
                data:{"_token": "{{ csrf_token() }}",type:type},
                success:function(res){
                    console.log(res);
                    sr =0;
                    totalPercentage=0;
                    for(i=0;i<res.length;i++){
                      sr++;
                      totalPercentage=totalPercentage+parseInt(res[i].percentage);
                      $("#BreakUp_titles").append(' <tr><td>'+sr+'</td><td>'+res[i].name+'</td><td>'+res[i].percentage+'</td><td><a href="#" class="breakup_edit btn" data-id="'+res[i].id+'" data-name="'+res[i].name+'" data-percentage="'+res[i].percentage+'"><i class="fa fa-edit"></i></a> </td> </tr>')

                    }
                    // alert(totalPercentage);
                    $("#BreakUp_titles").append('<tr><th>Percentage<th><th><input id="totalPercentage" type="text" value="'+totalPercentage+'" style="border:none;" readonly/></th> </tr>');
                }
            })

        })
        $(document).on("click",".breakup_edit",function(){
          //  alert('Hello');
              var id = $(this).attr("data-id");
              var title = $(this).attr("data-name");
              var percentage = $(this).attr("data-percentage");

              $("#BreakUpId").val(id);
              $("#BreakUptitle").val(title);
              $("#BreakUpPercentage").val(percentage);
              $("#oldBreakupPercentage").val(percentage);


        })
        getSalaryBreakUpType()
        function getSalaryBreakUpType() {
          
            $.ajax({
              url : "{{url('get-salary-breakup-type')}}",
              dataType : 'json',
              success : function (data) {

                $('#breakUpTitles').html(data)
                

              }
            })
        }
        
        $(document).on('click','.breakUpEdit',function () {

let breakupId = $(this).attr('data-id')
let breakupTitle = $(this).attr('data-title')

$('#BreakUpTypeTitleId').val(breakupId)
$('#BreakUpTypeName').val(breakupTitle)

})
function clearRecord(){
  $("#BreakUpTypeName").val(''); 
}

$(".BreakType_Save").click(function(){
            var BreakUpTypeTitleId = $("#BreakUpTypeTitleId").val();
            var BreakUpTypeName = $("#BreakUpTypeName").val();
            // alert(BreakUpTypeName);
            $.ajax({
                url : "{{url('insert-breakup-type')}}",
                type:"post",
                dataType:"json",
                data:{"_token": "{{ csrf_token() }}",BreakUpTypeTitleId:BreakUpTypeTitleId,BreakUpTypeName:BreakUpTypeName},
                success:function(res){
                   
                  if(res=='true'){
                    location.reload();
                  }else if(res=='false'){
                    alert('Record Already Added');
                  }

                }
            })
            
        })
$('.view_salary_breakups').click(function () {

$('#ViewSalaryBreakUpModal').modal('show')

let type =  $(this).attr('data')

$("#ViewBreakUpTable").empty()

    $.ajax({
        url:"{{url('fetch-breakup')}}",
        method:'post',
        dataType:"json",
        data:{"_token": "{{ csrf_token() }}",type:type},
        success:function(res)
        {
            sr =0;
            totalPercentage=0;
            for(i=0;i<res.length;i++){
              sr++;
              totalPercentage=totalPercentage+parseInt(res[i].percentage);
              $("#ViewBreakUpTable").append(' <tr><td>'+sr+'</td><td>'+res[i].name+'</td><td>'+res[i].percentage+'</td> </tr>')

            }

            $("#ViewBreakUpTable").append('<tr><th>Percentage<th><th><input id="totalPercentage" type="text" value="'+totalPercentage+'" style="border:none;" readonly/></th> </tr>');
        }
    })

});
</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

