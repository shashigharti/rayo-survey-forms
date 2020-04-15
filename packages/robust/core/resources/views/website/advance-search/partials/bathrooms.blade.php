@set('baths_min',$search_settings['baths_min'] ?? '1')
@set('baths_max',$search_settings['baths_max'] ?? '5')
@set('baths_increase',$search_settings['baths_increase'] ?? '1')
<div class="mb-20">
    <div class="input-field col s6">
        <select name="bathrooms_min" class="ad-search-field" data-selected="{{$query_params['bathrooms_min'] ?? ''}}">
            <option value="" selected disabled>Min</option>
            @for($baths = $baths_min; $baths <= $baths_max; $baths += $baths_increase)
                <option value="{{$baths}}">{{$baths}}</option>
            @endfor
        </select>
        <label>Bathrooms(min-max)</label>
    </div>
    <div class="input-field col s6">
        <select name="bathrooms_max" class="ad-search-field" data-selected="{{$query_params['bathrooms_max'] ?? ''}}">
            <option value="" selected disabled>Max</option>
            @for($baths = $baths_min; $baths <= $baths_max; $baths += $baths_increase)
                <option value="{{$baths}}">{{$baths}}</option>
            @endfor
        </select>
    </div>
</div>
