@extends('core::admin.layouts.sub-layouts.create')
@set('ui', new $ui)

@section('form')
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('name', 'Dashboard Name', ['class' => 'control-label required' ]) }}
            {{ Form::text('name', null, [
                    'class'       => 'form-control name',
                    'placeholder' => 'Dashboard Name i.e. \'My Dashboard\'',
                    'required'    => 'required',
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('slug', 'Slug', ['class' => 'required control-label' ]) }}
            {{ Form::text('slug', null, [
                'class'       => 'form-control slug',
                'placeholder' => 'slug i.e. \'slug\''
            ]) }}
        </div>
    </div>
    <div class="form-group form-material">
        {{ Form::label('description', 'Description', ['class' => 'required control-label' ]) }}
        {{ Form::textarea('description', null, [
               'class'       => 'form-control editor',
               'placeholder' => 'Project Description'
           ]) }}
    </div>
    {{ Form::hidden('user_id', \Auth::user()->id) }}
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
@endsection