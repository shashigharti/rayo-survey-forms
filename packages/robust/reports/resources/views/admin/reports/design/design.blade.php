@extends('core::admin.layouts.default')
@section('events_menu')
    <li class="{{is_active(route('admin.forms.design',[$model->id]))}} pull-right events-button btn-print">
        <a href="{{route('admin.forms.design', [$model->id])}}">Print</a>
    </li>
@endsection
@section('content')
    <link href="{{ URL::asset('assets/email-templates/foundation-emails.css') }}" rel="stylesheet">
    <div class="page">
        <div class="section-content">
            <div class="container form-container">
                @include("reports::admin.reports.partials.tabs")
                <div class="report-designer">
                    <div class="col-md-3 left-box">
                        @include('reports::admin.reports.design.partials.controlbox')
                    </div>
                    <div class='panel-box col-md-8 right-box'>
                        <div class='designer__container'
                             data-update-url="{{ route('admin.designer.template.update',[$model->id]) }}"
                             data-add-url="{{ route('admin.report-designer.element.add',[$model->id]) }}"
                             data-controlbox-url="{{ route('admin.designer.controlbox') }}"
                        >
                            {!!  $model->template !!}
                        </div>
                        @include('reports::admin.reports.design.partials.image-editor')
                        @include('reports::admin.reports.design.partials.section-dialog')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
