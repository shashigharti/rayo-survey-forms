@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="container preview-page">
        @include("core::admin.partials.messages.info")
        <div class="col-md-12 preview--block">
            <div id='preview--container__form' data-form-components="{{$model->properties}}" ></div>
        </div>
    </div>
@endsection














