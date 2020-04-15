<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title> {{ $page->meta_title ?? '' }} </title>
        <meta name="description" content="{{ $page->meta_description ?? '' }}">
        <meta name="keywords" content=" {{ $page->meta_keywords ?? '' }} ">

        {{--FAVICONS--}}
        @foreach($favicons as $icon)
            <link rel="{{$icon['rel'] ?? ''}}" sizes="{{$icon['size'] ?? ''}}" href="{{$icon['href'] ? getMedia($icon['href']) : ''}}">
        @endforeach

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
    </head>
    <body data-gapi-key="{{ settings('app-setting','google_api_key') }}">
        {!! settings('ga-analytics','code') !!}
        <header>
            @yield('header')
        </header>

        @yield('body_section')

        <footer>
            @yield('footer')
        </footer>
        <link href="{{ URL::asset('assets/website/css/app.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/website/css/app-1.min.css') }}" rel="stylesheet">
        <script src="{{ url('assets/website/js/app.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    </body>
</html>
