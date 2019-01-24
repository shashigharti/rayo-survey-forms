@extends('core::admin.layouts.default')
@section('content')


    <div class="page Dashboards">
        <div class="page-content">
            <div class="container">
                <div class="page-title">
                </div>
                <div class="panel form-panel">
                    <div class="panel-body">
                            <span class="clearfix pull-left">
                            </span>
                        <form id="dynamicForm">
                            @csrf
                            <div id="form__show">

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>




    {{--<div class="container form-container preview-page">--}}
    {{--@include("core::admin.partials.messages.info")--}}
    {{--<div class="panel-body panel-box dynamic__form-container form__wrapper default-form">--}}
    {{--<form id="dynamicForm">--}}
    {{--@csrf--}}
    {{--<div id="form__show">--}}

    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
@endsection

