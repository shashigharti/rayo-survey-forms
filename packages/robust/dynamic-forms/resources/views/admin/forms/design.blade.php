@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="design--form" data-title="{{$model->title}}" data-slug="{{$model->slug}}" data-form-id="{{$model->id}}" data-base-url = "{{env('APP_URL')}}" data-url="{{route('admin.forms.update', $model->id)}}" data-type="POST">
        <input type="hidden" name="id" value="{{$model->id}}">
        <div class="design--form--header">
            {{ Form::select('display', ['form' => 'form', 'wizard' => 'wizard'], null, ['class' => 'dynamic--form__type']) }}
            <p class="dynamic-form__save pull-right">
                <i class="fa fa-check" aria-hidden="true"></i>
                Up to date.
            </p>
        </div>
        <div id='designer' class="design--form--block">

        </div>
    </div>
@endsection
