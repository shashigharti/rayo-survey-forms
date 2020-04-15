<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [ 'class' => 'form-control' ]) }}
    {{ Form::hidden('mail_driver', $slug, [ 'class' => 'form-control' ]) }}

        <div class="form-group form-material row">
            <div class="col s6 input-field">
                    {{ Form::label('name', 'Sender Name(From)', ['class' => 'control-label' ]) }}
                    {{ Form::text('name', isset($settings['name'])?$settings['name']:'', [
                            'class' => 'form-control'
                        ]) }}
            </div>
            <div class="col s6 input-field">
                    {{ Form::label('email', 'Default Email(From)', ['class' => 'control-label' ]) }}
                    {{ Form::text('email', isset($settings['email'])?$settings['email']:'', [
                            'class' => 'form-control'
                        ]) }}
            </div>
        </div>
        <div class="form-group form-material row">
            <div class="col s12">
                <fieldset>
                    <legend>Mailgun Settings</legend>
                    <div class="form-group form-material row">
                        <div class="col s6 input-field">
                            {{ Form::label('host', 'Host(host)', ['class' => 'control-label' ]) }}
                            {{ Form::text('host', isset($settings['host'])?$settings['host']:'', [
                                    'class' => 'form-control'
                                ]) }}
                        </div>
                        <div class="col s6 input-field">
                            {{ Form::label('port', 'Port(port)', ['class' => 'control-label' ]) }}
                            {{ Form::text('port', isset($settings['port'])?$settings['port']:'', [
                                    'class' => 'form-control'
                                ]) }}
                        </div>
                    </div>
                    <div class="form-group form-material row">
                        <div class="col s6 input-field">
                            {{ Form::label('username', 'Username(username)', ['class' => 'control-label' ]) }}
                            {{ Form::text('username', isset($settings['username'])?$settings['username']:'', [
                                    'class' => 'form-control'
                                ]) }}
                        </div>
                        <div class="col s6 input-field">
                            {{ Form::label('password', 'Password(password)', ['class' => 'control-label' ]) }}
                            {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group form-material row">
                        <div class="col s6 input-field">
                            {{ Form::label('domain', 'Domain(domain)', ['class' => 'control-label' ]) }}
                            {{ Form::text('domain', isset($settings['domain'])?$settings['domain']:'', [
                                    'class' => 'form-control'
                                ]) }}
                        </div>
                        <div class="col s6 input-field">
                            {{ Form::label('encryption', 'Mail encryption(encryption)', ['class' => 'control-label' ]) }}
                            {{ Form::text('encryption', isset($settings['encryption'])?$settings['encryption']:'', [
                                    'class' => 'form-control'
                                ]) }}
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="form-group form-material row test-email mt-2">
            <div class="col s12">
                <fieldset>
                    <legend>Test Email</legend>
                    <div class="form-group form-material row">
                        <div class="col s6 input-field email-field">
                            {{ Form::label('test_email', 'Send Test Email', ['class' => 'control-label' ]) }}
                            {{ Form::email('test_email', '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'info@robustitconcepts.com',
                                ]) }}
                            <a href="#" class="cyan btn btn-small test-email__send" data-url="{{route('api.send.test-email')}}">
                                 <i class="material-icons">send</i>Send
                            </a>
                        </div>
                        <div class="col s4 input-field">
                            <p class="test-email_result">

                            </p>
                        </div>
                    </div>

                </fieldset>
            </div>
        </div>
        <div class="form-group form-material row mt-3">
           <div class="col s12">
                {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
           </div>
        </div>
    {{Form::close()}}
</div>
