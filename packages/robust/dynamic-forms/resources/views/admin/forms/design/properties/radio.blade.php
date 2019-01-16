@set('conditions', [])
@if(isset($field->conditions) && ($field->conditions != ""))
    @set('conditions', json_decode($field->conditions))
@endif

<div class="dynamic-form__property-box panel-box" data-url="" data-target-type="radio">
    <h4>Properties</h4>

    {{ Form::open(array('route' => ['admin.forms.fields.update', $field->id], 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} control-required">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                {{ Form::label('label', 'Question') }}
                {{ Form::text('label',  $field->label, [
                    'class'       => 'form-control',
                    'placeholder' => 'Add your Question E.g, Name of the Applicant'
                ]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} control-required">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                {{ Form::label('field_name', 'Field Name') }}
                {{ Form::text('field_name',  $field->field_name, [
                    'class'       => 'form-control',
                    'placeholder' => 'Add the field name',
                    'required' => 'required'
                ]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ $errors->has('options') ? 'has-error' : '' }} control-required">
                {{ Form::label('options', 'Options') }}
                @if(isset($field->properties))
                    @set('properties',json_decode($field->properties))
                @endif
                {{ Form::text('properties[options]', (isset($properties->options))?$properties->options:'', [
                'class'       => 'form-control token-field token-options',
                'placeholder' => 'Comma Separated Value For Options E.g, Male,Female'
                ]) }}

                {{ Form::label('target', 'Target') }}
                {{ Form::text('properties[target]', (isset($properties->target))?$properties->target:'', [
                'class'       => 'form-control',
                'placeholder' => 'Add Target E.g, 100'
                ]) }}


                {{ Form::label('required', 'Required Field') }}
                {{ Form::checkbox('required', $field->required, $field->required) }}

            </div>
        </div>
    </div>

    {{ Form::hidden('name', $field->name) }}
    {{ Form::hidden('id', $field->id) }}
    {{ Form::submit('Save', ['class' => 'btn btn-primary sign-in dynamic-form__options-save']) }}
    {{ Form::close() }}
</div>