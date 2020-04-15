@set('beds_min',$search_settings['beds_min'] ?? '1')
@set('beds_max',$search_settings['beds_max'] ?? '5')
@set('beds_increase',$search_settings['beds_increase'] ?? '1')
<div class="mb-20">
    <div class="input-field col s6">
        <select name="beds_min" class="ad-search-field" data-selected="{{$query_params['beds_min'] ?? ''}}">
            <option value="" selected disabled>Min</option>
            @for($beds = $beds_min; $beds <= $beds_max; $beds += $beds_increase)
                <option value="{{$beds}}">{{$beds}}</option>
            @endfor
        </select>
        <label>Beds(min-max)</label>
    </div>
    <div class="input-field col s6">
        <select name="beds_max" class="ad-search-field" data-selected="{{$query_params['beds_max'] ?? ''}}">
            <option value="" selected disabled>Max</option>
            @for($beds = $beds_min; $beds <= $beds_max; $beds += $beds_increase)
                <option value="{{$beds}}">{{$beds}}</option>
            @endfor
        </select>
    </div>
</div>
