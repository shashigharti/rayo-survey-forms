@extends('core::admin.layouts.default')

@section('content')
    <div class="page {{$title}}">
        <div class="page--content">
            <div class="page--container form-container">
                <div class="page--title clearfix">
                    <div class="pull-left">
                        <span><h3>{{ $title }}</h3></span>
                        {!! Breadcrumb::getInstance()->render(false)  !!}
                    </div>
                </div>
                @include("core::admin.partials.tabs.tabs")
                <div class="panel">
                    <div class="panel--body">
                        <div class="form__wrapper">
                            @include("core::admin.partials.messages.info")
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

