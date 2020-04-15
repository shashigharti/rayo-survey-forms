<div class="row">
    <div class="input-field col s12">
        {{ Form::label('header', 'Header', ['class' => 'required' ]) }}
        {{ Form::text('properties[header]', $properties->header ?? '', [
           'placeholder' => 'Banner Header',
           'required'  => 'required'
           ])
        }}
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        {{ Form::label('content', 'Content', ['class' => 'required' ]) }}
        {{ Form::textarea('properties[content]', $properties->content ?? '', [
           'placeholder' => 'Banner Content'
           ])
        }}
    </div>
</div>
