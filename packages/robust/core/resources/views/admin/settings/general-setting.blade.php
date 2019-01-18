<div class="system-settings__general">
    {{ Form::open(['route' => ['admin.settings.store'], 'enctype' => 'multipart/form-data', 'method' => $ui->getMethod()])}}
    {{ Form::hidden('slug', $slug, [
                'class' => 'form-control'
            ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-6 file-upload">
            <div class="col-sm-8 file-upload__preview">
                <img id="file-upload__img" height="80" src="{{$settings['logo'] ?? ''}}"/>
                <div id="file-upload__logo-url">{{$settings['logo'] ?? ''}}</div>
            </div>
            @if(isset($settings['logo']) && $settings['logo'] != "")
                <i class="md md-close-circle text-danger delete-img" data-preview="#file-upload__img"
                   data-image-path="#file-upload__logo-url" data-hidden="#logo"></i>
            @endif

            <div class="col-sm-5 file-upload__btn">

                {{ Form::file('files[logo]', [
                    'class' =>'image-upload',
                    'data-preview' => '#file-upload__img',
                    'data-image-path' => '#file-upload__logo-url'
                ])
                }}
                {{ Form::hidden('logo', isset($settings['logo'])?$settings['logo']:'', ['id' => 'logo']) }}
                <button type="button" id="btn__select-image" class="btn theme-btn">Upload Logo</button>
            </div>
            <div class="col-sm-12">(Image Size: 200 x 200)</div>
        </div>
        <div class="col-sm-6 file-upload">
            @if(isset($settings['login_page_image']) && $settings['login_page_image'] != "")
                <i class="md md-close-circle text-danger delete-img"
                   data-image-path="#file-upload__login-image-url" data-hidden="#login_page-img"></i>
            @endif
            <div class="col-sm-5 file-upload__btn">
                {{ Form::label('login_page_image', 'Login Page Image:', ['class' => 'control-label' ]) }}
                {{ Form::file('files[login_page_image]', [
                    'class' =>'image-upload',
                    'data-image-path' => '#file-upload__login-image-url'
                ])}}
                {{ Form::hidden('login_page_image', isset($settings['login_page_image'])?$settings['login_page_image']:'', ['id' => 'login_page-img']) }}
                <div id="file-upload__login-image-url">{{$settings['login_page_image'] ?? ''}}</div>
                <button type="button" class="btn theme-btn">Upload Login Image</button>
            </div>
            <div class="col-sm-12">(Image Size: 1200 x 1200)</div>
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('company_name', 'Company Name', ['class' => 'control-label' ]) }}
            {{ Form::text('company_name', isset($settings['company_name'])?$settings['company_name']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('description', 'Description', ['class' => 'control-label' ]) }}
            {{ Form::text('description', isset($settings['description'])?$settings['description']:'', [
            'class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('phone_number', 'Phone Number', ['class' => 'control-label' ]) }}
            {{ Form::text('phone_number', isset($settings['phone_number'])?$settings['phone_number']:'', [
                    'class' => 'form-control'
                ]) }}

        </div>
        <div class="col-sm-6">
            {{ Form::label('registration_no', 'Registration Number', ['class' => 'control-label' ]) }}
            {{ Form::text('registration_no', isset($settings['registration_no'])?$settings['registration_no']:'', [
                    'class' => 'form-control'
                ]) }}

        </div>
    </div>
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('street_address', 'Street Address', ['class' => 'control-label' ]) }}
            {{ Form::text('street_address', isset($settings['street_address'])?$settings['street_address']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('region', 'Region', ['class' => 'control-label' ]) }}
            {{ Form::text('region', isset($settings['region'])?$settings['region']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('state', 'State', ['class' => 'control-label' ]) }}
            {{ Form::text('state', isset($settings['state'])?$settings['state']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('country', 'Country', ['class' => 'control-label' ]) }}
            {{ Form::text('country', isset($settings['country'])?$settings['country']:'', [
                    'class' => 'form-control'
                ]) }}
        </div>
    </div>

    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>

    {{Form::close()}}
</div>
