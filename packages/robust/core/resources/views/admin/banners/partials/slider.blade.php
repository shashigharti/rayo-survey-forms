<div class='row'>
    <div class='input-field col s12'>
        {{ Form::label('header', 'Header', ['class' => 'required' ]) }}
        {{ Form::text('properties[header]', $properties->header ?? '', [
           'placeholder' => 'Add Header'
           ])
        }}
    </div>
</div>
<div class='row mt-1'>
    <div class='input-field col s12'>
        {{ Form::label('properties[locations]', 'Locations', ['class' => 'control-label' ]) }}
        {{ Form::select('properties[locations][]', [],
            $properties->locations ?? [],
            [
                'data-url' => route('api.locations.index'),
                'data-selected' => implode(',', $properties->locations ?? []),
                'class'=>'browser-default multi-select ad-search-field',
                'multiple'
            ])
        }}
    </div>
</div>
<div class='row mt-1'>
   <div class='input-field col s6'>
        {{ Form::label('property_count', 'Property Count', ['class' => 'required' ]) }}
        {{ Form::text('properties[property_count]', $properties->property_count ?? '', [
           'placeholder' => 'Add numeric value Example \'10\''
           ])
        }}
    </div>
</div>
