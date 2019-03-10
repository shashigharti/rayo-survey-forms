@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('name', 'Name', ['class' => 'control-label required' ]) }}
            {{ Form::text('name', null, [
                    'class'       => 'form-control name',
                    'placeholder' => 'Target Name i.e. \'Farmer Association\'',
                    'required'    => 'required',
                    'data-slug' => 'slug'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('type', 'Type', ['class' => 'control-label required' ]) }}
            {{ Form::select('type', $model->getTypes(), [
                    'class'       => 'form-control name',
                    'required'    => 'required'
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
















