@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    <div class="page {{ $title }}">
        <div id="main" class="content">
            <div class="row">
                <div class="container">
                    <div class="row breadcrumbs-inline" id="breadcrumbs-wrapper">
                        {!! Breadcrumb::getInstance()->render()  !!}
                        <div class="col s2 m6 l6 right--button">
                            @section('left_menu')
                                @if(isset($ui->right_menu))
                                    <span class="create-btn clearfix pull-right">
                                        @include("core::admin.layouts.sub-layouts.partials.tables.create",
                                        [
                                            'ui' => isset($child_ui)?$child_ui:$ui
                                        ])
                                    </span>
                                @endif
                            @show
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content__table">
                    <div class="container">
                        @include("core::admin.partials.tabs.tabs")
                         @include("core::admin.partials.messages.info")

                        @if(method_exists($ui, 'getModel'))
                            <div class="col s6">
                                {{ Form::open(['url' => route($ui->getSearchURL()), 'method' => 'get']) }}
                                    <div class="input-group row">
                                        <span class="col s3">{{ Form::select('type', $ui->getSearchable(), null) }}</span>
                                        <span class="pull-left">{{ Form::text('keyword', (isset($keyword))? $keyword:'', ['class' => 'form-control']) }}</span>
                                        <span class="input-group-btn">
                                            {{ Form::button('Search', ['type' => 'submit', 'class' => 'btn theme-btn']) }}
                                        </span>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        @endif
                        @yield('before_table')

                        @include("core::admin.layouts.sub-layouts.partials.tables.table-data", ['ui' => isset($child_ui) ? $child_ui:$ui])

                        @section('after_table')
                            @if(isset($extra_view))
                                @include($extra_view)
                            @endif
                        @show
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
