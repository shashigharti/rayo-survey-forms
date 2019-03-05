@extends('core::admin.layouts.login')

@section('content')
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Page -->
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
                @if(session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif
                <h3 class="text-center">LOGIN HERE</h3>

                {{ Form::open(['route' => 'auth.check', 'role' => 'form', 'class' => 'form', 'autocomplete'=> 'off']) }}
                <div class="form-group form-material floating {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="floating-label">Email</label>
                    {{ Form::email('email', null, [
                     'class'       => 'form-control',
                     'required'    => 'required',
                 ]) }}

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group form-material floating">
                    <label class="floating-label">Password</label>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} control-required">
                        {{ Form::password('password', [
                            'class'       => 'form-control',
                            'required'    => 'required'
                        ]) }}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
                        <input type="checkbox" id="inputCheckbox" name="remember">
                        <label for="inputCheckbox">Remember me</label>
                    </div>
                    <a class="pull-right" href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary sign-in btn-block btn-lg margin-top-40">Sign in
                </button>
                {{ Form::close() }}

               <p>Still no account? Please go to <a href="#">Register</a></p>
                

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
