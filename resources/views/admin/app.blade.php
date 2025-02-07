<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))

    @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min2167.css?v=3.2.0">
    @endif
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper" id="app">
        <app></app>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend') }}/dist/js/adminlte2167.js?v=3.2.0"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('backend') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/demo.js"></script>
    <script src="{{ asset('backend') }}/dist/js/pages/dashboard2.js"></script>
</body>
</html>
