<header class="site-heading clearfix">
    <div class="site-logo">
        <img src="{{asset('assets/website/images/logo.png')}}">
    </div>
    <div class="contact-links">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav">
                <li><a href="{{route('website.home')}}">Home</a></li>
                <li><a href="#get_started">Get Started</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#features">Features</a></li>
                @if(!\Auth::check())
                    <li><a href="{{route('auth.login')}}" class="login-btn"><i class="fa fa-sign-out" aria-hidden="true"></i>
                            Login</a></li>
                @else
                    <li><a href="{{route('admin.user.dashboards.index')}}">Dashboard</a></li>
                    <li><a href="{{ route('auth.logout') }}" class="login-btn"><i class="fa fa-sign-out"
                                                                                      aria-hidden="true"></i>
                            Logout</a></li>
                @endif
            </ul>
        </div>
    </div>

</header>
