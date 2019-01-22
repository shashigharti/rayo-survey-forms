<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{settings('general-setting','company_name')}}</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    @set('secure', (env('APP_ENV') == 'production') ? true : false)

    {{ \Site::assets('assets/css/app.min.css', 'style', $secure) }}
    {{ \Site::assets('assets/css/app-1.min.css', 'style', $secure) }}


    <!--[if lt IE 9]>
    <script src="bower_components/html5shiv/dist/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="https://maps.googleapis.com/maps/api/js??v=3.20&key=AIzaSyBUbWfDsWf233pxg2bvc7zl9at-tDH6hRk">
    </script>
    {{ \Site::assets('assets/js/app.min.js', 'script', $secure) }}
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    {!! settings('contact-setting', 'g-analytics') !!}

</head>
<body class="default-theme">
@include("core::admin.partials.nav")
@include("core::admin.partials.menus.left-menu")
@yield('content')
@include("core::admin.partials.footer")
@include("core::admin.medias.ajax.media")
@include("core::admin.partials.modals.modal")
@include("core::admin.partials.modals.crud")
@include("core::admin.partials.modals.content_modal")
@include("core::admin.medias.ajax.media")

</body>
</html>
