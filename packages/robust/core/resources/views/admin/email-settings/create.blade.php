@extends('core::admin.layouts.sub-layouts.create')
@inject('email_setting_helper', 'Robust\Core\Helpers\EmailSettingHelper')

@section('form')
    @set('model', $model)
    @set('ui', new $ui)
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {!! Form::label('setting_name', 'Name', ['class' => 'control-label required' ])  !!}
            {{ Form::text('setting_name', $model->setting_name, [
               'class' => 'form-control '
           ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {!! Form::label('event', 'Events', ['class' => 'control-label required' ])  !!}
            {{ Form::select('event', ['Select Events'] + $email_setting_helper->getEventList(), null, [
               'class' => 'form-control '
           ]) }}
        </div>
        <div class="col-sm-6">
            {!! Form::label('email', 'Email', ['class' => 'control-label' ])  !!}
            {{ Form::text('email', $model->email, [
                  'class'       => 'form-control token-field required',
                  'placeholder' => 'Email'
              ]) }}
        </div>
    </div>
    <div class="form-group form-material">
        {{ Form::submit('Save', ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
@endsection













































