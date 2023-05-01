<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
    <!-- Datatables CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <!-- Custom CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- jQuery JS -->
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <!-- jQuery UI JS -->
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <!-- Datatables JS -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <!-- client validation JS with date validation -->
    <script src="{{ asset('assets/js/just-validate.production.min.js') }}"></script>
    <script src="{{ asset('assets/js/just-validate-plugin-date.production.min.js') }}"></script>

</head>
<body>
    @yield('content')
</body>
</html>
