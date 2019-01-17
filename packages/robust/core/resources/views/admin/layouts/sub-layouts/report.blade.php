@extends('core::admin.layouts.default')

@section('content')
    <div class="page">
        <div class="page-content report-content advance-report">
            <div class="container">
                <div class="page-title">
                    <div class="pull-left">
                        <h3>{{$title}}</h3>
                    </div>
                </div>
                <div class="panel form-panel">
                        @yield('report_body')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection