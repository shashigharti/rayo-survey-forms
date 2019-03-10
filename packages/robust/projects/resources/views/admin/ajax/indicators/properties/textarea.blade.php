@if(isset($indicator) && !empty($indicator))
    @if($indicator->type == 'textarea' )
        @set('properties',json_decode($indicator->properties, TRUE))
    @endif
@endif

<div class="indicator-property_box">
    <fieldset>
        <legend>Textarea Properties</legend>
        <div class="form-group form-material row">
            <div class="col-sm-12">
                {{ Form::label('field_size', 'Field size', ['class' => 'control-label']) }}
                {{ Form::text('properties[field_size]', isset($properties)? $properties['field_size']:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Field Size',
                ]) }}
            </div>
        </div>
    </fieldset>
</div>