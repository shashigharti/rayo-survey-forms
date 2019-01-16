<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }}">
            <label>{{$field->label}}</label>
            @if(isset($field->properties))
                @set('properties',json_decode($field->properties))
            @endif
            <span class="field_type">( Short Question )</span>

            @if(isset($properties->target) && $properties->target > 0)
                <div class="target form-group-item">Target: {{$properties->target}}</div>
            @endif
            <input class="form-control form-group-item" type="text" disabled>

        </div>
    </div>
</div>
