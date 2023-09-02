<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'Home Page')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- toastr js -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <!-- sweet-alert js -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->

  <div class="wrapper"> 
    <!-- Navbar -->
    @include('admin/partials/navigation')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin/partials/sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('admin_content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin/partials/footer')
  </div>
    


<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

<!-- Axios CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>




@stack('scripts')

<script>    


  @if(Session::has('message'))  
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch( type ){
      case 'info':
        toastr.info("{{ Session::get('message') }}");  
        break;
      case 'success':
        toastr.success("{{ Session::get('message') }}");   
        break;
      case 'warning':
        toastr.warning("{{ Session::get('message') }}");  
        break;
      case 'error':
        toastr.error("{{ Session::get('message') }}");  
        break;
    }  
  @endif  
</script>
</body>
</html>
