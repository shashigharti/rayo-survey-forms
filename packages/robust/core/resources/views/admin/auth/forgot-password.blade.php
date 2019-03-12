@extends('core::admin.layouts.login')

@section('content')
    <div class="page">
        <div class="page-content">
            <div class="page-brand-info">
                <div class="brand clearfix">
                    <div class="brand-info">
                        <div class="brand-txt">
                            <img class="brand-img"
                                 src="{{ (settings('general-setting', 'logo') != '') ? settings('general-setting', 'logo') : url('assets/images/logo-rayo-insight.png') }}"
                                 alt="company logo"
                                 class="img-rounded">
                            <p>{{ settings('general-setting', 'description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel pull-right">
                <div class="panel-body">
                    <div class="responsive-logo">
                        <img class="brand-img2"
                             src="{{ (settings('general-setting', 'logo') != '') ? settings('general-setting', 'logo') : url('assets/images/logo-rayo-insight.png') }}"
                             alt="company logo"
                             class="img-rounded">
                    </div>
                    <h3 class="text-center">RESET PASSWORD</h3>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-sm-12 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-12 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                                <button type="submit" class="btn btn-primary sign-in btn-block btn-lg margin-top-40">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                    </form>

                </div>
                <footer class="page-copyright text-center">
                    <div class="social-share">
                        <a href="https://www.facebook.com/robustitconcepts" target="_blank"><img class="social-icon"
                                                                                                 src="{{ URL::asset('assets/images/fb.png') }}"
                                                                                                 alt="facebook"
                                                                                                 class="img-rounded"></a>
                        <a href="https://twitter.com/robustITconcept" target="_blank"><img class="social-icon"
                                                                                           src="{{ URL::asset('assets/images/tw.png') }}"
                                                                                           alt="facebook"
                                                                                           class="img-rounded"></a>
                        <a href="https://www.linkedin.com/company/robust-it-concepts-pvt-ltd" target="_blank"><img
                                class="social-icon" src="{{ URL::asset('assets/images/in.png') }}" alt="facebook"
                                class="img-rounded"></a>
                    </div>
                    <p>Robust IT Concepts</p>
                    <p>© 2019. All RIGHT RESERVED.</p>

                </footer>
            </div>

        </div>
    </div>
    <!-- End Page -->
@endsection
