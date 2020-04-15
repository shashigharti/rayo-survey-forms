@set('price_min',$search_settings['data']['prices'][0] ?? 2500)
@set('price_max', $search_settings['data']['prices'][1] ?? 100000)
@set('price_increase',$search_settings['data']['increments'][0] ?? 2500)
<div class="mb-20">
    <div class="input-field col s6">
        <select name="price_min" class="ad-search-field" data-selected="{{$query_params['price_min'] ?? ''}}">
            <option value="" selected disabled>Min</option>
            @for($price = $price_min; $price <= $price_max; $price += $price_increase)
                <option value="{{$price}}">${{$price}}</option>
            @endfor
        </select>
        <label>Price(min-max)</label>
    </div>
    <div class="input-field col s6">
        <select name="price_max" class="ad-search-field" data-selected="{{$query_params['price_max'] ?? ''}}">
            <option value="" selected disabled>Max</option>
            @for($price = $price_min; $price <= $price_max; $price += $price_increase)
                <option value="{{$price}}">${{$price}}</option>
            @endfor
        </select>
    </div>
</div>
