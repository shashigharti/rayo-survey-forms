@inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
<div class="left-menu" id="left-menu">
        <ul class="left left-change" id="theMenu">
            <a href="javascript:void(0)" class="left-menu-bar menu-open">
                <i class="fa arrow fa-chevron-left"></i>
            </a>
            @foreach($menu_helper->getAllForms() as $form)
                <div class="item-tooltip">
                    <li class="item">
                        <a href="javascript:void(0)"><i class="icon fa fa-home" aria-hidden="true"></i></a>
                        <span class="btn-class">
                        <a class="menu_item" href="{{route('admin.userform', $form['slug'])}}">{{$form['title']}}</a>
                    </span>
                    </li>
                    <span class="tooltiptext tooltip-right">{{$form['title']}}</span>
                </div>
            @endforeach
        </ul>
    </div>
