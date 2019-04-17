@extends('core::admin.layouts.default')

@section('content')

    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    @inject('setting_helper', Robust\Core\Helpers\SettingsHelper)
    @set('ui', new $ui)

    <div class="page">
        <div class="container view-page">
            @include("core::admin.partials.messages.info")
            @set('setting', $setting_helper->get('general-setting'))
            <div class="{{ ($model->theme != '') ? $model->theme : 'default-theme' }}" id="theme_preview">
                <div class="col-md-12 panel-body panel-box dynamic__form-container form__wrapper default-form">

                    <div class="col-md-6 project-info">
                        <h6>Client name : {{ Auth::user()->first_name }}</h6>
                        <h6>Form ID : {{ $model->id }}</h6>
                        <div class="layout-block">
                            <h6>Choose Layout</h6>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary active layout">
                                    <input type="radio" name="options" id="slider" autocomplete="off" checked> Slider
                                </label>
                                <label class="btn btn-secondary layout">
                                    <input type="radio" name="options" id="fixed" autocomplete="off"> Fixed
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 text-right company-info">
                        <h6>{{ (isset($setting['company_name'])) ? $setting['company_name'] : '' }}</h6>
                        <h6>{{ (isset($setting['street_address'])) ? $setting['street_address'] : '' }}</h6>
                        <h6>{{ (isset($setting['phone_number'])) ? 'Tel no : '. $setting['phone_number'] : '' }}</h6>
                    </div>
                    <div class="form__content clearfix">
                        <div class="text-center col-md-12 clearfix form_title">
                            <h2 class="">{{ $model->title }}</h2>
                        </div>
                        <div class="form__field clearfix col-md-12">
                            <form id="dynamicForm">
                                @csrf
                                <div id="form__view" data-base-url="{{env('APP_URL')}}" data-slug="{{$model->slug}}" class="form--slider">

                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
