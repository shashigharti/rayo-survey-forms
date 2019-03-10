@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('name', 'Output Name', ['class' => 'control-label' ]) }}
            {{ Form::text('name', null, [
                    'class'       => 'form-control name',
                    'placeholder' => 'Project Name i.e. \' Increase Literacy by 10%\'',
                    'required'    => 'required',
                    'data-slug' => 'slug'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('assumption', 'Assumption', ['class' => 'control-label required' ]) }}
            {{ Form::text('assumption', null, [
               'class'       => 'form-control editor',
               'placeholder' => 'Assumptions for Output',
           ]) }}
        </div>
    </div>
    {{ Form::hidden('referer', route('admin.projects.targets.get-project-targets', [$parent_id])) }}
    {{ Form::hidden('project_id', $parent_id) }}
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{ Form::close() }}
@endsection
