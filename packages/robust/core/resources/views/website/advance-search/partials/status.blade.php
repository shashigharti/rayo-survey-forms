@set('settings', settings('advance-search'))
@set('params', $query_params['status'] ?? $default_values['status'] ?? [])
<div class="mb-20">
    <p>
        <label>Property Status</label>
    </p>
    @foreach(sort_array_by_array($settings['property_statuses'], explode(',', $settings['property_statuses_order']) ?? []) as $status)
        <p>
            <label>
                <input name="status[]" value="{{ $status }}" type="checkbox"
                        {{ in_array('Properties for sale', $params) ? 'checked':'' }}
                />
                <span>{{ $status }}</span>
            </label>
        </p>
    @endforeach
    <p>
        <label>
            <input name="status[]" type="checkbox" value="Select All"
                {{ in_array('Select All', $params) ? 'checked':'' }}
            />
            <span>Select All</span>
        </label>
    </p>
</div>

