<div class="system-settings__sms">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}


    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('token', 'Token', ['class' => 'control-label' ]) }}
            {{ Form::text('token', isset($settings['token'])?$settings['token']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('from', 'From', ['class' => 'control-label' ]) }}
            {{ Form::text('from', isset($settings['from'])?$settings['from']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>


    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>