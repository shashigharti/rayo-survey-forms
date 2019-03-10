@extends('core::admin.layouts.default')
@section('events_menu')
    <li class="{{is_active(route('admin.forms.design',[$model->id]))}} pull-right events-button btn-print">
        <a href="{{route('admin.forms.design', [$model->id])}}">Print</a>
    </li>
@endsection
@section('content')
    <div class="page">
        <div class="page-content">
            <div class="container form-container">
                @include("reports::admin.reports.partials.tabs")
                <div class="report-designer">
                    <div class="col-md-4 left-box">
                        @include('reports::admin.reports.design.partials.controlbox')
                    </div>
                    <div class="col-md-8 right-box panel-box designer__container">
                        <iframe width="100%" height="100%" src="{{route('admin.reports.preview', $model->id)}}"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection