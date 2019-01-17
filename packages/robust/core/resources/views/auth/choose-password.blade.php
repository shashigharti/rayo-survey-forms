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
            <div class="brand">
                <div class="brand-info">
                    <img class="brand-img" src="{{ URL::asset('assets/images/rayoforms_logo4.png') }}"
                         alt="company logo"
                         class="img-rounded">
                    <p>Lorem ipsum dolor sit amet, eos eu solum senserit suavitate. Ex vitae maiorum nec, pro id persius
                        dolorem, tamquam inermis offendit eum eu.</p>
                </div>
            </div>
        </div>
        <div class="panel pull-right">
            <div class="panel-body">
                <div class="responsive-logo">
                    <img class="brand-img2" src="{{ URL::asset('assets/images/rayoforms_logo.png') }}"
                         alt="company logo"
                         class="img-rounded">
                    <h3>Choose password</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif

                {{ Form::open(['route' => 'frw.user.register', 'role' => 'form', 'class' => 'form', 'autocomplete'=> 'off']) }}
                <div class="form-group form-material floating">
                    <label class="floating-label">Email</label>
                    {{ Form::hidden('name', $user->name, [
                    'class'       => 'form-control',
                    'required'    => 'required',
                    'readonly'  => 'readonly'
                ]) }}
                    {{ Form::email('email', $user->email, [
                     'class'       => 'form-control',
                     'required'    => 'required',
                               'readonly'  => 'readonly'

                 ]) }}
                </div>
                <div class="form-group form-material floating">
                    <label class="floating-label">Password</label>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} control-required">
                        {{ Form::password('password', [
                            'class'       => 'form-control',
                            'required'    => 'required'
                        ]) }}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg margin-top-40">Sign in</button>
                {{ Form::close() }}

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

                <p>© 2016. All RIGHT RESERVED.</p>
            </footer>
        </div>
    </div>
</div>
<!-- End Page -->
@endsection