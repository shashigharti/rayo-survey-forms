@if(isset($model) && $model->exists)
    <ul class="nav nav-tabs left-nav">
        @set('tabs', $ui->getTabs($model))
        @foreach($tabs as $title => $tab)
            @can($tab['permission'])
                <li class="{{is_active($tab['url'])}}">
                    <a href="{{$tab['url']}}">{{$title}}</a>
                </li>
            @endcan
        @endforeach
    </ul>
@endif
