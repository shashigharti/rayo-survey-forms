@extends('core::admin.layouts.default')
@section('content')
    @set('ui', new $ui)

    <div class="page">
        <div class="page-content container-fluid">
            <div class="page-title text-center">
                    <span class="create-btn">
                        @include("core::admin.layouts.sub-layouts.partials.tables.create",
                        [
                            'ui' => isset($child_ui)?$child_ui:$ui
                        ])
                    </span>
            </div>
            @foreach($dashboard->widgets as  $widget)
                @include("core::admin.dashboard-widgets.{$widget->name}")
            @endforeach
        </div>
    </div>
    @include("core::admin.partials.modals.modal")
    @include("core::admin.partials.modals.crud")

@endsection