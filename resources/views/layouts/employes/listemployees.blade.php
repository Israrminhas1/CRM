@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage Employees')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Registered Employees</h2>
                <ul class="header-dropdown dropdown">
                   
                    <li>
                      
                        <a href="{{url('employee-gratuity')}}" class="btn btn-primary theme-bg btn-round plain text-white" title="Employee Gratuity"><i class="fa fa-file-text-o"></i></a>
                       
                    </li>
               
                 
              
<li>
    @if(in_array('add-employees', $rights_array))
    <a href="{{url('add-employees')}}" class="btn btn-primary theme-bg btn-round plain text-white"  title="Add Employee"><i class="fa fa-plus"></i></a>
    @endif
</li>
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
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-last-exportable" id="a-table">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="1%"></th>
                                <th>Name</th>
                                <th>Mobile Phone</th>
                                <th>Country Phone</th>
                                <th>Salary</th>
                                <th>Address</th>
                                {{-- <th width="10%">Action</th> --}}
                        </thead>

                        <tbody>
                            @if($employees)
                            <?php $index=1; ?>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$index++}} 
                                </td>
                                <td class="pr-1 pl-1">
                                    <div class="btn-group float-right">
                                    <button id="btnGroupDrop1" type="button" class="btn rounded-circle "   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa  fa-ellipsis-v icon-sizes"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if(in_array('employee-profile', $rights_array))  
                                            <a href="{{url('employee-profile/'.$employee->id)}}" class="dropdown-item" >
                                            <i class="fa fa-user"></i> Profile </a>
                                            @endif
                                    @if(in_array('edit-employees/', $rights_array))
                                    <a href="{{url('edit-employees/'.$employee->id)}}" class="dropdown-item "><i class="fa fa-edit"></i> Edit </a>
                                   @endif
                                   @if(in_array('view-employees-document/', $rights_array))  
                                        <a href="{{url('view-employees-document/'.$employee->id)}}" class="dropdown-item"><i class="fa fa-file"></i> Documents </a>
                                    @endif
                               @if($employee->user_id==NULL)
                                 <a href="javascript:;" data-toggle="modal" data-target="#exampleModalCenter" class="dropdown-item" onclick="setValue('{{ $employee->id }}','{{ $employee->full_name }}')"><i class="fa fa-file"></i> Assign Role </a>
                                 @else

                                @endif
                                    @if(in_array('delete-employee/', $rights_array))  
                                    <a href="javascript:;" onclick="deleteemployee({{$employee->id}});" class="dropdown-item" >
                                    <i class="fa fa-trash-o"></i> Delete </a>
                                    @endif
                                
                                        </div>
                                </div>

                                </td>
                                <td>{{$employee->full_name}}</td>
                                <td>{{$employee->mobile_phone}}</td>
                                <td>{{$employee->country_phone}}</td>
                                <td>{{$employee->salary}}</td>
                                <td >{{$employee->emp_address}}</td>
                                {{-- <td>@if(in_array('edit-employees', $rights_array))<a href="{{url('edit-employees/'.$employee->id)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>&nbsp;&nbsp;@endif @if(in_array('edit-roles-employees', $rights_array))<a href="{{url('edit-roles-employees/'.$employee->id)}}" class="btn btn-outline btn-circle btn-sm green"><i class="fa fa-edit"></i> View/Edit Rights </a>&nbsp;&nbsp;@endif @if(in_array('delete-employees', $rights_array))<a href="javascript:;" onclick="deleteemployee({{$employee->id}});" class="btn btn-outline btn-circle dark btn-sm black">
                                                <i class="fa fa-trash-o"></i> Delete </a>@endif</td>
                                </tr> --}}
                                {{-- <td class="float-right">
                                    <div class="btn-group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-primary rounded-circle "   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa  fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                        @if(in_array('edit-employees/', $rights_array))
                                        <a href="{{url('edit-employees/'.$employee->id)}}" class="dropdown-item "><i class="fa fa-edit"></i> Edit </a>
                                       @endif
                                       @if(in_array('view-employees-document/', $rights_array))  
                                            <a href="{{url('view-employees-document/'.$employee->id)}}" class="dropdown-item"><i class="fa fa-file"></i> Documents </a>
                                        @endif
                                        @if(in_array('delete-employee/', $rights_array))  
                                        <a href="javascript:;" onclick="deleteemployee({{$employee->id}});" class="dropdown-item" >
                                        <i class="fa fa-trash-o"></i> Delete </a>
                                        @endif
                                            </div>
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach
                        @else
                        <tr>
                        <td colspan="5">No Records Found</td>
                        </tr>
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Vertically centered -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="modalform" action="{{url('assign-employee-role')}}" class="horizontal-form">
                    @csrf
                      <div class="form-body">
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group c_form_group disabled {{(@$errors->any() && $errors->first('empname')) ? 'has-error' : ''}}" >
                                      <label class="control-label">Name</label>
                                      <input type="text" name="empname" placeholder="Enter Name"  id="empname"  value="{{old('empname')}}" class="form-control" readonly >
                                    
                                  </div>
                              </div>
                             
                              <!--/span-->
                              <div class="col-md-4">
                                  <div class="form-group c_form_group {{(@$errors->any() && $errors->first('empemail')) ? 'has-error' : ''}}">
                                      <label class="control-label">Email</label>
                                      <input type="text" name="empemail" placeholder="Enter Email" id="empemail"  value="{{old('empemail')}}" class="form-control" required >
                                      <span class="text-danger text-danger-error w-100 small text-danger help-type"> This Field Is Required</span>
                                      <span class="text-danger text-danger-error w-100 small text-danger email-type"> This Email Already Exists</span>
                                  </div>
                              </div>
                              <!--/span-->
  
                              <div class="col-md-4">
                                  <div class="form-group c_form_group {{(@$errors->any() && $errors->first('password')) ? 'has-error' : ''}}">
                                      <label class="control-label">Password</label>
                                      <input type="password" name="password" placeholder="Enter Password" id="emppass"  value="{{old('password')}}" class="form-control" required >
                                      <span class="text-danger text-danger-error w-100 small text-danger pass-type"> This Field Is Required</span>

                                  </div>
                              </div>
                       
                        </div>
                            <div class="row">

                            
                                <div class="col-md-4">
                                @if($roles)
                                <div class="form-group c_form_group {{(@$errors->any() && $errors->first('name')) ? 'has-error' : ''}}">
                                    <label class="control-label">Role Title</label>
                                    <select name="role_name" id="role" class="form-control custom-select" required >
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{old('role_name') == $role->id ? "selected" : ""}}>{{$role->name}}</option>
                                    @endforeach
                                    </select>
                                    <span class="text-danger text-danger-error w-100 small text-danger role-type"> This Field Is Required</span>

                                </div>
                                @endif
                                </div>
                            </div>
                            
                          <!--/row-->
  
                      </div>
                    
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="buttom" class="btn btn-primary theme-bg gradient" onclick="onSubmit()">Save login</button>
            
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
    function deleteemployee(id)
        {
            if(confirm('Are you sure you want to delete?'))
            {
                window.location.href="{{url('delete-employee')}}/"+id;
            }
        }
        $('.help-type').hide();
        $('.pass-type').hide();
        $('.role-type').hide();
        $('.email-type').hide();
        function setValue(n,p)
        { 

            $('#empname').val(p);
        
            $('#modalform').attr('action', url+'/assign-employee-role/'+n);
        } 
    function onSubmit()
        {
            $('.help-type').hide();
        $('.pass-type').hide();
        $('.role-type').hide();
        $('.email-type').hide();
            emp_email =  $('#empemail').val();
            emp_pass =  $('#emppass').val();
            emp_role =  $('#role').val();
            $.ajax({
                type: 'get',
        url: 'get-user-data',
       
        success: function (res) {
            emailcomp=res;
             if(emp_email === null || emp_email === "" ){
            $('.help-type').show();
        } 
          else  if(emp_pass === null || emp_pass === "" ){
            $('.pass-type').show();
        } 
          else  if(emp_role === null || emp_role === "" ){
            $('.role-type').show();
        } else if(res.includes(emp_email)){
            $('.email-type').show();
        }
        
        
        else {
            $('.help-type').hide();
        $('.pass-type').hide();
        $('.role-type').hide();
        $('.email-type').hide();
             $("#modalform").submit()
        }

      }});
            console.log(emp_email);
           
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
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop

