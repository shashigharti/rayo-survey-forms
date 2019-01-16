<fieldset data-form-id="{{ $form_id }}" data-page="{{ $page }}">
    <div class="form-bottom">

        {!! $fields_to_display !!}

        <input type="hidden" name="_previous" value="">
        <input type="hidden" name="_next" value="">


        @if(!$first)
            {{ Form::button('Previous', ['class'=> 'btn btn-previous']) }}
        @endif
        @if($last)
            @if($model['preview'] === false)
                {{ Form::submit('Submit' , ['class'=> 'btn btn-primary btn-submit btn-next']) }}
            @endif
        @else
            {{ Form::button('Next' , ['class'=> 'btn btn-primary btn-next']) }}
        @endif
    </div>
</fieldset>