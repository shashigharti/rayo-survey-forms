<div class="form-group form-material {{ $errors->has('current_password') ? ' has-error' : '' }}">
    {!! Form::label('current_password') !!}
    {!! Form::password('current_password',['class'=>'form-control', 'required' => 'required']) !!}

    @if ($errors->has('current_password'))
        <span class="help-block">
            <strong>{{ $errors->first('current_password') }}</strong>
        </span>
    @endif
</div>

<div class="form-group form-material{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password') !!}
    {!! Form::password('password',['class'=>'form-control', 'required' => 'required']) !!}

    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
<div class="form-group form-material{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {!! Form::label('password_confirmation') !!}
    {!! Form::password('password_confirmation',['class'=>'form-control', 'required' => 'required']) !!}

    @if ($errors->has('password_confirmation'))
        <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
    @endif
</div>