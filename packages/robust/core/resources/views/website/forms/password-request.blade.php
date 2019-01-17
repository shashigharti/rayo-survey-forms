@extends(Site::templateResolver('core::website.layouts.default'))

@section('content')
    <div class="container">
        <div class="password-block text-center">
            <h2>Request Password</h2>
        </div>
        @include(Site::templateResolver('core::website.partials.message'))
        <div class="signup-form">
            {{ Form::open(['url' => route('frw.user.password.request-post'), 'method' => 'post', 'role' => 'form']) }}

            {{ Form::hidden('email', \Auth::user()->email) }}

            <div class="form-group">
                <div class="pw_email-block">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
            </div>

            <div class="form-group">
                <div class="pw_email-block">
                    <input type="password" class="form-control" placeholder="Password Confirmation"
                           name="password_comfirmation">
                </div>
            </div>

            <div class="form-group">
                <div class="text-center password-block">
                    <button type="submit" class="btn btn-primary">
                        Update Password
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="clearfix">
        @include(Site::templateResolver('cart::website.partials.deals'))
    </div>
@endsection