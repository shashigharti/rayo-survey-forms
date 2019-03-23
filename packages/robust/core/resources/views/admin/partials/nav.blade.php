<nav class="header__top" role="navigation">
    <div class="pull-left">
        <a class="left-smallmenu-bar">
            <i class="fa fa-bars"></i>
        </a>
        <a href="{{--{{ route('admin.home') }}--}}">
            <img class="header--logo" src="{{ (settings('general-setting', 'logo') != '') ? settings('general-setting', 'logo') : url('assets/images/logo-rayo-insight.png')  }}"
                 title="Rayo forms">
        </a>
    </div>
    <div class="pull-right">
        <div>
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">                
                @inject('menu_helper', 'Robust\Core\Helpers\MenuHelper')
            </ul>

            <ul class="nav notification--bar">
                <li class="dropdown">
                    <span><a href="#">{{$dashboard->name}}</a></span>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="" aria-expanded="false"
                       data-animation="fade" role="button">                        
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($user->dashboards as $dashboard)
                            <li>
                                <a href="{{route('admin.dashboards.show', [$dashboard->slug])}}">{{$dashboard->name}}</a>
                            </li>
                        @endforeach
                        <li><a href="{{route('admin.dashboards.create')}}">+ Create New</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="nav-notification" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                       aria-expanded="false"
                       data-animation="scale-up" role="button">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        @if($notifications->count() > 0)
                            <span class="badge badge-danger up">{{$notifications->count()}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu__right dropdown-menu-media" role="menu">
                        <li class="dropdown-menu-header notification" role="presentation">
                            <span>NOTIFICATIONS</span>
                            @if($notifications->count() > 0)
                                <span class="label label-round label-danger">New {{$notifications->count()}}</span>
                            @endif
                        </li>
                        <li class="list-group" role="presentation">
                            <div data-role="container">
                                <div data-role="content">
                                    @foreach ($notifications as $notification)
                                        <a class="list-group-item"
                                           href="{{isset($notification->data['route'])?$notification->data['route'] . "?notification_id={$notification->id}":""}}"
                                           role="menuitem">
                                            <div class="media">
                                                <div class="media-left padding-right-10">
                                                    {!!  $notification->data['icon'] !!}
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading">{{$notification->data['title']}}</h6>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">
                                                        {{$notification->created_at->diffForHumans()}}
                                                    </time>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-menu-footer" role="presentation">
                            <a class="dropdown-menu-footer-btn pull-right" href="javascript:void(0)" role="button">
                                <i class="icon fa fa-gear" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('admin.notifications')}}" role="menuitem">
                                See All
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="navbar--avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
                        Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        <span class="avatar avatar-online">
                        <img src="{{ (Auth::user()->avatar != '') ? Auth::user()->avatar : Avatar::create(Auth::user()->first_name.' '.Auth::user()->last_name) }}"> </img>
                            <i></i>
                      </span>
                    </a>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                       aria-expanded="false"
                       data-animation="scale-up" role="button">
                        <i class="site-menu-icon fa fa-gear" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li role="presentation">
                            <a href="{{ route('admin.profile.settings.edit', [Auth::user()->id, 'general']) }}"
                               role="menuitem"><i class="icon md-account"
                                                  aria-hidden="true"></i> Profile</a>
                        </li>
                        @foreach($menu_helper->getMenus() as $index => $menu)
                            @if($menu->type == 'secondary')
                                @can($menu->permission)
                                    <li role="presentation">
                                        <a href="{{$menu->url}}">                                            
                                            <span class="site-menu-title">{{$menu->display_name}}</span>
                                        </a>
                                    </li>
                                   
                                @endcan
                            @endif
                        @endforeach
                        <li role="presentation">
                            <a href="{{route('auth.logout')}}" role="menuitem"><i class="icon md-power"
                                                                                  aria-hidden="true"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon md-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
