<div class="system-settings__fb-analytics">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('code', 'Analytics Code', ['class' => 'control-label' ]) }}
            {{ Form::textarea('code', isset($settings['code'])?$settings['code']:'', [
                    'class' => 'form-control',
                    'rows' => 3
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('app_id', 'Facebook App ID', ['class' => 'control-label' ]) }}
            {{ Form::text('app_id', isset($settings['app_id'])?$settings['app_id']:'', [
                    'class' => 'form-control',
                    'rows' => 3
                ]) }}
        </div>

        <div class="col-sm-6">
            {{ Form::label('app_secret', 'Facebook App Secret', ['class' => 'control-label' ]) }}
            {{ Form::text('app_secret', isset($settings['app_secret'])?$settings['app_secret']:'', [
                    'class' => 'form-control',
                    'rows' => 3
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('page_id', 'Facebook Page ID', ['class' => 'control-label' ]) }}
            {{ Form::text('page_id', isset($settings['page_id'])?$settings['page_id']:'', [
                    'class' => 'form-control',
                    'rows' => 3
                ]) }}
        </div>

        <div class="col-sm-6">
            {{ Form::label('access_token', 'Facebook App Access Token', ['class' => 'control-label' ]) }}
            {{ Form::text('access_token', isset($settings['access_token'])?$settings['access_token']:'', [
                    'class' => 'form-control',
                    'rows' => 3
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('page_plugin', 'Facebook Page Plugin', ['class' => 'control-label' ]) }}
            {{ Form::textarea('page_plugin', isset($settings['page_plugin'])?$settings['page_plugin']:'', [
                    'class' => 'form-control',
                    'rows' => 3
                ]) }}
        </div>
    </div>
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>