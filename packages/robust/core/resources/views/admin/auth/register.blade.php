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
                <h3 class="text-center">REGISTER HERE</h3>

                {{ Form::open(['route' => 'auth.check', 'role' => 'form', 'class' => 'form', 'autocomplete'=> 'off']) }}
                <div class="form-group form-material floating {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="floating-label">Full Name</label>
                    {{ Form::email('email', null, [
                     'class'       => 'form-control',
                     'required'    => 'required',
                 ]) }}
                    
                </div>
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
                    <label class="floating-label">New Password</label>

                    <div class="{{ $errors->has('password') ? 'has-error' : '' }} control-required">
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
                <div class="form-group form-material floating">
                    <label class="floating-label">Confirm Password</label>

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
             
                <button type="submit" class="btn btn-primary margin-top-40 sign-in btn-block btn-lg">Register
                </button>
                {{ Form::close() }}

               <p>Already Registered? Please go to <a href="#">Log in</a></p>               

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
