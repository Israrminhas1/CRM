</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->

<!-- END QUICK NAV -->

<!-- BEGIN CORE PLUGINS -->

<script src="{{ asset('global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="{{ asset('global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="{{ asset('global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{asset('global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script src="{{ asset('global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/scripts/datatable.js')}} "  type="text/javascript" ></script>
<script src="{{ asset('global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('global/scripts/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>

{{-- <script src="{{asset('pages/scripts/form-repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('pages/scripts/components-select2.min.js') }}" type="text/javascript"></script> --}}

    <script src="{{asset('pages/scripts/profile.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<style> .slct {background: #36c6d3;color: white !important;} .slct:hover {background: #36c6d3 !important;color: white !important;} </style>
<script>
$(document).ready(function()
{


    $('#clickmewow').click(function()
    {
        $('#radio1003').attr('checked', 'checked');
    });

    var url = window.location;

    // for single sidebar menu
    $('.page-sidebar-menu >li > a').filter(function () {

        return this.href == url;
    }).addClass('active').addClass('slct');

    // for sidebar menu and treeview
    $('ul.sub-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".page-sidebar-menu > .sub-menu > li")

        .addClass('open active').prev('a')
        .addClass('active');

})
function cancelFunction(returl)
    {
        window.location.href = returl;
    }
    function readFunction(returl)
    {
        window.location.href = returl;
    }



   </script>
</body>

</html>
