@set('options', [])

@if(isset($properties->options))
    @set('options', $form_helper->getOptions($properties->options))
@endif
<div class="row dynamic-form__number">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group control-required">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            @if(isset($properties->target) && $properties->target > 0)
                <div class="target form-group-item">Target: {{$properties->target}}</div>
            @endif
            @foreach($options as $key => $value)
                <input type="radio"
                       name="{{ $form_field->name }}"
                       value="{{ $key }}"
                        {{ ($form_field->required) ? 'required' : "" }}
                        {{ (isset($model[$form_field->name]) && ($key == $model[$form_field->name]))? "checked" : "" }}
                        {{($form_field->required) ? 'required' : ''}}
                >
                {{ $value }}
            @endforeach
        </div>
    </div>
</div>
