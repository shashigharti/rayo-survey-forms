<div class="form-group form-material row">
    <div class="file-upload">
        <div class="file-upload__preview">
            <img id="file-upload__img" height="80" src="{{ $model->avatar }}"/>

            <div id="file-upload__avatar-url">{{$model->avatar}}</div>
        </div>
        @if(isset($model->avatar) && $model->avatar != "")
            <i class="md md-close-circle text-danger delete-img" data-preview="#file-upload__img"
               data-image-path="#file-upload__avatar-url" data-hidden="#avatar"></i>
        @endif
        <div class="col-sm-5 file-upload__btn">
            {{ Form::file('files[avatar]', [
                'class' =>'image-upload',
                'data-preview' => '#file-upload__img',
                'data-image-path' => '#file-upload__avatar-url'
            ])
            }}
            {{ Form::hidden('avatar', null, ['id' => 'avatar']) }}
            <button type="button" id="btn__select-image" class="btn btn-info">Upload Avatar</button>
        </div>
        <div class="col-sm-12">(Image Size: 200 x 200)</div>
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-md-6">
        {{ Form::label('first_name') }}
        {{ Form::text('first_name', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('last_name') }}
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group form-material row">
    <div class="col-md-12">
        {{ Form::label('user_name') }}
        {{ Form::text('user_name', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group form-material{{ $errors->has('email') ? ' has-error' : '' }} row">
    <div class="col-md-12">
        {{ Form::label('email') }}
        {{ Form::email('email', null, ['class'=>'form-control']) }}
        @if ($errors->has('email'))
            <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group form-material row">
    <div class="col-md-12">
        {{ Form::label('organization') }}
        {{ Form::text('organization', null, [
        'class'=>'form-control token-field',
        'data-src-url' => route('users.organization'),
                      'data-suggested-only' => 'false',
        ]) }}
    </div>
</div>

<div class="form-group form-material row">
    <div class="col-md-12">
        {{ Form::label('department') }}
        {{ Form::text('department', null, ['class'=>'form-control token-field',
          'data-src-url' => route('users.department'),
                      'data-suggested-only' => 'false',]) }}
    </div>
</div>