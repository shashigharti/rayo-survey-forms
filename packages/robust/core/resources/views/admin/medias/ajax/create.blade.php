{{ Form::model($model, ['url' => route('admin.medias.update', $model->id), 'method' => 'PUT' ]) }}
<div class="form-group form-material row">
    <div class="">
        <div class="col-sm-12">
            {!! Form::label('description', 'Alt Text', ['class' => 'control-label' ])  !!}
            {{ Form::text('description', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Image Description',
                 ]) }}
        </div>
    </div>
</div>

<div class="form-group form-material">
    {{ Form::submit('Save', ['class' => 'btn btn-dark theme-btn']) }}
</div>
{!! Form::close() !!}

