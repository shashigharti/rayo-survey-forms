@set('image',$properties['image'] ? getMedia($properties['image'])  : '')
@if($properties)
    <div class="col m{{ $col }} s12">
        <div class="single-block">
            <img src="{{ $image }}" alt="{{ $properties['header'] ?? ''}}">
            <div class="figcaption center-align">
                <h2>{{ $properties['header'] ?? '' }}</h2>
                <p>{{ $properties['content'] ?? '' }}</p>
            </div>
        </div>
    </div>
@endif

