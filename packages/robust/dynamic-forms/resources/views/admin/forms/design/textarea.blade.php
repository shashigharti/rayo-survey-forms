<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group {{ ($field->required) ? 'control-required' : '' }} ">
            <label>{{$field->label}}</label>
            <span class="field_type">(Long Question)</span>

            <textarea class="form-control" name="{{ $field->id }}"
                      {{ ($field->required) ? "required" : "" }}
                      rows="5"
                      disabled></textarea>
        </div>
    </div>
</div>