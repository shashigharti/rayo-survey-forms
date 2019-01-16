@if(isset($field->properties))
    @set('properties',json_decode($field->properties))
@endif
<div class="row dynamic-form__number">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
            <label>{{$field->label}}</label>
            <span class="field_type">(Number)</span>
            <input class="form-control form-group-item" type="number" disabled>

        </div>
    </div>
</div>
