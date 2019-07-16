<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kabupaten Bojonegoro</title>
    <!-- Favicon -->
    <link href=" {{ asset('../assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href=" {{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700') }}" rel="stylesheet">
    <!-- Icons -->
    <link href=" {{ asset('../assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href=" {{ asset('../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href=" {{ asset('../assets/css/argon.css?v=1.0.0') }}" rel="stylesheet">
    <link type="text/css" href=" {{ asset('../assets/css/main.css') }}" rel="stylesheet">
    <!-- Leaflet -->
    <link rel="stylesheet" href=" {{ asset('../leaflet/leaflet.css') }} ">
    <!-- Chart -->
    <link type="text/css" href=" {{ asset('../assets/css/Chart.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link type="text/css" href=" {{ asset('../assets/css/fontawesome.css') }}" rel="stylesheet">
    <link type="text/css" href=" {{ asset('../assets/css/fontawesome.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href=" {{ asset('../assets/css/bootstrap-datepicker.css') }} " />
    <!-- Core -->
    <script src="{{ asset('../assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--Leaflet-->
    <script src="{{ asset('../leaflet/leaflet.js') }}"></script>
    <!--Chart-->
    <script src="{{ asset('../assets/js/Chart.js') }}"></script>
    <script src="{{ asset('../assets/js/Chart.bundle.js') }}"></script>
    <!--Font Awesome-->
    <script src="{{ asset('../assets/js/fontawesome.js') }}"></script>
    <script src="{{ asset('../assets/js/fontawesome.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('../assets/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('../assets/js/bootstrap-datepicker.min.js') }}"></script>

</head>
<body>

    @yield('content')

</body>

</html>