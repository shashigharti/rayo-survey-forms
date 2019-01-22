@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    <div class="page {{$title}}">
        <div class="page-content">
            <div class="container">
                @if(isset($ui->left_menu))
                    <div class="page-title">
                        <div class="rayo-breadcrumb pull-left">
                            <span><h3>{{ $title }}</h3></span>
                            {!! Breadcrumb::getInstance()->render(false)  !!}
                        </div>
                        @section('create-btn')
                            <span class="create-btn">
                            @include("core::admin.layouts.sub-layouts.partials.tables.create",
                            [
                                'ui' => isset($child_ui)?$child_ui:$ui
                            ])
                        </span>
                        @show
                    </div>

                @endif
                @yield('custom_title')
                @include("core::admin.partials.tabs.tabs")
                <div class="panel form-panel">
                    <div class="panel-body">
                        @include("core::admin.partials.messages.info")
                        @yield('custom_design')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

