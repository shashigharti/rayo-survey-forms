<div class="row dynamic-form__editor">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            {{Form::open(array('route' => ['admin.forms.fields.update',$form->id, $field->id], 'method' => 'PUT', 'class' => 'form'))}}
            <p class="description-text">{{ $field->label  }}</p>
            <div class="description-editor hidden">
                <textarea name="label" class="editor">{{ $field->label }}</textarea>
            </div>
            {{ Form::hidden('name', $field->name) }}
            {{ Form::hidden('field_name', 'Editor') }}
            {{ Form::hidden('id', $field->id) }}
            {{ Form::close()}}
        </div>
    </div>
</div>
