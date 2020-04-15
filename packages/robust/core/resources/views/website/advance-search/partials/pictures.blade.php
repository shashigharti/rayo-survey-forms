<div class="mb-20">
    <p>
        <label>Pictures</label>
    </p>
    <p>
        <label>
            <input name="picture_status" type="checkbox" 
            {{ isset($query_params['picture_status']) ? 'checked':'' }}
            />
            <span>Only show properties with photos</span>
        </label>
    </p>
</div>
