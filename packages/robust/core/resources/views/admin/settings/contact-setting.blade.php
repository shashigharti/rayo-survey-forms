<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}

    <div class="nav-tabs-vertical">
        <ul class="nav tabs--bottom__border tabs--container lang-nav">
            <li class="active"><a data-toggle="tab" href="#english">English</a></li>
            <li><a data-toggle="tab" href="#nepali">Nepali</a></li>
        </ul>
        <div class="tab-content">
            <div id="english" class="tab-pane fane in active">
                <div class="form-group form-material row">
                    <div class="col-sm-12">
                        {{ Form::label('contact', 'Contact Information', ['class' => 'control-label' ]) }}
                        {{ Form::textarea('contact', isset($settings['contact'])?$settings['contact']:'', [
                                'class' => 'form-control editor',
                                 'rows' => 3

                            ]) }}
                    </div>
                </div>
                <div class="form-group form-material row">

                    <div class="col-sm-12">
                        {{ Form::label('gmap', 'Google Map Embed Code', ['class' => 'control-label' ]) }}
                        {{ Form::textarea('gmap', isset($settings['gmap'])?$settings['gmap']:'', [
                                'class' => 'form-control',
                                'rows' => 3
                            ]) }}
                    </div>
                </div>

            </div>

            <div id="nepali" class="tab-pane fade">
                <div class="form-group form-material row">
                    <div class="col-sm-12">
                        {{ Form::label('contact_ne', 'Contact Information Nepali', ['class' => 'control-label' ]) }}
                        {{ Form::textarea('contact_ne', isset($settings['contact_ne'])?$settings['contact_ne']:'', [
                                'class' => 'form-control editor',
                                 'rows' => 3

                            ]) }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>