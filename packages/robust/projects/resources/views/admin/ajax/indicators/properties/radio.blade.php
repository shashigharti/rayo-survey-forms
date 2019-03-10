@if(isset($indicator) && !empty($indicator))
    @if($indicator->type == 'radio' )
        @set('properties',json_decode($indicator->properties, TRUE))
    @endif
@endif

<div class="indicator-property_box">
    <fieldset>
        <legend>Radio Button Properties</legend>
        <div class="form-group form-material row">
            <div class="col-sm-12">
                {{ Form::label('options', 'Options', ['class' => 'control-label']) }}
                {{ Form::text('properties[options]', isset($properties)? $properties['options']:'', [
                 'class'       => 'form-control token-field token-options',
                 'placeholder' => 'Comma Separated Value For Options E.g, Male,Female',
                 'data-role'   => 'tagsinput',
                 ]) }}
            </div>
        </div>
    </fieldset>
</div>