<legend>Sub Menus</legend>
<div class="row">
    <div class="col s4">
        {{ Form::label('title', 'Menu Title') }}
    </div>
    <div class="col s6">
        {{ Form::label('url', 'URL') }}
    </div>
</div>

@set('count', ($properties) ? count($properties->titles) : 0)
@if($count > 0)
    @foreach($properties->titles as $key => $menu)
        <div class="row dynamic-elem">
            <div class="input-field col s4">
                {{ Form::text('properties[titles][]', $menu, [
                   'placeholder' => 'Menu Title',
                   'required'  => 'required'
                   ])
                }}
            </div>
            <div class="input-field col s7">
                {{ Form::text('properties[urls][]', $properties->urls[$key], [
                   'placeholder' => 'Menu Url'
                   ])
                }}
            </div>
            @if($count == ($key + 1))
                <a href="#"><i class="material-icons dynamic-elem__btn dynamic-elem__add"> add </i></a>
            @else
                <a href="#"><i class="material-icons dynamic-elem__btn dynamic-elem__delete"> delete </i></a>
            @endif
        </div>
    @endforeach
@else
    <div class="row dynamic-elem">
        <div class="input-field col s4">
            {{ Form::text('properties[titles][]', '', [
                    'placeholder' => 'Menu Title',
                    'required'  => 'required'
               ])
            }}
        </div>
        <div class="input-field col s7">
            {{ Form::text('properties[urls][]', '', [
                    'placeholder' => 'Menu Url'
               ])
            }}
        </div>
        <a href="#"><i class="material-icons dynamic-elem__btn dynamic-elem__add"> add </i></a>
        <a href="#"><i class="material-icons dynamic-elem__btn dynamic-elem__delete hide"> delete </i></a>
    </div>
@endif
