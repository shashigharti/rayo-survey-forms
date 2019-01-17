<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}


    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('firebase-url', 'Firebase Url', ['class' => 'control-label' ]) }}
            {{ Form::text('firebase-url', isset($settings['firebase-url'])?$settings['firebase-url']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('firebase-key', 'Firebase Key', ['class' => 'control-label' ]) }}
            {{ Form::text('firebase-key', isset($settings['firebase-key'])?$settings['firebase-key']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('current_version', 'Current Version', ['class' => 'control-label']) }}
            {{ Form::text('current_version', isset($settings['current_version'])?$settings['current_version']:'', ['class' => 'form-control']) }}
        </div>
        <div class="col-sm-6">
            {!! Html::decode(Form::label('update_required', 'Update Required', ['class' => 'control-label' ]))  !!}
            {{ Form::hidden('update_required', 0) }}
            <label class="switch">
                {{ Form::checkbox('update_required', '1', isset($settings['update_required'])?$settings['update_required']:'') }}
                <div class="slider round"></div>
            </label>
        </div>
    </div>

    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>