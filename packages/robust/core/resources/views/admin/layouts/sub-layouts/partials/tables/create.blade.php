@set('left_menus', $ui->left_menu)
@foreach($left_menus as $key => $menu)
    <div class="pull-right">
        <div role="group" class="media-arrangement">
            @can($menu['permission'])
            <a
                    @if(isset($ui->isModal) && $ui->isModal)
                    data-toggle="modal"
                    data-modal="crudModal"
                    data-title="{{ $ui->getTitle()  }}"

                    data-url="{{isset($child_ui)?$ui->getCreateRoute($key, ['parent_id' => $model->id]):$ui->getCreateRoute($key)}}"
                    href='javascript:void(0)'
                    @else
                    href="{{isset($child_ui)?$ui->getCreateRoute($key, ['parent_id' => $model->id]):$ui->getCreateRoute($key)}}"
                    @endif
                    >
                <i aria-hidden="true" class="{{$menu['icon'] ?? 'icon md-plus'}}"></i><span>{{$menu['display_name']}}</span>
            </a>
            @endcan
        </div>
    </div>
@endforeach
