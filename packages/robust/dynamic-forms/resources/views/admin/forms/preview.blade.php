@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="form__wrapper">
        @include("core::admin.partials.messages.info")
        <div class="col-md-12 preview--block">
            <div id='preview--container__form'></div>
                <div id="form__view" data-base-url="{{env('APP_URL')}}" data-slug="{{$model->slug}}" data-mode="readonly">

                </div>
        </div>
    </div>
@endsection














