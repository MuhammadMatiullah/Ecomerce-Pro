<!-- CORE PLUGINS -->
<script src="{{ asset('assets/user1/theme/assets/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user1/theme/assets/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user1/theme/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user1/theme/assets/corporate/scripts/back-to-top.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user1/theme/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="{{ asset('assets/user1/theme/assets/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script> <!-- pop up -->
<script src="{{ asset('assets/user1/theme/assets/plugins/owl.carousel/owl.carousel.min.js') }}" type="text/javascript"></script> <!-- slider for products -->
<script src="{{ asset('assets/user1/theme/assets/plugins/zoom/jquery.zoom.min.js') }}" type="text/javascript"></script> <!-- product zoom -->
<script src="{{ asset('assets/user1/theme/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script> <!-- Quantity -->

<script src="{{ asset('assets/user1/theme/assets/corporate/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user1/theme/assets/pages/scripts/bs-carousel.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        Layout.initImageZoom();
        Layout.initTouchspin();
        Layout.initTwitter();
    });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->