@extends('core::user.layouts.default')

@section('content')
    <div class="container form-container preview-page">
        @include("core::admin.partials.messages.info")
        <div class="{{ ($model->theme != '') ? $model->theme : 'default-theme' }}" id="theme_preview">


            <div class="panel-body panel-box dynamic__form-container form__wrapper default-form">

                <div class="form__content clearfix">
                    <div class="form__field clearfix">
                        {!! Shortcode::compile("[dyn-form]{$model->title}[/dyn-form]")  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection