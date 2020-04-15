<div class="system-settings__ga-analytics">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
        {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) 
        }}
        <div class="form-group form-material row">
            <div class="col s12 input-field">
                {{ Form::textarea('script_before_head_closing', isset($settings['script_before_head_closing'])?$settings['script_before_head_closing']:'', [
                        'class' => 'form-control',
                        'rows' => 3
                    ]) 
                }}                
                {{ Form::label('script_before_head_closing', 'Script before head closing tag', ['class' => 'control-label' ]) }}
            </div>
        </div>
        <div class="form-group form-material row">
            <div class="col s12 input-field">                
                {{ Form::textarea('script_after_body_opening', isset($settings['script_after_body_opening'])?$settings['script_after_body_opening']:'', [
                        'class' => 'form-control',
                        'rows' => 3
                    ]) 
                }}
                {{ Form::label('script_after_body_opening', 'Script after body opening tag', ['class' => 'control-label' ]) }}
            </div>
        </div>
         <div class="form-group form-material row">
            <div class="col s12 input-field">
                {{ Form::textarea('script_before_body_closing', isset($settings['script_before_body_closing'])?$settings['script_before_body_closing']:'', [
                        'class' => 'form-control',
                        'rows' => 3
                    ]) 
                }}
                {{ Form::label('script_before_body_closing', 'Script after body closing tag', ['class' => 'control-label' ]) }}
            </div>
        </div>
        <div class="form-group form-material row mt-1">
            <div class="col s12">
                {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
            </div>
        </div>
    {{Form::close()}}
</div>
