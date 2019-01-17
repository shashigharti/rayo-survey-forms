@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="dynamic-form">
        {{ Form::select('display', ['form' => 'form', 'wizard' => 'wizard'], null, ['class' => 'dynamic--form__type']) }}
        <a href="javascript:void(0)" class = "dynamic-form__save"> Save </a>
        <div id='designer'></div>
    </div>
@endsection
