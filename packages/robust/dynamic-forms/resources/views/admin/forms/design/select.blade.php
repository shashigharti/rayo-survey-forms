@if(!isset($preview_mode))
    <div class="row dynamic-form__select">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
                <label>{{$field->label}}</label>
                <span class="field_type">(Dropdown)</span>
                {{ Form::select($field->id, ['' => 'Please Select'], '', [
                        'class' => 'form-control',
                        'disabled' => 'disabled'
                        ])
                }}
            </div>
        </div>
    </div>
@else
    @set('options', [])
    @if(isset($properties->options))
        @set('options', $form_helper->getOptions($properties->options))
    @endif
    <div class="row dynamic-form__select">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
                <label>{{$field->label}}</label>
                @foreach($options as $key => $value)
                    <input type="radio" disabled>
                    {{ $value }}
                @endforeach
            </div>
        </div>
    </div>
@endif