@extends('core::admin.layouts.default')

@section('content')
    @set('ui', new $ui)
    <div class="page {{ $title }}">
        <div class="page-content">
            <div class="page-title">
                <div class="rayo-breadcrumb pull-left">
                    <span><h3>{{ $title }}</h3></span>
                </div>
                <span class="create-btn clearfix pull-right">
                        @set('create_route', isset($child_ui)?$child_ui->getCreateRoute('add', ['parent_id' => $model->id]):$ui->getCreateRoute())
                    @include("core::admin.layouts.sub-layouts.partials.tables.create",
                    [
                        'ui' => isset($child_ui)?$child_ui:$ui
                    ])
                </span>
            </div>

            <div class="panel-body">
                @include("core::admin.partials.messages.info")
                @if(method_exists($ui, 'getModel'))
                    <div class="col-sm-3 pull-right">
                        {{ Form::open(['url' => route('admin.robust.search'), 'method' => 'get']) }}
                        <div class="input-group">
                            {{ Form::text('keyword', (isset($keyword))? $keyword:'', ['class' => 'form-control']) }}
                            {{ Form::hidden('model', $ui->getModel()) }}
                            <span class="input-group-btn">
                                        {{ Form::button('Search', ['type' => 'submit', 'class' => 'btn btn-primary waves-effect waves-light']) }}
                            </span>
                        </div>
                        {{ Form::close() }}
                    </div>
                @endif
                @yield('before_list')

                @include("core::admin.layouts.sub-layouts.partials.list.data", ['ui' => isset($child_ui) ? $child_ui:$ui])

                @yield('after_list')
            </div>
        </div>
    </div>
@endsection
