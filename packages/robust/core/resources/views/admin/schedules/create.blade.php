@extends('core::admin.layouts.sub-layouts.create')
@set('ui', new $ui)
@inject('schedule_helper','Robust\Core\Helpers\SchedulesHelper')

@section('form')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('lists','Command List',['class'=>'control-label']) }}
            {{ Form::select('lists', $schedule_helper->getCommands(), null, [
                'class'       => 'form-control'
            ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('command', 'Command', ['class' => 'control-label required' ]) }}
            {{ Form::text('command', null, [
                    'class'       => 'form-control',
                    'required'    => 'required',
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('interval', 'Schedule Interval', ['class' => 'required control-label' ]) }}
            {{ Form::select('interval', [
                'Select Interval',
                'everyMinute' => 'Every Minute',
                'everyFiveMinutes' => 'Every Five Minutes',
                'everyTenMinutes' => 'Every Ten Minutes',
                'everyThirtyMinutes' => 'Every Thirty Minutes',
                'hourly' => 'Hourly',
                'daily' => 'Daily',
                'weekly' => 'Weekly',
                'monthly' => 'Monthly',
                'quarterly' => 'Quarterly',
                'yearly' => 'Yearly'
            ], null, [
                'class'       => 'form-control',
                'required' => 'required'
            ]) }}
        </div>
    </div>
    <div class="form-group form-material">
        {{ Form::label('email_report', 'Email Report', ['class' => 'required control-label' ]) }}
        {{ Form::checkbox('email_report') }}
    </div>
    {{ Form::hidden('user_id', \Auth::user()->id) }}
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
@endsection