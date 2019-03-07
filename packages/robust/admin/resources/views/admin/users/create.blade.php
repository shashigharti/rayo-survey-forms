@extends('core::admin.layouts.sub-layouts.create')

@section('form')
    @inject('role_helper', 'Robust\Admin\Helpers\RoleHelper')
    @set('ui', new $ui)

    {{ Form::model($model,['route' => $ui->getRoute($model), 'method' => $ui->getMethod($model) ]) }}
    <div class="form-group form-material row">
        <div class="col-sm-6">
            {{ Form::label('first_name') }}
            {{ Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-sm-6">
            {{ Form::label('last_name') }}
            {{ Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>

    <div class="form-group form-material row">
        <div class="col-md-12">
            {{ Form::label('user_name') }}
            {{ Form::text('user_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>

    <div class="form-group form-material {{ $errors->has('email') ? ' has-error' : '' }}">
        {{ Form::label('email') }}
        {{ Form::email('email', null, ['class'=>'form-control', 'required' => 'required']) }}
        @if ($errors->has('email'))
            <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
        @endif
    </div>
    <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">
        {{ Form::label('roles') }}
        {{ Form::select('roles[]', $role_helper->roles(), $ui->getSelectedRoles($model), ['class'=>'form-control','multiple']) }}

        @if ($errors->has('roles'))
            <span class="help-block">
                                <strong>{{ $errors->first('roles') }}</strong>
                    </span>
        @endif
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

    @if(is_add_mode($model))
        <div class="form-group form-material {{ $errors->has('password') ? ' has-error' : '' }}">
            {{ Form::label('password') }}
            {{ Form::password('password',['class'=>'form-control', 'required' => 'required']) }}

            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                            </span>
            @endif
        </div>
        <div class="form-group form-material {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            {{ Form::label('password_confirmation') }}
            {{ Form::password('password_confirmation',['class'=>'form-control', 'required' => 'required']) }}

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
            @endif
        </div>
    @endif
    <div class="form-group form-material">
        {{ Form::submit($ui->getSubmitText(), ['class' => 'btn btn-primary theme-btn']) }}
    </div>
    {{ Form::close() }}

@endsection
