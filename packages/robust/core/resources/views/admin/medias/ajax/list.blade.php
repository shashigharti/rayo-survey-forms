<div class="row">
    @foreach($data as $each)
        <div class="col-sm-2">
            <div class="media-image" data-model="{{ $each }}" data-media-id="{{ $each->id }}">
                <img src="{{ \Asset::images()->getImage($each->id, 'small')}}" alt="">

            </div>
            <div class="media-name">
                <h5>{{$each->name}}</h5>
            </div>
        </div>
    @endforeach
</div>
