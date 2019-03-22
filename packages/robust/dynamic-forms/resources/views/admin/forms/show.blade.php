@extends('core::admin.layouts.default')

@section('content')

    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    @inject('setting_helper', Robust\Core\Helpers\SettingsHelper)
    @set('ui', new $ui)

    <div class="page">

        <div class="page--container">
            <div class="panel">
                <div class="panel--body">
                    @include("core::admin.partials.messages.info")
                    @set('setting', $setting_helper->get('general-setting'))
                    <div  id="theme_preview">
                        <div class="form__wrapper">

                            <div class="col-md-6 project-info">
                                <h6>Client name : {{ Auth::user()->first_name }}</h6>
                                <h6>Form ID : {{ $model->id }}</h6>
                            </div>

                            <div class="col-md-6 text-right company-info">
                                <h6>{{ (isset($setting['company_name'])) ? $setting['company_name'] : '' }}</h6>
                                <h6>{{ (isset($setting['street_address'])) ? $setting['street_address'] : '' }}</h6>
                                <h6>{{ (isset($setting['phone_number'])) ? 'Tel no : '. $setting['phone_number'] : '' }}</h6>
                            </div>
                            <div class="form__content clearfix">
                                <div class="text-center col-md-12 clearfix form_title"><h2 class="">{{ $model->title }}</h2>
                                </div>
                                <div class="form__field clearfix col-md-12">
                                    <form id="dynamicForm">
                                        @csrf
                                        <div id="form__view" data-slug="{{$model->slug}}">

                                        </div>
                                    </form>
                                    {{--{!! Shortcode::compile("[dyn-form preview = false]{$model->title}[/dyn-form]")  !!}--}}
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
