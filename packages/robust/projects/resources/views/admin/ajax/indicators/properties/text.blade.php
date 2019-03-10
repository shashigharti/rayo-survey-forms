@if(isset($indicator) && !empty($indicator))
    @if($indicator->type == 'text' )
        @set('properties',json_decode($indicator->properties, TRUE))
    @endif
@endif


<div class="indicator-property_box">
    <fieldset>
        <legend>Text Properties</legend>
        <div class="form-group form-material row">
            <div class="col-sm-6">
                {{ Form::label('placeholder', 'Placeholder', ['class' => 'control-label']) }}
                {{ Form::text('properties[placeholder]', isset($properties)? $properties['placeholder']:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Placeholer',
                ]) }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('field_size', 'Field size', ['class' => 'control-label']) }}
                {{ Form::text('properties[field_size]', isset($properties)? $properties['field_size']:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Field Size',
                ]) }}
            </div>
        </div>
    </fieldset>
</div>