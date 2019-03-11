@extends('core::admin.layouts.sub-layouts.blank')
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="design--form" data-form-id="{{$model->id}}" data-base-url = "{{env('APP_URL')}}" data-url="{{route('admin.forms.update', $model->id)}}" data-type="POST">
        <input type="hidden" name="id" value="{{$model->id}}">
        <div class="design--form--header">
            {{ Form::select('display', ['form' => 'form', 'wizard' => 'wizard'], null, ['class' => 'dynamic--form__type']) }}
            <a href="javascript:void(0)" class="dynamic-form__save btn-success btn btn-no-radius pull-right">
                <i aria-hidden="true" class="icon md-book"></i><span>Save</span>
            </a>
        </div>
        <div id='designer' class="design--form--block">

        </div>
    </div>
@endsection
