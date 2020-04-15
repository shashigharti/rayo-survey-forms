@set('menus', settings('general-setting', 'menus') != "" ? settings('general-setting', 'menus') : [])

<nav class="navbar navbar-expand-lg navbar-light">
    <ul class="right hide-on-med-and-down">
        @set('parent_menus', $banner_helper->getBannersBySlug('main-menu'))
        @if($parent_menus)
            @set('properties', json_decode($parent_menus->properties))
            @set('titles', $properties->titles)
            @set('parent_urls', $properties->urls)
            @foreach($titles as $pkey => $parent_title)
                @set('child_menu',$banner_helper->getBannersBySlug(str_slug($parent_title)))
                <li class="parent-menu">
                    <a class="dropdown-item" href="{{$child_menu ? '#' : $parent_urls[$pkey]}}">
                        {{$parent_title}}
                        @if($child_menu)
                            @set('properties', json_decode($child_menu->properties))
                            @set('titles', $properties->titles)
                            @set('urls', $properties->urls)
                            <i class="material-icons">arrow_drop_down</i>
                            <div class="child-menu">
                                @foreach($titles as $key => $title)
                                     <a href="{{$urls[$key]}}">{{$title}}</a>
                                @endforeach
                            </div>
                        @endif
                    </a>
                </li>
            @endforeach
        @endif
        <li class="nav-btn">
            @if(Auth::check())
                <a class="nav-link waves-effect waves-light modal-trigger" href="{{route('website.user.profile')}}">My
                    Review
                </a>
            @else
                <a class="nav-link waves-effect waves-light modal-trigger" href="#modal__login">Login</a>
            @endif
            @include(Site::templateResolver('core::website.auth.login'))
        </li>
        <li class="nav-btn">
            @if(Auth::check())
                <a class="nav-link waves-effect waves-light modal-trigger" href="{{route('website.auth.logout')}}">Logout</a>
            @else
                <a class="nav-link waves-effect waves-light modal-trigger" href="#modal__register">Register</a>
            @endif
            @include(Site::templateResolver('core::website.auth.register'))
        </li>
    </ul>
    <a href="#"><img src="{{asset('assets/website/images/Logo.jpg')}}" alt="logo"></a>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    @include(Site::templateResolver('core::website.layouts.partials.mobile-menu'))
</nav>
