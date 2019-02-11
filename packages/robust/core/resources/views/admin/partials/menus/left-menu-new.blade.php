@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
<div class="left-menu" id="left-menu">
        <ul class="left left-change" id="theMenu">
            <a href="javascript:void(0)" class="left-menu-bar menu-open">
                <i class="fa arrow fa-chevron-left"></i>
            </a>

            @foreach($menu_helper->getMenus() as $index => $menu)
                @if($menu->type == 'primary')
                    @set('sub_menus', $menu_helper->getSubMenus($menu->id))
                    @can($menu->permission)
                        <div class="item-tooltip">
                            <li class="item">
                                <a href="javascript:void(0)"><i class="icon fa fa-home" aria-hidden="true"></i></a>
                                <span class="btn-class">
                        <a class="menu_item" {{ ($sub_menus->count())? 'data-toggle=collapse' :'' }} href="{{ ($sub_menus->count()) ? '#'.str_replace(' ', '',$menu->display_name) : $menu->url}}">{{$menu->display_name}}</a>
                            @if($sub_menus->count())
                                        <a class="" data-toggle="collapse"
                                           href="#{{str_replace(' ', '',$menu->display_name)}}"><i class="fa fa-plus"></i></a>
                                    @endif
                            </span>
                                <ul id="{{str_replace(' ', '',$menu->display_name)}}" class="sub-menu collapse">
                                    @foreach($sub_menus as $sub_menu)
                                        <li>
                                            <a href="{{$sub_menu->url}}">{{$sub_menu->display_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <span class="tooltiptext tooltip-right">{{$menu->display_name}}</span>
                        </div>
                    @endcan
                @endif
            @endforeach
            <div class="item-tooltip">
                <li class="item">
                    <a href="{{route('admin.userform.show.all')}}"><i class="icon fa fa-edit" aria-hidden="true"></i></a>
                    <span class="btn-class">
                        <a class="menu_item" href="{{route('admin.userform.show.all')}}">Forms</a>
                    </span>
                </li>
                <span class="tooltiptext tooltip-right">Show All Forms</span>
            </div>
        </ul>
    </div>
