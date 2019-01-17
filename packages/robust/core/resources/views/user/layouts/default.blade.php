<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dynamic Forms</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/app-1.min.css') }}" rel="stylesheet">

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>

    <!--[if lt IE 9]>
    <script src="bower_components/html5shiv/dist/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body class="default-theme">
@include("core::user.partials.nav")


@yield('content')


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAJOS3FodOcmBc-PXI5rX57VhjnMx_7Uc"
        async defer></script>
</body>
</html>
