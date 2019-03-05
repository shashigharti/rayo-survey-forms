@extends(Site::templateResolver('core::website.layouts.blank'))

@section('body')
    @yield('before-header')

@section('header')

@show

@yield('after-header')

@yield('before-banner')

@section('banner')
    {{--<div class="banner--default">--}}
        {{--<div class="container ">--}}
                    {{--<span class="banner__caption">--}}
                        {{--Lorem Ipsum is simply dummy text <br>--}}
                        {{--<span>of the printing and typesetting industry</span>--}}
                    {{--</span>--}}
        {{--</div>--}}
    {{--</div>--}}
@show

@yield('after-banner')

@section('breadcrumb')
@show

@yield('before-panel')

@section('panel')

    @yield('before-message')

@section('message')

@show

@yield('after-message')

<div class="container content column__content ">
    <div class="column__inner">
        @yield('before-content-title')

        @section('content-title')
            @if (isset($title))
                <h1 class="content__title">{{ $title or '' }}</h1>
            @endif
        @show

        @yield('after-content-title')

        <div class="content__content">
            @yield('before-content')

            @yield('content')

            @yield('after-content')
        </div>
    </div>
</div>

@show

@yield('after-panel')

@yield('before-footer')

@section('footer')
@show


@stop
