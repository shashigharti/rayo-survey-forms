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

        @set('secure', (env('APP_ENV') == 'production') ? true : false)

        {{ \Site::assets('assets/css/app-1.min.css', 'style', $secure) }} <!-- its for css files compiled -->
        {{ \Site::assets('assets/css/app.min.css', 'style', $secure) }}

        <!--[if lt IE 9]>
        <script src="bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <![endif]-->

        {{ \Site::assets('assets/js/app.min.js', 'script', $secure) }}

        <!-- will fix it later -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        {{ settings('g-analytics', 'script-before-head-closing') }}

    </head>
    <body>
        @include("core::admin.partials.nav")
        <aside class="sidenav-main nav-expanded nav-lock nav-collapsible navbar-full">
            <div class="brand-sidebar">
                <h1 class="logo-wrapper">
                    <a class="brand-logo darken-1" href="index.html">
                        <span class="logo-text hide-on-med-and-down">RealEstate</span>
                    </a>
                </h1>
            </div>
            @include("core::admin.partials.menus.left-menu")
        </aside>
        @yield('content')
        @include('core::admin.partials.modals.delete')
    </body>
    <script !src="">

    </script>
</html>
