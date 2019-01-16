<div class="row dynamic-form__address">
    @if(isset($field->properties))
        @set('properties',json_decode($field->properties))
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 {{ ($field->required) ? 'control-required' : '' }}">
        <label>{{$field->label}}</label>
        <span class="field_type">( Address )</span>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <span class="field_type">Street</span>
            <input class="form-control form-group-item" type="text" disabled>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <span class="field_type">State</span>
            <input class="form-control form-group-item" type="text" disabled>

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            <span class="field_type">Post Code</span>
            <input class="form-control form-group-item" type="text" disabled>

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
            @set('countries', $form_helper->getCountries())
            <span class="field_type">Country</span>

            {{ Form::select($field->id . '[3]', ['' => 'Please Select'], [] , [
                 'class' => 'form-control',
                 'disabled' => 'disabled'
             ])
            }}
        </div>
    </div>
</div>

