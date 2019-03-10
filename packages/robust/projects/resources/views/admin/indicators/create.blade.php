@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

@extends('core::admin.layouts.sub-layouts.create')
{{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('parent_id', 'Parent Indicator', ['class' => 'control-label' ]) }}
            {{ Form::select('parent_id', [0 => ''] + $project_helper->getIndicators($parent_id), 0, [
               'class'       => 'form-control'
           ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('name', 'Indicator', ['class' => 'control-label required' ]) }}
            {{ Form::text('name', null, [
                    'class'       => 'form-control name',
                    'placeholder' => 'Indicator i.e. \' Marks Received\'',
                    'required'    => 'required'
                ]) }}
        </div>
    </div>
    @include("projects::admin.indicators.partials.{$query_params['type']}")
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('type', 'Type', ['class' => 'control-label required' ]) }}
            {{ Form::select('type', $model->getTypes(), 0, [
               'class'       => 'form-control'
           ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('baseline', 'Baseline Value', ['class' => 'control-label' ]) }}
            {{ Form::text('baseline', null, [
               'class'       => 'form-control'
           ]) }}
        </div>
    </div>
    {{ Form::hidden('properties', '{}') }}
    {{ Form::hidden('referer', route('admin.projects.log-frame', [$parent_id])) }}
    {{ Form::hidden('project_id', $parent_id) }}
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{ Form::close() }}
@endsection

