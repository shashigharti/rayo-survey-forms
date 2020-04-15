<div class="row">
     <div class="input-field col s6">
         {{ Form::label('header', 'Header', ['class' => 'required' ]) }}
         {{ Form::text('header', null, [
            'placeholder' => 'Banner Header',
            'required'  => 'required'
            ])
         }}
     </div>
     <div class="input-field col s6">
         {{ Form::label('content', 'Content', ['class' => 'required' ]) }}
         {{ Form::text('content', null, [
            'placeholder' => 'Banner Content'
            ])
         }}
     </div>
</div>
<div class="row">
    <div class="input-field col s6">
        Images
    </div>
</div>
