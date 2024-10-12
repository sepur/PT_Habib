<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HST</title>
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


    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- icon -->

    <link rel="stylesheet" href="{{ asset('/assets') }}/vendors/mdi/css/materialdesignicons.min.css">

</head>

<body>
    <div class="container-scroller">
        <!-- partial:{{ asset('/assets') }}/partials/_navbar.html -->
        @include('layout.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            {{-- @include('layout.navbar-setting') --}}
            <!-- partial:{{ asset('/assets') }}/partials/_settings-panel.html -->
            @if (session('isLoggedIn'))
                @include('layout.navbar-right')
            @else
            @endif
            <!-- partial -->
            <!-- partial:{{ asset('/assets') }}/partials/_sidebar.html -->
            @if (session('isLoggedIn'))
                @include('layout.sidebar')
            @else
            @endif

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
    <script src="{{ asset('/assets') }}/js/template.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->

    <!-- endinject -->

    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
    <!-- Modal -->
</body>

</html>
