<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APEX</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('Backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('Backend/plugins/toastr/toastr.min.css') }}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  @livewireStyles
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    @include('layouts.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{ $slot }}
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  @include('layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="{{asset('Backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('Backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Backend/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('Backend/plugins/toastr/toastr.min.js')}}"></script>
<script>
  window.addEventListener('show-form', event => {
    $('#form').modal('show');
  })
  window.addEventListener('show-large-form', event => {
    $('#largeForm').modal('show');
  })
  window.addEventListener('view-product', event => {
    $('#view-product').modal('show');
  })
  window.addEventListener('show-delete-modal', event => {
    $('#confirmationModel').modal('show');
  })
  window.addEventListener('hide-delete-modal', event => {
    $('#confirmationModel').modal('hide');
    toastr.success(event.detail.message, 'Success!');
  })
  window.addEventListener('error-delete-modal', event => {
    $('#confirmationModel').modal('hide');
    toastr.error(event.detail.message, 'Error!');
  })
  window.addEventListener('updated', event => {
    toastr.success(event.detail.message, 'Success!')
  })
</script>
<script>

  $(document).ready(function() {
    toastr.options = {
      "positionClass": "toast-bottom-right",
      "progressBar": true,
    }

    
    window.addEventListener('hide-form', event => {
      $('#form').modal('hide');
      toastr.success(event.detail.message, 'Success!'); 
    })
    window.addEventListener('hide-large-form', event => {
      $('#largeForm').modal('hide');
      toastr.success(event.detail.message, 'Success!'); 
    })
    window.addEventListener('error', event => {
      $('#form').modal('hide');
      toastr.error(event.detail.message, 'Error!'); 
    })
  });

</script>
@livewireScripts 
</body>
</html>
