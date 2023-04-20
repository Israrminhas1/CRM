<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
<title>@yield('title') - {{ config('app.name') }}</title>
<meta name="description" content="@yield('meta_description', config('app.name'))">
<meta name="author" content="@yield('meta_author', config('app.name'))">

@yield('meta')
@stack('before-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/animate-css/vivify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}">

<script> url = "{{url('')}}" </script>
@stack('after-styles')
@if (trim($__env->yieldContent('page-styles')))
@yield('page-styles')
@endif

<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('assets/css/mooli.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
@php
$themesetting = DB::table('theme_setting')
        ->select('*')
        ->where('user_id', auth()->user()->id)
        ->first();
        $lightsidebar = "";
    if(isset($themesetting->light_sidebar)){
        $lightsidebar = $themesetting->light_sidebar;
    }
@endphp
<body data-theme="light" class="{{isset($themesetting->rtl_mode) ? $themesetting->rtl_mode : '' }}">

<div id="body" class="{{isset($themesetting->theme) ? $themesetting->theme : 'theme-cyan' }}">

    <!-- Theme setting div -->
    @include('layout.themesetting' ,['themesettings' =>  $themesetting])

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <!-- main page header -->
        @include('layout.navbar')

        <!-- project main left menubar -->
        @include('layout.sidebar' ,['sidebarlight' => $lightsidebar] )

        <!-- Rightbar chat  -->
        @include('layout.rightbar')

        <!-- sticky note rightbar div -->
        @include('layout.stickynote')
           <!-- Modal with btn -->
           
        <div id="main-content">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
    </div>

    @yield('popup')

</div>


<!-- main jquery and bootstrap Scripts -->
@stack('before-scripts')
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>


@stack('after-scripts')

<!-- vendor js file -->
@yield('vendor-script')

<!-- project main Scripts js-->
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>

<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ui/dialogs.js') }}"></script>
<!-- page Scripts ja -->
@yield('page-script')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
$( window ).on( "load", function() {
    bggr = "{{isset($themesetting->gradient) ? $themesetting->gradient : ''}}";
        $(".theme-bg").addClass(bggr);
    });

   
  $(document).ready(function(){
    $('.sidebar_active').closest('li.has-child-item').addClass('active');
    $('.sidebar_active').closest('ul').addClass('in');
  
  })


</script>
<!--End of Tawk.to Script-->

</body>
</html>
