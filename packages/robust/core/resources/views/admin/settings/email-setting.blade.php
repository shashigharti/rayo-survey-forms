<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('name', 'Name', ['class' => 'control-label' ]) }}
            {{ Form::text('name', isset($settings['name'])?$settings['name']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('email', 'Email', ['class' => 'control-label' ]) }}
            {{ Form::text('email', isset($settings['email'])?$settings['email']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
    </div>
    <h3 class="example-title">SMTP Settings</h3>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('host', 'Host', ['class' => 'control-label' ]) }}
            {{ Form::text('host', isset($settings['host'])?$settings['host']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('port', 'Port', ['class' => 'control-label' ]) }}
            {{ Form::text('port', isset($settings['port'])?$settings['port']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('username', 'Username', ['class' => 'control-label' ]) }}
            {{ Form::text('username', isset($settings['username'])?$settings['username']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('password', 'Password', ['class' => 'control-label' ]) }}
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('encryption', 'Encryption', ['class' => 'control-label' ]) }}
            {{ Form::text('encryption', isset($settings['encryption'])?$settings['encryption']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
    </div>
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>