<!DOCTYPE html>
<html lang="en">
<head>
	<title>Apex</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/fonts/iconic/css/material-design-iconic-font.min.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/fonts/linearicons-v1.0.0/icon-font.min.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/animate/animate.css")}}>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/css-hamburgers/hamburgers.min.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/animsition/css/animsition.min.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/select2/select2.min.css")}}>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/daterangepicker/daterangepicker.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/slick/slick.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/MagnificPopup/magnific-popup.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/vendor/perfect-scrollbar/perfect-scrollbar.css")}}>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href={{asset("assets/css/util.css")}}>
	<link rel="stylesheet" type="text/css" href={{asset("assets/css/main.css")}}>
    <link rel="stylesheet" href="{{asset('Backend/plugins/toastr/toastr.min.css') }}">

<!--===============================================================================================-->
@livewireStyles
</head>
<body class="animsition">
<!-- Navbar -->
@include('layouts.userPartials.navbar')
<!-- /.navbar -->
 <div class="ui-content">
 {{ $slot }}
 </div>
 <!-- footer -->
 <!-- Back to top -->
 <!-- End Back to top -->
   

   
<!--===============================================================================================-->	
    <script>
        
        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        })
        window.addEventListener('hide-paymentForm', event => {
        $('#paymentForm').modal('hide');
        toastr.success(event.detail.message, 'Success!'); 
        })
        window.addEventListener('show-paymentForm', event => {
        $('#paymentForm').modal('show');
        })
        window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
        toastr.success(event.detail.message, 'Success!'); 
        })
        window.addEventListener('error', event => {
        toastr.error(event.detail.message, 'Error!');
        })

        window.addEventListener('success', event => {
        toastr.success(event.detail.message, 'Success!')
        })
    </script>
    <!-- jQuery -->
<script src="{{asset('Backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<!-- AdminLTE App -->



<script src="{{asset('Backend/plugins/toastr/toastr.min.js')}}"></script>


	<script src={{asset("assets/vendor/jquery/jquery-3.2.1.min.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/animsition/js/animsition.min.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/bootstrap/js/popper.js")}}></script>
        <script src={{asset("assets/vendor/bootstrap/js/bootstrap.min.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/select2/select2.min.js")}}></script>
        <script>
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            })
        </script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/daterangepicker/moment.min.js")}}></script>
        <script src={{asset("assets/vendor/daterangepicker/daterangepicker.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/slick/slick.min.js")}}></script>
        <script src={{asset("assets/js/slick-custom.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/parallax100/parallax100.js")}}></script>
        <script>
            $('.parallax100').parallax100();
        </script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/MagnificPopup/jquery.magnific-popup.min.js")}}></script>
        <script>
            $('.gallery-lb').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled:true
                    },
                    mainClass: 'mfp-fade'
                });
            });
        </script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/isotope/isotope.pkgd.min.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/sweetalert/sweetalert.min.js")}}></script>
    <!--===============================================================================================-->
        <script src={{asset("assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js")}}></script>
        <script>
            $('.js-pscroll').each(function(){
                $(this).css('position','relative');
                $(this).css('overflow','hidden');
                var ps = new PerfectScrollbar(this, {
                    wheelSpeed: 1,
                    scrollingThreshold: 1000,
                    wheelPropagation: false,
                });
    
                $(window).on('resize', function(){
                    ps.update();
                })
            });
            

        </script>
        {{-- <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
            });
        </script> --}}
    <!--===============================================================================================-->
        <script src={{asset("assets/js/main.js")}}></script>
    @livewireScripts 
    </body>
    </html> 