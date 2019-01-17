<div class="system-settings__email">
    {{Form::open(['route' => ['admin.settings.store'], 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('facebook_link', 'Facebook', ['class' => 'control-label' ]) }}
            {{ Form::text('facebook_link', isset($settings['facebook_link'])?$settings['facebook_link']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('twitter_link', 'Twitter', ['class' => 'control-label' ]) }}
            {{ Form::text('twitter_link', isset($settings['twitter_link'])?$settings['twitter_link']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('google_link', 'Google', ['class' => 'control-label' ]) }}
            {{ Form::text('google_link', isset($settings['google_link'])?$settings['google_link']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('youtube_link', 'Youtube', ['class' => 'control-label' ]) }}
            {{ Form::text('youtube_link', isset($settings['youtube_link'])?$settings['youtube_link']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-12">
            {{ Form::label('linkedin_link', 'Linkedin', ['class' => 'control-label' ]) }}
            {{ Form::text('linkedin_link', isset($settings['linkedin_link'])?$settings['linkedin_link']:'', [
                    'class' => 'form-control',
                ]) }}
        </div>
    </div>


    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{Form::close()}}
</div>