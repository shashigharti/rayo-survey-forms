@extends('core::admin.layouts.default')
@section('content')
    @set('ui', new $ui)

    <div class="page">
        <div class="page-content container-fluid">
            <div class="page-title text-center">
                <span class="create-btn">
                    @set('dashboard_menu', isset($child_ui)?$child_ui->dashboard_menu:$ui->dashboard_menu)
                    <div class="pull-right">
                        <div role="group" class="media-arrangement">
                            @can($dashboard_menu['add']['permission'])
                                <a data-toggle="modal"
                                           data-modal="crudModal"
                                           data-url="{{route($dashboard_menu['add']['url'], ['parent_id' => $model->id])}}"
                                           href='javascript:void(0)'>
                                    <i aria-hidden="true" class="{{$dashboard_menu['icon'] ?? 'icon md-plus'}}"></i>
                                    <span>
                                        {{$dashboard_menu['add']['display_name']}}
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </span>
            </div>
            @foreach($widgets as  $widget)
                @include("{$widget->package_name}::admin.dashboard-widgets.{$widget->path}")
            @endforeach
        </div>
    </div>
    @include("core::admin.partials.modals.modal")
    @include("core::admin.partials.modals.crud")

@endsection
