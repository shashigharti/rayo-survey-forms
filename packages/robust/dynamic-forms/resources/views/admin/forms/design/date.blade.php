@if(isset($field->properties))
    @set('properties',json_decode($field->properties))
@endif
<div class="row dynamic-form__checkbox">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
            <label>{{$field->label}}</label>
            <span class="field_type">(Date)</span>
            <input class="form-control form-group-item datepicker" type="text" disabled>
        </div>
    </div>
</div>
