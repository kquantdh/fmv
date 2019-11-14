

<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('js/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('js/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('js/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('js/table-datatables-managed.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('js/table-datatables-ajax.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('js/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/quick-nav.min.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- BEGIN MODAL -->
<script src="{{asset('js/bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-modal.js')}}" type="text/javascript"></script>


<!-- BEGIN MODAL -->
<!-- BEGIN DATE TIME PICKER-->
<script src="{{asset('js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-datetimepicker.fr.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<!-- BEGIN DATATABLES-->

<script>
    CKEDITOR.replace( 'form-control ckeditor' );
</script>

<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>
<!-- BEGIN DATE TIME PICKER-->
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });


</script>



