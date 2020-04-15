@set('right_menus', $ui->right_menu)
@foreach($right_menus as $key => $menu)
    @can($menu['permission'])
        <a class="btn btn-floating waves-effect waves-light gradient-45deg-purple-deep-orange breadcrumbs-btn right" 
            href="{{isset($child_ui)?$ui->getCreateRoute($key, ['parent_id' => $model->id]):$ui->getCreateRoute($key)}}"
        >
            <i class="material-icons">{{$menu['icon']}}</i>
        </a>
    @endcan
@endforeach
