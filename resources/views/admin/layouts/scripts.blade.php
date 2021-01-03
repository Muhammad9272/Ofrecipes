<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script type="text/javascript">
			  var mainurl = "{{url('/')}}";
			  var admin_loader = {{ $gs->is_admin_loader }};
         var area2;
</script>



<script src="{{ asset('assets/admin_assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->


<script src="{{asset('assets/admin_assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')}}" type="text/javascript"></script>

   {{--   CK editor    --}}
        <script src="{{asset('assets/admin_assets/global/plugins/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script>

      


<!-- BEGIN PAGE LEVEL PLUGINS -->
      



          <script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
         <script src="{{ asset('assets/admin_assets/pages/scripts/ui-toastr.min.js')}}" type="text/javascript"></script>

                   <!-- BEGIN THEME GLOBAL SCRIPTS -->
          <script src="{{ asset('assets/admin_assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
          <!-- END THEME GLOBAL SCRIPTS -->

@section('pagelevel_scripts')
@show
<!-- END PAGE LEVEL PLUGINS -->




<!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('assets/admin_assets/pages/scripts/table-datatables-managed.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

<script src="{{ asset('assets/admin_assets/pages/scripts/components-editors.min.js')}}" type="text/javascript"></script>

 <script src="{{ asset('assets/admin_assets/pages/scripts/ui-confirmations.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('assets/admin_assets/layouts/layout4/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/layouts/layout4/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
<script src="{{ asset("assets/admin_assets/myscript.js") }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>

<script src="{{ asset('assets/admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin_assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>

  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
  


<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $(document).ready(function()
    {


        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });


        $(".seocheck").on( "change", function() {
            if(this.checked){
             $('#seofield').removeClass('seofields');
             
            }
            else{
              $('#seofield').addClass('seofields');
              
              
            }

          });


    })
</script>



