<div class="col-sm-12 col-xs-12 dashboard-heading">
    <div class="col-sm-6 col-xs-6 inner-site-logo">
        <h2>{{trans('website.title')}}</h2>
    </div>
    <div class="text-right col-sm-6 col-xs-6">
        <img src="{{asset('assets/website/images/gov_logo.png')}}" width="60px"> </img>
        <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
           data-animation="scale-up" role="button">
            <span class="welcome-span"> Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
            <span class="avatar avatar-online">
                <img src="{{ (Auth::user()->avatar != '') ? Auth::user()->avatar : Avatar::create(Auth::user()->first_name.' '.Auth::user()->last_name) }}"> </img>
            </span>
        </a>
        <li class="settings dropdown">
            <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <a href="{{ route('profile.reset',['user_id'=>Auth::user()->id]) }}">
                        <i class="ace-icon fa fa-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="{{route('secondary.settings.edit', ['general'])}}">
                        <i class="fa fa-cog" aria-hidden="true"></i>Settings
                    </a>
                </li>
                <li>
                    <a href="{{ route('frw.user.logout') }}">
                        <i class="fa fa-sign-out"></i>Logout
                    </a>
                </li>
            </ul>
        </li>

    </div>
</div>
