@set('options', [])
@if(isset($properties->options))
    @set('options', $form_helper->getOptions($properties->options))
@endif
<div class="row dynamic-form__checkbox">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
            <label>{{$field->label}}</label>
            <span class="field_type">(Multiselect)</span>

            <div class="checkbox__options">
                @foreach($options as $key => $value)
                    <input type="checkbox" id="{{ $field->id }}" disabled>
                    {{ $value }}
                @endforeach
            </div>
        </div>
    </div>
</div>
