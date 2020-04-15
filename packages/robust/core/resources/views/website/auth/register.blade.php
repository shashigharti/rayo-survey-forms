<div id="modal__register" class="modal">
    <form method="post" class="auth--form" action="" data-url="{{route('website.auth.register.post')}}">
        @csrf
        <div class="row modal-header">
            <button type="button" class="modal-close"> <span>×</span> </button>
            <h4 class="modal-title">To Continue..</h4>
        </div>

        <div class="msg">
            <div class="msg-info">
            </div>
            <div class="msg-error">
            </div>
        </div>
        <div class="modal-content">
            <p class="center-align">To access Advanced MLS Information, you must enter your info below</p>
            <div class="form-group row floating">
                {{ Form::text('first_name', null, [
                    'class'       => 'form-control',
                    'required'    => 'required',
                    'placeholder' => 'First Name'])
                }}
            </div>
            <div class="form-group row">
                {{ Form::text('last_name', null, [
                    'class'       => 'form-control',
                    'required'    => 'required',
                    'placeholder' => 'Last Name'])
                }}
            </div>
            <div class="form-group row">
                {{ Form::text('email', null, [
                    'class'       => 'form-control',
                    'required'    => 'required',
                    'placeholder' => 'Email'])
                }}
            </div>
            <div class="form-group row">
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="form-group row">
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm Password">
            </div>
            <p class="agree-to-terms">
                By registering on our site you agree to the website terms.We protect your personal privacy and email security. View our <a href="">privacy policy</a>
            </p>
        </div>
        <div class="modal-footer">
            <a href="#modal__login" class="modal-close modal-trigger btn btn-default pull-left load-register-form"> Already a member ? Login </a>
            {{ Form::submit('Register', [
                'class' => 'btn btn-primary theme-btn'
                ])
            }}
        </div>
    </form>
</div>
