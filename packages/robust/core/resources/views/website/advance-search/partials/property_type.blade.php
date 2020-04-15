@set('settings', settings('advance-search'))
@set('params', $query_params['property_type'] ?? $default_values['property_type'] ?? [])
<div class="mb-20 select-all__container">
    <p>
        <label>Type of property</label>
    </p>
    @foreach(sort_array_by_array($settings['property_types'], explode(',', $settings['property_types_order']) ?? []) as $property)
        <p>
            <label>
                <input name="property_type[]" value="{{ $property }}" type="checkbox"
                        {{ (in_array($property, $params)) ? 'checked':'' }}
                />
                <span>{{ $property }}</span>
            </label>
        </p>
    @endforeach
    <p>
        <label>
            <input name="property_type[]" type="checkbox" value="Select All"
                {{ (isset($query_params['property_type']) && in_array('Select All', $query_params['property_type'])) ? 'checked':'' }}
            />
            <span>Select All</span>
        </label>
    </p>
</div>

