@if(isset($form_field->properties))
    @set('properties',json_decode($form_field->properties))
@endif

<div class="row dynamic-form__number">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group control-required">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            @if(isset($properties->target) && $properties->target > 0)
                <div class="target form-group-item">Target: {{$properties->target}}</div>
            @endif
            <input class="form-control form-group-item" type="number" step="any" name="{{ $form_field->name}}"
                   {{ ($form_field->required) ? 'required' : "" }}
                   value="{{ isset($model[$form_field->name]) ? $model[$form_field->name] : "" }}"
                   min="{{ (isset($properties->minimum)) ? $properties->minimum: '' }}"
                   max="{{ (isset($properties->maximum)) ? $properties->maximum: '' }}"
                   placeholder=" {{ (isset($properties->placeholder)) ? $properties->placeholder: '' }}">

        </div>
    </div>
</div>
