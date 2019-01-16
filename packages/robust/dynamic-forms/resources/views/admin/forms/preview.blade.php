@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')

    <div class="container preview-page">
        @include("core::admin.partials.messages.info")
        <div class="col-md-10 preview--container">
            <div class="{{ ($model->theme != '') ? $model->theme : 'default-theme' }}" id="theme_preview">
                <div class="panel-body panel-box dynamic__form-container form__wrapper default-form"
                >

                    <div class="form__content clearfix scrollable-vertical scrollable is-enabled">
                        <div id="message_handler">

                        </div>
                        <div class="theme-title">
                            <span>Form Title</span>
                        </div>
                        <div class="form__field clearfix">
                            {!! Shortcode::compile("[dyn-form preview = true]{$model->title}[/dyn-form]")  !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2 theme--panel pull-right">
            <div class="panel-box">
                <h3 class="panel-heading">Themes</h3>
                <ol class="theme-list text-center" id="theme">
                    <a href="#" class="clearfix" data-class="default-theme"
                       data-url="{{ route('admin.forms.theme', $model->id) }}"
                    >
                        <li><img src="{{ url('assets/images/default.png') }}" alt="">
                            <p>Default Theme</p></li>
                    </a>
                    <a href="#" class="clearfix" data-class="dark-theme"
                       data-url="{{ route('admin.forms.theme', $model->id) }}"
                    >
                        <li><img src="{{ url('assets/images/dark.png') }}" alt="">
                            <p>Dark Theme</p></li>
                    </a>
                    <a href="#" class="clearfix" data-class="night-theme"
                       data-url="{{ route('admin.forms.theme', $model->id) }}">
                        <li><img src="{{ url('assets/images/night.png') }}" alt="">
                            <p>Night Theme</p></li>
                    </a>
                </ol>
            </div>
        </div>

    </div>

@endsection














