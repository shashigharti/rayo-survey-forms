<div class="left-menu" id="left_menu">
    <ul class="left scrollable scrollable-vertical" id="theMenu">

        @inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
        @foreach($menu_helper->getMenus() as $index => $menu)
            @if($menu->type == 'primary')
                @set('sub_menus', $menu_helper->getSubMenus($menu->id))
                @can($menu->permission)
                <div class="item-tooltip">
                    <li class="item">
                        <a href="javascript:void(0)"><i class="icon {{ $menu->icon }}" aria-hidden="true"></i></a>
                        <span class="btn-class">
                        <a class="menu_item"
                           {{ ($sub_menus->count())? 'data-toggle=collapse' :'' }} href="{{ ($sub_menus->count()) ? '#'.str_replace(' ', '',$menu->display_name) : $menu->url}}">{{$menu->display_name}}</a>
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

        // Test purpose only

        @foreach($menu_helper->getAllForms() as $form)
            <div class="item-tooltip">
                <li class="item">
                    <a href="javascript:void(0)"><i class="icon md-assignment-o" aria-hidden="true"></i></a>
                    <span class="btn-class">
                        <a class="menu_item" href="{{route('admin.userform', $form['slug'])}}">{{$form['title']}}</a>
                    </span>
                </li>
                <span class="tooltiptext tooltip-right">{{$form['title']}}</span>
            </div>
        @endforeach
    </ul>
</div>
