@set('square_min',$search_settings['sq_feet_min'] ?? '1')
@set('square_max',$search_settings['sq_feet_max'] ?? '5')
<div class="mb-20">
    <div class="input-field col s6">
        <select name="square_min" class="ad-search-field" data-selected="{{$query_params['square_min'] ?? ''}}">
            <option value="" selected disabled>Min</option>
            @for($square = $square_min; $square <= $square_max; $square += 1)
                <option value="{{$square}}">{{$square}}</option>
            @endfor
        </select>
        <label>Square Feet(min-max)</label>
    </div>
    <div class="input-field col s6">
        <select name="square_max" class="ad-search-field" data-selected="{{$query_params['square_max'] ?? ''}}">
            <option value="" selected disabled>Max</option>
            @for($square = $square_min; $square <= $square_max; $square += 1)
                <option value="{{$square}}">{{$square}}</option>
            @endfor
        </select>
    </div>
</div>
