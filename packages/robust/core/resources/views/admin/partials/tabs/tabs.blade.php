@if(isset($model) && $model->exists)
    <ul class="tabs">
        @set('tabs', $ui->getTabs($model))
        @if(count($tabs) > 0)
            @foreach($tabs as $title => $tab)
                @can($tab['permission'])
                    <li class="tab">
                        <a target="_blank" href="{{$tab['url']}}" class="{{is_active($tab['url'])}}">{{$title}}</a>
                    </li>
                @endcan
            @endforeach
        @else
            <li class="tab active"><a href="#pages"> {{ $title }} </a></li>
        @endif
    </ul>
@endif
