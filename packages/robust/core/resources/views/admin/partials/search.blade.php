{{Form::open()}}
<div class="form-group">
    <div class="input-search">
        <input type="text" class="form-control token-field" name="{{ $field_name or ''}}" data-plugin="tokenfield"
               placeholder="Search..." tabindex="-1" style="position: absolute; left: -10000px;">
        <button type="submit" class="input-search-btn">
            <i class="icon md-search" aria-hidden="true"></i>
        </button>
    </div>
</div>
{{Form::close()}}
