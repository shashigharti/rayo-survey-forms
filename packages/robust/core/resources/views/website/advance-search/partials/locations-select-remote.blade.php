<div class="mb-20 clearfix multi-select-container">
    <div class="col s12">
        <label>{{ $display_name }}</label>
        <select name="{{$attribute."[]"}}"
        data-selected="{{ implode( ',', $query_params[$attribute] ?? $default_values[$attribute] ?? [] )}}"
        data-placeholder="Select Options" multiple
        class="browser-default multi-select property_name ad-search-field"
        data-url="{{route('api.locations.type', [$attribute])}}">
            <option value="" disabled>Select Options</option>
        </select>
    </div>
</div>
