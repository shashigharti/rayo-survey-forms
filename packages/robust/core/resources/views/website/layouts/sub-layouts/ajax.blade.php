@extends('core::admin.layouts.default')

@section('content')
    <div class="page {{$title}}">
        <div class="page-content">
            <div class="container">
                <div class="page-title text-center">
                    <span>{{ $title }}</span>
                </div>
                <div class="panel-box panel-default">
                    @yield('ajax_view')
                </div>
            </div>
        </div>
    </div>
@endsection
