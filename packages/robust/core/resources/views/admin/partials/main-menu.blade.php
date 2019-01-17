<div class="site-menubar">
    <ul class="nav next-nav">
        @inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
        @foreach($menu_helper->getMenus() as $index => $menu)
            @if($menu->type == 'primary')
                @can($menu->permission)
                <li class="dropdown site-menu-item has-sub inline-block">
                    <a class="dropdown-toggle" href="{{$menu->url}}" data-dropdown-toggle="false">
                        <i class="site-menu-icon {{ $menu->icon }}" aria-hidden="true"></i>
                        <span class="site-menu-title">{{$menu->display_name}}</span>
                    </a>
                </li>
                @endcan
            @endif
        @endforeach

        @yield('events_menu')
    </ul>
</div>
