<div class="system-settings__general">
    {{ Form::open(['route' => ['admin.settings.store'], 'enctype' => 'multipart/form-data', 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {!! Html::decode(Form::label('maintenance_mode', 'Maintenance Mode', ['class' => 'control-label required' ]))  !!}
            {{ Form::hidden('maintenance_mode', 0) }}
            <label class="switch">
                {{ Form::checkbox('maintenance_mode', '1', isset($settings['maintenance_mode'])?$settings['maintenance_mode']:'') }}
                <div class="slider round"></div>
            </label>
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('maintenance_type', 'Maintenance Type', ['class' => 'control-label' ]) }}
            {{ Form::select('maintenance_type', ['message_only' => 'Maintenance Mode With Message', 'completely_down' => 'Completely Down'],isset($settings['maintenance_type'])?$settings['maintenance_type']:'' ,  [
            'class' => 'form-control']) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('maintenance_message', 'Maintenance Message', ['class' => 'control-label' ]) }}
            {{ Form::textarea('maintenance_message' ,isset($settings['maintenance_message'])?$settings['maintenance_message']:'' ,  [
            'class' => 'form-control',
            'rows' => 4]) }}
        </div>
    </div>

    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>

    {{Form::close()}}
</div>
