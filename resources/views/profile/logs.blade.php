@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Manage Users')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Logs List</h2>
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
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <form class=" input-daterange" method="post" action="{{url('logs-range')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group c_form_group col-md-3">
                                                User <br>
                                                <select class="form-control single2" name="userid" >
                                                    <option value=""> Select User</option>

                                                    @foreach ($users as $user)
                                                   @if (isset($userdata))
                                                       @if($userdata['userid']==$user->id)
                                                       <option value="{{$user->id}}" selected> {{$user->name}}</option>
                                                       @else
                                                       <option value="{{$user->id}}"> {{$user->name}}</option>
                                                      @endif
                                                    @else
                                                      <option value="{{$user->id}}"> {{$user->name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group c_form_group col-md-3">
                                                From
                                                @if(isset($userdata))
                                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $userdata['from'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                                @else
                                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" name="start_date" placeholder="Date From" >
                                                @endif                                            </div>
                                            <div class="form-group c_form_group col-md-3">
                                                To
                                                @if(isset($userdata))
                                                <input class="form-control" type="text" data-provide="datepicker" value="{{ $userdata['to'] }}" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                                @else
                                                <input class="form-control" type="text" data-provide="datepicker" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Date To"  name="end_date" >
                                            @endif
    
                                            </div>
                                            <div class="form-group c_form_group col-md-3 ">
                                                <br>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary btn-round btn-filter" type="submit"  ><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                                                    <a href="{{url('logs-list')}}" class="btn btn-dark btn-round btn-filter"  ><i class="fa fa-fw fa-lg fa-close"></i>Reset</a>
                                                </div>
                                              
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable" id="sample_3">
                        <thead>
                            <tr>
                                <th width="10%"> # </th>
                                <th> Actions </th>
                                <th> User </th>
                                <th class="numeric"> Date </th>

                                </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1 ?>
                                @foreach ($logs as $log)
                                <tr>
                                    <td> {{$cnt}} </td>
                                    <td> {{$log->description}} </td>
                                    <td> {{$log->name}} </td>
                                    <td> {{date('jS M Y H:i:s', strtotime($log->activity_date))}} </td>
                                </tr>
                                <?php $cnt++ ?>
                                @endforeach
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
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
@stop
@section('vendor-script')

<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
@stop

@section('page-script')
<script>
    $(document).ready(function() {
        $('.single2').select2({
    width: '100%',
    theme: "bootstrap" // need to override the changed default
});
    });
</script>
<script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
@stop
