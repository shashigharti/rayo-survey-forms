@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    <div id="main" class="page {{$title}}">
        <div class="row">
            <div class="container">
                <div class="row breadcrumbs-inline" id="breadcrumbs-wrapper">
                    {!! Breadcrumb::getInstance()->render()  !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            @include("core::admin.partials.tabs.tabs")
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="panel card tab__content">
                                @include("core::admin.partials.messages.info")
                                @yield('custom_design')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

