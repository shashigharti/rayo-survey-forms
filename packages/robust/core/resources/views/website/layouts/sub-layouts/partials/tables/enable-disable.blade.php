@set('class', ($row['status'] == 0 )? "btn-disabled" : "theme-btn")

@set('button_enabled_text', (isset($option['enabled-text'])) ? $option['enabled-text'] : 'Enabled')
@set('button_disabled_text', (isset($option['disabled-text'])) ? $option['disabled-text'] : 'Disabled')

{{ Form::open(['url' => $ui->getTableRoute($option, ['id' => $row['id'], 'params' =>['parent_id' => isset($model)?$model->id:0]]) , 'method' => 'POST']) }}
{{ Form::button(($row['status'] == 0 )? '<i aria-hidden="true" class="site-menu-icon md-close-circle"></i> '.$button_disabled_text:'<i aria-hidden="true" class="site-menu-icon md-check-circle"></i> '.$button_enabled_text,
    [
    'type' => 'submit',
    'class'=> "btn btn-default btn-xs waves-effect waves-light ".$class ,

    ] ) }}
{{ Form::close() }}