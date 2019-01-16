@set('properties', isset($field->properties)?json_decode($field->properties):[])
@set('questions', !empty($properties->questions)?$properties->questions:[])
@set('targets', !empty($properties->targets)?$properties->targets:[])

<div class="dynamic-form__property-box panel-box" data-url="" data-target-type="multi-input">
    <h4>Properties</h4>
    {{Form::open(array('route' => ['admin.forms.fields.update', $field->id], 'method' => 'PUT'))}}
    <div class="row">
        <div class="form-group {{ $errors->has('label') ? 'has-error' : '' }} {{ ($field->required) ? 'control-required' : '' }}">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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


                <div class="multiple-input">
                    {{ Form::label('questions', 'Sub Questions') }}
                    {{ Form::text('properties[questions]', '', [
                    'class'       => 'form-control',
                    'placeholder' => 'Question E.g, Did you receive the stationaries?'
                    ]) }}

                    <ul class="multiple-input__sub-questions list-group"
                        data-questions="{{implode(',', $questions)}}"
                        data-targets="{{implode(',', $targets)}}">
                        @foreach($questions as $key => $question)
                            <li class="list-group-item">
                                <input name="properties[targets][]" type="text" placeholder="Target"
                                       value="{{$targets[$key] or ''}}">
                                <input name="properties[questions][]" type="text" value="{{$question}}">
                                <button type="button"
                                        class="btn btn-icon btn-pure btn-default waves-effect waves-classic"><i
                                            class="icon md-delete" aria-hidden="true"></i></button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{ Form::checkbox('required', $field->required, $field->required)}}
                {{ Form::label('required', 'Required Field') }}
            </div>
        </div>
    </div>
    {{ Form::hidden('name', $field->name) }}
    {{ Form::hidden('id', $field->id) }}
    {{ Form::submit('Save', ['class' => 'btn sign-in dynamic-form__options-save']) }}
    {{ Form::close() }}
</div>
