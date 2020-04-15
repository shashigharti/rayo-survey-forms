<ul class="tabs">
    @foreach($all_settings as $setting)
        <li class="tab">
            <a class="{{is_active(route('admin.settings.edit', [$setting->slug]))}}" target="_blank" href="{{route('admin.settings.edit',$setting->slug)}}">{{$setting->display_name}}</a>
        </li>
    @endforeach
</ul>
