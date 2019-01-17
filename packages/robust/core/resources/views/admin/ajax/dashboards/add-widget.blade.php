@set('ui', new $ui)
{{ Form::model($model, ['route' => 'admin.dashboards.widgets.add-dashboard-widget', 'method' => $ui->getMethod($model) ]) }}
@foreach($records as $record)
    <div class="form-group form-material dashboard-modal">
        <div class="checkbox pull-left">
            {{ Form::checkbox('widget_id[]', $record->id, in_array($record->id, $dashboard_widgets)) }}
        </div>
        {{$record->name}}
    </div>
@endforeach

<div class="form-group form-material">
    {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
</div>

{{ Form::hidden('dashboard_id', $query_params['parent_id']) }}
{{ Form::close() }}