@if(isset($indicator) && !empty($indicator))
    @if($indicator->type == 'number' )
        @set('properties',json_decode($indicator->properties, TRUE))
    @endif
@endif

<div class="indicator-property_box">
    <fieldset>
        <legend>Number Properties</legend>
        <div class="form-group form-material row">
            <div class="col-sm-6">
                {{ Form::label('placeholder', 'Minimum', ['class' => 'control-label']) }}
                {{ Form::text('properties[minimum]',  isset($properties)? $properties['minimum']:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Minimum Value',
                ]) }}
            </div>

            <div class="col-sm-6">
                {{ Form::label('field_size', 'Maximum', ['class' => 'control-label']) }}
                {{ Form::text('properties[maximum]',  isset($properties)? $properties['maximum']:'', [
                    'class'       => 'form-control',
                    'placeholder' => 'Maximum Value',
                ]) }}
            </div>
        </div>
    </fieldset>
</div>