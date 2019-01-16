<div class="dynamic-form__property-box panel-box" data-url="" data-target-type="text">
    <h4>Properties</h4>
    {{Form::open(array('route' => ['admin.forms.fields.update', $field->id], 'method' => 'PUT'))}}
    <div class="row">
        <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} {{ ($field->required) ? 'control-required' : '' }}">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @if(isset($field->properties))
                    @set('properties',json_decode($field->properties))
                @endif
                    {{ Form::label('label', 'Question') }}
                    {{ Form::text('label',  $field->label, [
                        'class'       => 'form-control',
                        'placeholder' => 'Add your Question E.g, Name of the Applicant',
                        'required' => ($field->required) ? 'required' : ''
                    ]) }}
                {{ Form::label('field_name', 'Field Name') }}
                {{ Form::text('field_name',  $field->field_name, [
                    'class'       => 'form-control',
                    'placeholder' => 'Add the field name',
                ]) }}

                {{ Form::label('placeholder', 'Placeholder') }}
                {{ Form::text('properties[placeholder]',  (isset($properties->placeholder))?$properties->placeholder:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Placeholer',
                ]) }}


                {{ Form::label('field_size', 'Field size') }}
                {{ Form::text('properties[field_size]',  (isset($properties->field_size))?$properties->field_size:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Field Size',
                ]) }}


                {{ Form::label('required', 'Required Field') }}
                {{ Form::checkbox('required', $field->required, $field->required)}}

            </div>
        </div>
    </div>
    {{ Form::hidden('name', $field->name) }}
    {{ Form::hidden('id', $field->id) }}
    {{ Form::submit('Save', ['class' => 'btn sign-in dynamic-form__options-save']) }}
    {{ Form::close() }}
</div>
 