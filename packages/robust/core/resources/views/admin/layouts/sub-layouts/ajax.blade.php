@extends('core::admin.layouts.default')

@section('content')
    <div class="page {{$title}}">
        <div class="page--content">
            <div class="page--container">
                <div class="page--title text-center clearfix">
                    <span>{{ $title }}</span>
                </div>
                <div class="panel-box panel-default">
                    @yield('ajax_view')
                </div>
            </div>
        </div>
    </div>
@endsection
