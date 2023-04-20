@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage Employees Document')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>DOCUMENTS</h2>
                <ul class="header-dropdown dropdown">
<li>
    <a href="{{url('add-employees-document')}}" class="btn btn-primary theme-bg btn-round plain text-white"><i class="fa fa-plus"></i></a>

</li>
                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <div class="body">
                @if(Session::has('errorMsg'))
                    <div class="alert alert-danger">{{Session::get('errorMsg')}}</div>
                @endif
                @if(Session::has('successMsg'))
                    <div class="alert alert-success">{{Session::get('successMsg')}}</div>
                @endif
                <div class="table-responsive">

                    <table class="table table-striped table-hover dataTable js-exportable" id="sample_3">
                        <thead>
                            <tr>
                                <th>Document Title</th>
                                <th>Expiry Date</th>
                                <th>View Document</th>
                                <th>Action</th>
                        </thead>

                        <tbody>
                            @if($employees)
                            @foreach($employees as $employee)
                            <tr>
                            <td>{{$employee->document_type}}</td>
                            <td>{{$employee->expiry_date}}</td>
                            <td><a href="{{url("".$employee->document_file)}}" target="_blank" class="btn  btn-primary btn-round btn-circle green btn-sm green" > <i class="fa fa-eye"></i> View</td>
                            {{-- <td>@if(in_array('edit-employees', $rights_array))<a href="{{url('edit-employees/'.$employee->id)}}" class="btn btn-outline btn-circle btn-sm purple"><i class="fa fa-edit"></i> Edit </a>&nbsp;&nbsp;@endif @if(in_array('edit-roles-employees', $rights_array))<a href="{{url('edit-roles-employees/'.$employee->id)}}" class="btn btn-outline btn-circle btn-sm green"><i class="fa fa-edit"></i> View/Edit Rights </a>&nbsp;&nbsp;@endif @if(in_array('delete-employees', $rights_array))<a href="javascript:;" onclick="deleteemployee({{$employee->id}});" class="btn btn-outline btn-circle dark btn-sm black">
                                            <i class="fa fa-trash-o"></i> Delete </a>@endif</td>
                            </tr> --}}
                            <td> &nbsp;&nbsp;<a href="javascript:;" onclick="deleteemployeedoc({{$employee->id}});" class="btn btn-outline-dark btn-round dark btn-sm black">
                                <i class="fa fa-trash-o"></i> Delete </a></td>
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

@stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
@stop
@section('vendor-script')
<script>

    function deleteemployeedoc(id)
    {
        if(confirm('Are you sure you want to delete?'))
        {
            window.location.href="{{url('delete-employee-document')}}/"+id;
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
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
