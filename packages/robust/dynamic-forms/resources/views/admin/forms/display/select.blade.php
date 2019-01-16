@set('options', [])
@if(isset($properties->options))
    @set('options', $form_helper->getOptions($properties->options))
@endif

<div class="row dynamic-form__select">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="form-group control-required">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            @if(isset($properties->target) && $properties->target > 0)
                <div class="target form-group-item">Target: {{$properties->target}}</div>
            @endif
            {{ Form::select($form_field->name, ['' => 'Please Select'] + $options, (isset($model[$form_field->name])) ? $model[$form_field->name] : "", [
                    'class' => 'form-control',
                    ($form_field->required) ? 'required' : ''
                    ])
            }}
        </div>
    </div>
</div>
