<ul class="sidenav collapsible sidenav-fixed" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
    @inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
    @foreach($menu_helper->getMenus() as $index => $menu)
        @if($menu->type == 'primary')
            @set('sub_menus', $menu_helper->getSubMenus($menu->id))
            @can($menu->permission)
                @if(count($sub_menus) <= 0)
                    <li class="bold {{is_active($menu->url)}}">
                        <a class="waves-effect" href="{{ $menu->url }}">
                            <i class="material-icons">{{ $menu->icon }}</i>
                            <span class="menu-title" data-i18n="">
                                {{ $menu->display_name }}
                            </span>
                        </a>
                    </li>
                @else
                    <li class="bold">
                        <a class="collapsible-header waves-effect" href="#">
                            <i class="material-icons">{{ $menu->icon }}</i>
                            <span class="menu-title" data-i18n="">
                                {{ $menu->display_name }}
                            </span>
                        </a>
                        <div class="collapsible-body">
                            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                                @foreach($sub_menus as $sub_menu)
                                    @can($sub_menu->permission)
                                        <li>
                                            <a class="collapsible-body" href="{{ $sub_menu->url }}" data-i18n="">
                                                <i class="material-icons">{{ $sub_menu->icon }}</i>
                                                <span>{{ $sub_menu->display_name }}</span>
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endif
            @endcan
        @endif
    @endforeach
</ul>