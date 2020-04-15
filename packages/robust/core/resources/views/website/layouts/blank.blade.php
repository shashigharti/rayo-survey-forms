<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>RealWebSystem.Real estate websites with advanced IDX handling.</title>
        <meta name="description" content="Real estate websites with advanced IDX handling.">

        {{--FAVICONS--}}
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/apple-touch-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/apple-touch-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/apple-touch-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/apple-touch-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/apple-touch-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/apple-touch-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/apple-touch-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/apple-touch-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon-180x180.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('/favicon-192x192.png') }}" sizes="192x192">
        <link rel="icon" type="image/png" href="{{ asset('/favicon-160x160.png') }}" sizes="160x160">
        <link rel="icon" type="image/png" href="{{ asset('/favicon-96x96.png') }}" sizes="96x96">
        <link rel="icon" type="image/png" href="{{ asset('/favicon-16x16.png') }}" sizes="16x16">
        <link rel="icon" type="image/png" href="{{ asset('/favicon-32x32.png') }}" sizes="32x32">
        {{--END FAVICONS--}}
        
        <script type='application/ld+json'>
            {
              "@context": "http://www.schema.org",
              "@type": "Website",
              "name": "RealWebSystem",
              "url": "http://167.71.244.240/",
              "image":"http://167.71.244.240/assets/website/images/Logo.jpg",
              "description":"Real estate websites with advanced IDX handling. Search engine optimized pages for homebuyer and home seller leads."

            }
        </script>
        <link href="{{ URL::asset('assets/website/css/landing.min.css') }}" rel="stylesheet">

        

        <!--[if lt IE 9]>
        <script src="bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <![endif]-->

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        {!! settings('fb-analytics','code') !!}
    </head>
    <body>
        {!! settings('ga-analytics','code') !!}
        @yield('body_content')
        <link href="{{ URL::asset('assets/website/css/app.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/website/css/app-1.min.css') }}" rel="stylesheet">
        <script src="{{ url('assets/website/js/app.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
       
    </body>
</html>
