@set('isMobile',is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile")))
@if($isMobile)
<ul id="slide-out" class="sidenav mobile--menu">
    <li><a class="nav-link" href="{{route('website.home')}}">Home</a></li>
    <li class="nav-item mega--dropdown">
        <a id="mega-dropdown" class="nav-link mega--dropdown__parent" href="#">Areas <i class="material-icons">arrow_drop_down</i></a>
        <div id="mega-dropdown_content" class="mega--dropdown__child hidden">
            <span id="mega-dropdown_close" class="close--filters--dropdown right">
                <i class="material-icons">clear</i>
            </span>
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab"><a class="active" href="#cities">CITIES ({{$locations['cities'] ? count($locations['cities']): '0'}})</a></li>
                        <li class="tab"><a href="#counties">COUNTIES ({{$locations['counties'] ? count($locations['counties']): '0'}})</a></li>
                        <li class="tab"><a href="#zipcodes">ZIP CODES ({{$locations['zips'] ? count($locations['zips']): '0'}})</a></li>
                        <span><input type="radio" name="status_filter" value='active' checked>Homes for Sale</span>
                        <span><input type="radio" name="status_filter" value='sold'>Sold Homes</span>
                        <span><input type="radio" name="status_filter" value='all'>All</span>
                    </ul>
                </div>
                <div id="cities" class="tab-filter tab--content col s12">
                    <ul>
                        @if(isset($locations['cities']))
                            @foreach($locations['cities'] as $location)
                                <li data-active ="{{ $location->active_count }}"
                                            data-active-url= "{{settings('real-estate', 'url_active')}}"
                                            data-sold-url="{{settings('real-estate', 'url_sold')}}"
                                            data-sold="{{ $location->sold_count }}"
                                            data-all="{{ $location->sold_count + $location->active_count }}">
                                    <a class="tab__location" href="{{route('website.realestate.homes-for-sale',[
                                                    'location_type' => 'cities',
                                                    'location' => $location->slug
                                                    ])}}">
                                        {{ $location->name }}
                                        <span class="tab__location-count">({{ $location->active ?? $location->active_count }})</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div id="counties" class="tab-filter tab--content col s12">
                    <ul>
                        @if(isset($locations['counties']))
                            @foreach($locations['counties'] as $location)
                                <li data-active="{{ $location->active_count }}" data-sold="{{ $location->sold_count }}" data-all="{{ $location->sold_count + $location->active_count }}">
                                    <a class="tab__location" href="{{route('website.realestate.homes-for-sale',[
                                    'location_type' => 'counties',
                                                    'location' => $location->slug
                                                    ])}}">
                                    {{ $location->name }} ({{ $location->active ?? $location->active_count }})
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div id="zipcodes" class="tab-filter tab--content col s12">
                    <ul>
                        @if(isset($locations['zips']))
                            @foreach($locations['zips'] as $location)
                                <li data-active="{{ $location->active_count }}"
                                            data-sold="{{ $location->sold_count }}"
                                            data-all="{{ $location->sold_count + $location->active_count }}">
                                    <a class="tab__location" href="{{route('website.realestate.homes-for-sale',[
                                                    'location_type' => 'zips',
                                                    'location' => $location->slug
                                                    ])}}">
                                        {{ $location->name }} ({{ $location->active ?? $location->active_count }})
                                    </a>
                                </li>
                             @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </li>
    <li><a class="nav-link" href="{{route('website.realestate.homes-for-sale')}}">Homes For Sale</a></li>
    <li><a class="nav-link" href="{{route('website.realestate.sold-homes')}}">Sold Homes</a></li>
    <li><a class="nav-link" href="{{route('website.realestate.market.reports', ['type' => 'cities'])}}">Market Stats</a></li>
    <li class="nav-btn">
        @if(Auth::check())
            <a class="nav-link waves-effect waves-light modal-trigger" href="{{ route('website.user.profile') }}">My Review</a>
         @else
            <a class="nav-link waves-effect waves-light modal-trigger" href="#loginmodal">Login</a>
            <div id="loginmodal" class="modal">
                <form  method="post" id="login--form" data-url="{{ route('website.auth.admin-login') }}">
                    @csrf
                    <div class="row modal-header">
                        <button type="button" class="modal-close"> <span>×</span> </button>
                        <h4 class="modal-title">Login</h4>
                    </div>
                    <div class="modal-content">
                        <p class="center-align">To access Advanced MLS Information, login below</p>
                        <div class="form-group row">
                            <input id="email" type="email" class="form-control" name="email" value="" placeholder="E-Mail Address" required="">
                        </div>
                        <div class="form-group row">
                            <input type="password" class="form-control" name="password" value="" placeholder="Password" required="">
                        </div>
                        <div class="form-group row">
                            <input type="checkbox">
                            Remember Me
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" id="register--link" type="text" class="btn btn-default pull-left load-register-form"> Not yet registered ? Register here </a>
                        <a href="https://scottingraham.com/user/password/reset" class="pull-left btn btn-default"> Password recovery </a>
                        <button type="submit" class="btn btn-primary"> <div class="loader-01"></div> Login </button>
                    </div>
                </form>
            </div>
        @endif
    </li>
    <li class="nav-btn">
        @if(Auth::check())
            <a class="nav-link waves-effect waves-light modal-trigger" href="{{route('website.auth.logout')}}">Logout</a>
        @else
            <a class="nav-link waves-effect waves-light modal-trigger" href="#registermodal">Register</a>
            <div id="registermodal" class="modal">
                <form method="post" id="register--form" action="" data-url="{{route('website.auth.register.post')}}">
                    @csrf
                    <div class="row modal-header">
                        <button type="button" class="modal-close"> <span>×</span> </button>
                        <h4 class="modal-title">To Continue..</h4>
                    </div>
                    <div class="modal-content">
                        <p class="center-align">To access Advanced MLS Information, you must enter your info below</p>
                        <div class="form-group row">
                            <input type="text" name="firstname" class="form-control" value="" placeholder="First Name" required="">
                        </div>
                        <div class="form-group row">
                            <input type="text"  name="lastname" class="form-control" value="" placeholder="Last Name" required="">
                        </div>
                        <div class="form-group row">
                            <input type="email" name="email" class="form-control" value="" placeholder="Email" required="">
                        </div>
                        <div class="form-group row">
                            <input type="password" name="password" class="form-control" value="" placeholder="Password" required="">
                        </div>
                        <p class="agree-to-terms">By registering on our site you agree to the website terms.We protect your personal privacy and email security. View our <a href="">privacy policy</a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="" id="login--link" type="text" class="btn btn-default pull-left load-register-form"> Already a member ? Login </a>

                        <button type="submit" class="btn btn-primary"> <div class="loader-01"></div> Register </button>
                    </div>
                </form>
            </div>
        @endif

    </li>
</ul>
@endif
