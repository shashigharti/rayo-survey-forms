<div class="row dynamic-form__email">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div id="file_error">
        </div>
        <div class="form-group">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            {{ Form::file($form_field->name,
            array('class' => 'form-control file-form-control form-upload-file', ($form_field->required) ? 'required' : '', 'id' => 'file_field', 'data-allowed' => $properties->extensions)) }}
        </div>
    </div>
</div>
