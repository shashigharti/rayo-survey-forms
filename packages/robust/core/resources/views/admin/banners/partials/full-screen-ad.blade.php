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
<div class="row">
    <div class="input-field col s6">
        {{ Form::label('button_text', 'Button Text', ['class' => 'required' ]) }}
        {{ Form::text('properties[button_text]', $properties->button_text ?? '', [
           'placeholder' => 'Button Text',
           'required'  => 'required'
           ])
        }}
    </div>
    <div class="input-field col s6">
        {{ Form::label('button_url', 'Button URL', ['class' => 'required' ]) }}
        {{ Form::text('properties[button_url]', $properties->button_url ?? '', [
           'placeholder' => 'Button URL'
           ])
        }}
    </div>
</div>
