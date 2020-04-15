@extends(Site::templateResolver('core::website.layouts.default'))
@section('header')
    @include(Site::templateResolver('core::website.layouts.partials.header'))
@endsection
@section('body_section')
    <div class="row login-page">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <div class="row">
                <div class="input-field col s12">
                    <h5 class="ml-4">{{ __('Reset Password') }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
            <form method="POST" action="{{ route('website.auth.password.email') }}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn btn-theme">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include(Site::templateResolver('core::website.layouts.partials.footer'))
@endsection



