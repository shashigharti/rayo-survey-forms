<div class="row dynamic-form__file">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
            <label >{{$field->label}}(File)</label>
            {{ Form::file($field->id, array('class' => 'form-control file-form-control form-upload-file')) }}
        </div>
    </div>
</div>
