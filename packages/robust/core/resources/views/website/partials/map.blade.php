<div id="leaflet__map-container" data-zoom="10"
     style="width: 100%; height: 900px"
     class="col s12 leaflet__map-container"
>
    @foreach($records as $record)
        <p
            class="leaflet__map-items hidden"
            data-name="{{$record->name}}"
            data-latitude="{{$record->latitude}}"
            data-longitude="{{$record->longitude}}">
        </p>
    @endforeach
</div>
