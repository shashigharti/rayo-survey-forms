<div class="mb-20">
    <div class="input-field col s12">
        <select name="stories" class="ad-search-field" data-selected="{{$query_params['stories'] ?? ''}}">
            <option value="" selected disabled>Select Options</option>
            @for($min = 1; $min <= 10;$min++ )
                <option value="{{$min}}">{{$min}} Story</option>
            @endfor
        </select>
        <label>Stories</label>
    </div>
</div>