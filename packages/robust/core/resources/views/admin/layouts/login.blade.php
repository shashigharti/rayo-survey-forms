<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{settings('general-setting','company_name')}}</title>
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

    <!--[if lt IE 9]>
    <script src="bower_components/html5shiv/dist/html5shiv.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="bower_components/respond/dist/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script src="bower_components/modernizr/dist/modernizr.js"></script>
    <script src="bower_components/breakpoint/jquery.breakpoints.js"></script>

    {!! settings('contact-setting', 'g-analytics') !!}

</head>

<body class="page-login-v3 layout-full"
      @if(settings('general-setting', 'login_page_image') != '') style="background: url({{settings('general-setting', 'login_page_image')}});" @endif>
@yield('content')
<script src="{{ URL::asset('assets/js/core.js') }}"></script>
</body>
</html>
