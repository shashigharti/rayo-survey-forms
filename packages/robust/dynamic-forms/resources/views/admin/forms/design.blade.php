@extends('core::admin.layouts.sub-layouts.blank')
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
@section('custom_design')
    @inject('form_helper', 'Robust\DynamicForms\Helpers\FormHelper')
    <div class="dynamic-form dynamic-form__container" data-title="{{$model->title}}" data-slug="{{$model->slug}}" data-form-id="{{$model->id}}" data-base-url = "{{env('APP_URL')}}" data-url="{{route('admin.dynamic-forms.update', $model->id)}}" data-type="POST">
        <input type="hidden" name="id" value="{{$model->id}}">
        <div class="design--form--header">
            {{ Form::select('display', ['form' => 'form', 'wizard' => 'wizard'], $model->display, ['class' => 'dynamic-form__type']) }}
            <a href="javascript:void(0)" class="dynamic-form__save btn-success btn btn-no-radius pull-right">
                <i aria-hidden="true" class="icon md-book"></i><span>Save</span>
            </a>
        </div>
        <div id='designer'>

        </div>
    </div>
@endsection
