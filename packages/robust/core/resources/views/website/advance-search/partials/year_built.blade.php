@set('year_min',$search_settings['year_built_min'] ?? '1900')
@set('year_max',$search_settings['year_built_max'] ?? '2020')

<div class="mb-20">
    <div class="input-field col s6" >
        <select name="year_min" data-selected="{{$query_params['year_min'] ?? ''}}" class="ad-search-field">
            <option value="" selected disabled>Min</option>
            @for($year = $year_min; $year <= $year_max; $year += 10)
                <option value="{{$year}}">{{$year}}</option>
            @endfor
        </select>
        <label>Year Built(min-max)</label>
    </div>
    <div class="input-field col s6">
        <select name="year_max" data-selected="{{$query_params['year_max'] ?? ''}}" class="ad-search-field">
            <option value="" selected disabled>Max</option>
            @for($year = $year_min; $year <= $year_max; $year += 10)
                <option value="{{$year}}">{{$year}}</option>
            @endfor
        </select>
    </div>
</div>
