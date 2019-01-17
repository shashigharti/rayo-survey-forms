<ul class="nav nav-tabs">
    <li class="{{is_active(route('admin.settings.edit', ['general-setting']))}}">
        <a href="{{route('admin.settings.edit','general-setting')}}">General</a>
    </li>
    <li class="{{is_active(route('admin.settings.edit', ['email-setting']))}}">
        <a href="{{route('admin.settings.edit','email-setting')}}">Email</a>
    </li>
</ul>
