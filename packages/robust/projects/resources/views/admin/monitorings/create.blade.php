@inject('project_helper', 'Robust\Projects\Helpers\ProjectHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])
@extends('core::admin.layouts.sub-layouts.create')
@section('form')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('name', 'Title', ['class' => 'control-label required' ]) }}
            {{ Form::text('name', null, [
                    'class'       => 'form-control name',
                    'placeholder' => 'M&E Title i.e. \' Evaluation of \'',
                    'required'    => 'required'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('stage', 'Stage', ['class' => 'control-label required' ]) }}
            {{ Form::text('stage', null, [
                    'class'       => 'form-control',
                    'required'    => 'required'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('indicator_ids', 'Indicators', ['class' => 'control-label' ]) }}
            {{ Form::select('indicator_ids[]', $project_helper->getIndicators($parent_id), null, [
                    'class'    => 'form-control',
                    'multiple' => 'multiple'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('date', 'Date', ['class' => 'control-label required' ]) }}
            {{ Form::text('date', null, [
                    'class'       => 'form-control datepicker',
                    'required'    => 'required'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('type', 'Type', ['class' => 'control-label required' ]) }}
            {{ Form::select('type', $model->getTypes(), [
                    'class'       => 'form-control',
                    'required'    => 'required'
                ]) }}
        </div>
    </div>
    {{ Form::hidden('referer', route('admin.projects.monitorings.get-project-monitorings', [$parent_id])) }}
    {{ Form::hidden('project_id', $parent_id) }}
    {{ Form::hidden('relation_type', 'indicators') }}
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{ Form::close() }}
@endsection
















