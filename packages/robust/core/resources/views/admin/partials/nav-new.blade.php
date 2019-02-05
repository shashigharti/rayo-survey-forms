@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
<header class="site__header clearfix">
    <div class="col-sm-6 col-xs-6 site__logo">
        <a href="javascript:void(0)" class="left-smallmenu-bar">
            <i class="fa fa-bars"></i>
        </a>
        <h1>MIS</h1>
    </div>
    <div class="col-sm-6 col-xs-6 text-right right--section">
        <a href="#">
            Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </a>
        <a href="{{route('auth.logout')}}" role="menuitem"><i class="icon md-power"
                                                              aria-hidden="true"></i> Logout</a>
        <li class="settings dropdown">
            <a class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><i class="fa fa-sort-desc" aria-hidden="true"></i></a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <a href="{{ route('admin.profile.settings.edit', [Auth::user()->id, 'general']) }}"
                       role="menuitem"><i class="icon md-account"
                                          aria-hidden="true"></i> Profile</a>
                </li>

                @foreach($menu_helper->getMenus() as $index => $menu)
                    @if($menu->type == 'secondary')
                        @can($menu->permission)
                            <li>
                                <a href="{{$menu->url}}">
                                    <i class="site-menu-icon {{ $menu->icon }}" aria-hidden="true"></i>
                                    <span class="site-menu-title">{{$menu->display_name}}</span>
                                </a>
                            </li>

                            <li class="divider" role="presentation"></li>
                        @endcan
                    @endif
                @endforeach
                <li>
                    <a href="{{route('auth.logout')}}" role="menuitem"><i class="icon md-power"
                                                                          aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
        </li>
    </div>
</header>
