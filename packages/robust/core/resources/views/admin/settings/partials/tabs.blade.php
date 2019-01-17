<ul class="nav nav-tabs setting-nav">
    @foreach($all_settings as $setting)
        <li class="{{is_active(route('admin.settings.edit', [$setting->slug]))}}">
            <a href="{{route('admin.settings.edit',$setting->slug)}}">{{$setting->display_name}}</a>
        </li>
    @endforeach
</ul>
