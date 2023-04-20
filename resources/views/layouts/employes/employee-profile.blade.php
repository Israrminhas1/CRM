@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Employee Profile')


@section('content')


<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Employee Profile</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
          <div class="body">
        <div class="row">
            <div class="col">
                
                <ul class="list-group" >
                    <li class="list-group-item"><strong>Name: </strong> {{ $employees->full_name }}</li>
                    <li class="list-group-item"><strong>Designation: </strong> {{ $employees->designation }}</li>
                    <li class="list-group-item"><strong>Gender: </strong> 
                        @if ($employees->gender=='M')
                            Male
                        @else
                            Female
                        @endif
                       </li>
                    <li class="list-group-item"><strong>Father Name: </strong> {{ $employees->father_name}}</li>
                    <li class="list-group-item"><strong>Date of Birth: </strong> {{ $employees->dob}}</li>
                    <li class="list-group-item"><strong>Visa Title: </strong> {{ $employees->visa_title}}</li>
                </ul>
            </div>
            <div class="col">
                
                <ul class="list-group" >
                    <li class="list-group-item"><strong>Mobile: </strong> {{ $employees->mobile_phone }}</li>
                    <li class="list-group-item"><strong>Country: </strong> {{ $employees->country}}</li>
                    <li class="list-group-item"><strong>Joining Date: </strong> {{ $employees->joining_date }}</li>
                    <li class="list-group-item"><strong>Father Name: </strong> {{ $employees->father_name}}</li>
                    <li class="list-group-item"><strong>Residence Address </strong> {{ $employees->emp_address}}</li>
                    <li class="list-group-item"><strong>Permenant Address </strong> {{ $employees->permanent_address}}</li>
                </ul>
            </div>
            <div class="col">
                
              <img height="270" width="270" id="thisimage" src="{{ asset($employees->attachment) }}">
              <form id="photoform" enctype="multipart/form-data">
                @csrf
              <input type="file" name="image" class="form-control" id="image" value="{{old('image')}}" placeholder="Profile Image" required>
              <button type="submit" class="btn btn-block btn-primary float-right update-photo">Update </button>
            </form>
            </div>
           
           
          
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
      $('.help-type').hide();
    //  $(".update-photo").click(function(){
    //     let image = $('#image').val()
    //     let id = "{{ $employees->id }}"
    //  console.log(image)
    //     if(image === null || image === "" ){
    //         $('.help-type').show();
    //     } 
    //     else {
    //         $('.help-type').hide();
       
      
    //     $.ajax({

    //     url : "{{ url('update-photo') }}/"+id,
    //     data : {"_token": "{{ csrf_token() }}", image : image},
    //     method : 'post',
        

    //     dataType : 'json',
    //     success:function(data)
    //     {
    //        console.log($data);
            
    //     }
    

    //     })
    // }
    //  })
     $('#photoform').submit(function(event) {
        event.preventDefault();
        let id = "{{ $employees->id }}"
        // var formData = new FormData($('#prfPickDeli')[0]);
        // formData.append('select_file', $('input[type=file]')[0].files[0]);
        $.ajax({
          url: "{{ url('update-photo') }}/"+id,
          method: "post",
          dataType: 'json',
          // data: formData,
          data: new FormData(this),
          contentType: false,
          processData: false,
          success:function(data){
            console.log(data)
            var source = url+"/"+data
            $('#thisimage').attr('src', source)
          },
          error: function () {
            console.log('fail consol.e')
          }
        })
      });
    $(document).ready(function() {
        $('.single2').select2({
    theme: "bootstrap" // need to override the changed default
});
    });
</script>
@stop
