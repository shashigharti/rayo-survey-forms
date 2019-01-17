@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div>
        <div class="design--form--header">
            {{ Form::select('display', ['form' => 'form', 'wizard' => 'wizard'], null, ['class' => 'dynamic--form__type']) }}
            <a href="javascript:void(0)" class = "dynamic-form__save btn-theme pull-right"> Save </a>
        </div>
        <div id='designer' class="design--form--block"></div>
    </div>
@endsection
