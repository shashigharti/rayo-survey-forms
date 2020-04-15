@extends(Site::templateResolver('core::website.layouts.default'))
@section('header')
    @include(Site::templateResolver('core::website.layouts.partials.header'))
@endsection
@section('body_section')     
    <div class="row login-page">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <form method="POST" action="{{route('website.auth.admin-login.post')}}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="ml-4">Sign in</h5>
                    </div>
                </div>
                @if($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="row margin">
                    <div class="input-field col s12 @error('email') is-invalid @enderror"">
                        <i class="material-icons prefix pt-2">person_outline</i>
                        <label for="email" class="center-align">{{ __('E-Mail Address') }}</label>
                        {{ Form::text('email', null, [            
                            'value'         => old('email'),
                            'autocomplete'  => 'email',
                            'autofocus'     => 'autofocus'])
                        }}
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12 @error('email') is-invalid @enderror"">
                        <i class="material-icons prefix pt-2">lock_outline</i>
                        <label for="password">{{ __('Password') }}</label>
                        {{ Form::password('password', null, [
                            'required'    => 'required',
                            'placeholder' => __('Password')])
                        }}
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12 ml-2 mt-1">
                        <p>
                            <label>
                                <input type="checkbox" />
                                <span>Remember Me</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{ Form::submit( __('Login'), [
                            'class' => 'btn btn-theme col s12'
                            ]) 
                        }}
                    </div>
                </div>
                <p class="center-align">Forgot your password ? Click 
                    <a href="/password/recover"> here </a> to reset your password.
                </p>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    @include(Site::templateResolver('core::website.layouts.partials.footer'))
@endsection

