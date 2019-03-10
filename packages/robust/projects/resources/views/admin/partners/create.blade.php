@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
@set('ui', new $ui)
@set('parent_id', $query_params['parent_id'])

@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12 col-md-12">
            {{ Form::label('name', 'Name', ['class' => 'control-label required' ]) }}
            {{ Form::text('name', null, [
                    'class'       => 'form-control name',
                    'placeholder' => 'Name i.e. \'Sanjal\'',
                    'required'    => 'required'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12 col-md-12">
            {{ Form::label('description', 'Description', ['class' => 'control-label' ]) }}
            {{ Form::textarea('description', null, [
                    'class'       => 'form-control editor'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12 col-md-12">
            {{ Form::label('contact_person', 'Contact Person', ['class' => 'control-label' ]) }}
            {{ Form::text('contact_person', null, [
                    'class'       => 'form-control'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12 col-md-12">
            {{ Form::label('contact_number', 'Contact Number', ['class' => 'control-label' ]) }}
            {{ Form::text('contact_number', null, [
                    'class'       => 'form-control'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12 col-md-12">
            {{ Form::label('type', 'Type', ['class' => 'control-label' ]) }}
            {{ Form::select('type', $model->getTypes(), [
                    'class'       => 'form-control'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-12 col-md-12">
            {{ Form::label('location', 'Location', ['class' => 'control-label' ]) }}
            {{ Form::text('location', null, [
                    'class'       => 'form-control'
                ]) }}
        </div>
    </div>
    {{ Form::hidden('referer', route('admin.projects.partners.get-project-partners', [$parent_id])) }}
    {{ Form::hidden('project_id', $parent_id)}}
    <div class="form-group form-material row">
        <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
        <input class="btn btn-primary" value="Save changes" type="submit">
    </div>
    {{ Form::close() }}
@endsection
















