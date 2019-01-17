@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @set('ui', new $ui)
    {{ Form::model($model, ['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {!! Form::label('from', 'From', ['class' => 'control-label required' ])  !!}
            {{ Form::text('from', null, ['class' => 'form-control', 'placeholder' => 'Redirect From..']) }}
        </div>

        <div class="col-sm-6">
            {!! Form::label('to', 'To', ['class' => 'control-label required' ])  !!}
            {{ Form::text('to', null, ['class' => 'form-control', 'placeholder' => 'Redirect To..']) }}
        </div>
    </div>

    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
@endsection