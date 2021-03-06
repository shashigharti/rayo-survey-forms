{!! Form::open(['url' => $ui->getTableRoute($option, ['id' => $row['id'], 'params' =>array_merge(['parent_id' => isset($model)?$model->id:0], $extra_params)]) , 'method' => 'DELETE']) !!}
{!! Form::button( $option['display_name'],
    [
    'type' => 'button',
    'class'=> "btn btn-small btn-delete amber waves-effect modal-trigger",
    'href' => '#confirmDelete',
    'data-title' => isset($option['data_title'])?$option['data_title']:'Delete Row',
    'data-message' =>  isset($option['data_message'])?$option['data_message']:'Are you sure you want to delete?'
    ] ) !!}
{!! Form::close() !!}


