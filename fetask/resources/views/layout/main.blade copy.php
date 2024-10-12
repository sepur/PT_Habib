<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HMA</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/assets') }}/images/logo.ico" />
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets') }}/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- icon -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/mdi/css/materialdesignicons.min.css">
    <!-- select2 -->

    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/css/vertical-layout-light/style.css">
    <!-- endinject -->
</head>

<body>
    <div class="container-scroller">
        <!-- partial:{{ asset('/assets') }}/partials/_navbar.html -->
        @include('layout.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('layout.navbar-setting')
            <!-- partial:{{ asset('/assets') }}/partials/_settings-panel.html -->
            @include('layout.navbar-right')
            <!-- partial -->
            <!-- partial:{{ asset('/assets') }}/partials/_sidebar.html -->
            @include('layout.sidebar')
            <!-- partial -->
            @yield('content')
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('/assets') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('/assets') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('/assets') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('/assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ asset('/assets') }}/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/assets') }}/js/off-canvas.js"></script>
    <script src="{{ asset('/assets') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('/assets') }}/js/template.js"></script>
    <script src="{{ asset('/assets') }}/js/settings.js"></script>
    <script src="{{ asset('/assets') }}/js/todolist.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page-->
    <script src="{{ asset('/assets') }}/js/dashboard.js"></script>
    <script src="{{ asset('/assets') }}/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
    <!-- Modal -->
    {{-- <script src="{{ asset('/assets') }}/vendors/modal/bootstrap.min.js"></script> --}}
    {{-- Upload Image Form --}}
    {{-- <script src="{{ asset('/assets') }}/js/file-upload.js"></script> --}}

    <!-- select2 -->
    <script src="{{ asset('/assets') }}/vendors/js/vendor.bundle.base.js"></script>
    <script src="{{ asset('/assets') }}/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('/assets') }}/js/select2.js"></script>
</body>

</html>