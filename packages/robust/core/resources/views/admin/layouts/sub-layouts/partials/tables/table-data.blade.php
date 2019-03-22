<table class="table dataTables table-body">
    <thead>
    <tr>
        <th>SN</th>
        @foreach($ui->columns as $key=>$header)
            @if($key != 'options')
                @if(! is_array($header))
                    <th>{{$header}}</th>
                @else
                    <th>{{$key}}</th>
                @endif
            @else
                <th class="text-nowrap text-center">Action</th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
    @set('sn',1)
    @foreach($records as $key => $row)
        @set('row', $row->toArray())
        <tr>
            <td>{{ $sn }}</td>
            @foreach($ui->columns as $key => $header)
                @if($key == 'options')
                    @set('options', $header)
                    <td class="text-nowrap text-right">
                        @foreach($options as $key => $option)
                            @can($option['permission'])
                                @if($package != '' && View::exists("{$package}::{$current_view}.tables.{$key}"))
                                    @include("{$package}::{$current_view}.tables.{$key}",['extra_params' => (isset($option['params']))? $option['params'] : []])
                                @elseif(View::exists("core::admin.layouts.sub-layouts.partials.tables.{$key}") )
                                    @include("core::admin.layouts.sub-layouts.partials.tables.{$key}", ['extra_params' => (isset($option['params']))? $option['params'] : []])
                                @else
                                    <a class='btn btn__blue btn__small btn-{{$key}}'
                                       @if(isset($ui->isModal) && $ui->isModal && ($key == 'edit'))
                                       data-url="{{$ui->getTableRoute($option,
                                               [
                                                    'id' => $row['id'],
                                                    'params' => ['parent_id' => isset($model)?$model->id:0]
                                               ])
                                           }}"
                                       data-toggle="modal"
                                       data-modal="crudModal"
                                       href='javascript:void(0)'
                                       @else
                                       href="{{$ui->getTableRoute($option,
                                               [
                                                    'id' => $row['id'],
                                                    'params' => ['parent_id' => isset($model)?$model->id:0]
                                               ])
                                           }}"
                                            @endif
                                    >
                                        {!! $option['display_name'] !!}
                                    </a>
                                @endif
                            @endcan
                        @endforeach

                    </td>
                @else
                    @if(!is_array($header))
                        <td>{!!  $ui->getTableColumns($key, $header, $row) !!} </td>
                    @else
                        @foreach($header as $key=>$head)
                            <td>{!!  $ui->getTableColumns($key, $head, $row) !!} </td>
                        @endforeach
                    @endif
                @endif
            @endforeach
        </tr>
        @set('sn', $sn+1)
    @endforeach

    </tbody>
</table>
{{ $records->links() }}
