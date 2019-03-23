@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    <div class="page {{$title}}">
        <div class="page--content">
            <div class="page--container">
                @if(isset($ui->left_menu))
                    <div class="page--title clearfix">
                        <div class="pull-left">
                            <span><h3>{{ $title }}</h3></span>
                            {!! Breadcrumb::getInstance()->render(false)  !!}
                        </div>
                        @section('create-btn')
                        <div>
                            @include("core::admin.layouts.sub-layouts.partials.tables.create",
                            [
                                'ui' => isset($child_ui)?$child_ui:$ui
                            ])
                        </div>
                        @show
                    </div>

                @endif
                @yield('custom_title')
                @include("core::admin.partials.tabs.tabs")
                <div class="panel">
                    <div class="panel--body">
                        @include("core::admin.partials.messages.info")
                        @yield('custom_design')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

