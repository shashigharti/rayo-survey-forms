<div class="row dynamic-form__textarea">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label for="{{$form_field->name}}" class="{{ ($form_field->required) ? 'required' : '' }}">{{$form_field->label}}</label>
            <textarea class="form-control" name="{{ $form_field->name }}"
                      {{ ($form_field->required) ? "required" : "" }}
                      rows="5"
                      maxlength="{{ (isset($properties->field_size)  && $properties->field_size > 0) ? $properties->field_size: '' }}"
                      placeholder="{{ (isset($properties->placeholder)) ? $properties->placeholder: '' }}">{{ isset($model[$form_field->name]) ? trim($model[$form_field->name]) : "" }}</textarea>
        </div>
    </div>
</div>