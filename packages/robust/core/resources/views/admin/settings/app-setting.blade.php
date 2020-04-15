<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [ 'class' => 'form-control' ]) }}
        <div class="form-group form-material row">
            <div class="col s6 input-field">
                {{ Form::label('pagination', 'No of properties per page', ['class' => 'control-label' ]) }}
                {{ Form::number('pagination', isset($settings['pagination'])?$settings['pagination']:'', [
                        'class' => 'form-control',
                        'min' => 0
                    ])
                }}
            </div>
            <div class="col s6 input-field">
                {{ Form::text('app_url', isset($settings['app_url'])?$settings['app_url']:'',  [
                    'class' => 'form-control'
                    ])
                }}
                {{ Form::label('app_url', 'App URL', ['class' => 'control-label' ]) }}
            </div>
        </div>
        <div class="form-group form-material row">
            <div class="col s12 input-field">
                {{ Form::text('google_api_key', isset($settings['google_api_key'])?$settings['google_api_key']:'',  [
                    'class' => 'form-control'
                    ])
                }}
                {{ Form::label('google_api_key', 'Google API Key', ['class' => 'control-label' ]) }}
            </div>
        </div>
        <div class="form-group form-material row editor">
            <div class="col s12 input-field">
                {{ Form::textarea('footer_content', isset($settings['footer_content'])?$settings['footer_content']:'', [
                        'class' => 'form-control editor',
                        'id' => 'editor_footer_content'
                    ])
                }}
                {{ Form::label('footer_content', 'Footer Content', ['class' => 'control-label' ]) }}
            </div>
        </div>
        <div class="form-group form-material row">
            <div class="col s12 input-field">
                {{ Form::textarea('copyright_text', isset($settings['copyright_text'])?$settings['copyright_text']:'', [
                        'class' => 'form-control editor',
                    ])
                }}
                {{ Form::label('copyright_text', 'Copyright', ['class' => 'control-label' ]) }}
            </div>
        </div>
    <div class="row">
            <div class="col s12">
                <fieldset>
                    <legend>Site Maintenance </legend>
                    <div class="form-group form-material row">
                        <div class="col s5 input-field">
                            {{ Form::checkbox('maintenance_mode', isset($settings['maintenance_mode'])?$settings['maintenance_mode']:'') }}
                            {!! Html::decode(Form::label('maintenance_mode', 'Maintenance Mode', ['class' => 'control-label required' ]))  !!}
                        </div>
                        <div class="col s7 input-field">
                            {{ Form::select('maintenance_type', [
                                    'message_only' => 'Maintenance Mode With Message',
                                    'completely_down' => 'Completely Down'
                                ],
                                isset($settings['maintenance_type'])?$settings['maintenance_type']:'',
                                [
                                    'class' => 'form-control'
                                ])
                            }}
                        </div>
                    </div>
                    <div class="form-group form-material row">
                        <div class="col s12 input-field">
                            {{ Form::textarea('maintenance_message', isset($settings['maintenance_message'])?$settings['maintenance_message']:'',  [
                            'class' => 'form-control',
                            'rows' => 4]) }}
                            {{ Form::label('maintenance_message', 'Maintenance Message', ['class' => 'control-label' ]) }}
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
