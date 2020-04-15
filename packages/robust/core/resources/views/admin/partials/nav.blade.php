<header>
    <div class="navbar navbar-fixed">
        <nav class="navbar--theme">
            <div class="nav-wrapper">
                <ul class="navbar-list right">
                    <li>
                        {{-- <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="dashboard-dropdown">
                            <i class="material-icons">
                                {{$dashboard->name}}
                            </i>
                        </a>
                        <ul class="dropdown-content" id="dashboard-dropdown">
                             @foreach($user->dashboards as $dashboard)
                                <li>
                                    <a href="{{route('admin.dashboards.show', [$dashboard->slug])}}">{{$dashboard->name}}</a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{route('admin.dashboards.create')}}">+ Create New</a>
                            </li>
                        </ul> --}}
                    </li>
                    <li>
                        <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown">
                            <i class="material-icons">notifications_none<small class="notification-badge">5</small>
                            </i>
                        </a>
                        <!-- notifications-dropdown-->
                        <ul class="dropdown-content" id="notifications-dropdown">
                            <li>
                                <h6>NOTIFICATIONS<span class="new badge purple">5</span></h6>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="grey-text text-darken-2" href="#!">
                                    <span class="material-icons icon-bg-circle purple small">add_shopping_cart</span> A new order has been placed!
                                </a>
                                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                            </li>
                            <li>
                                <a class="grey-text text-darken-2" href="#!">
                                    <span class="material-icons icon-bg-circle purple small">stars</span> Completed the task
                                </a>
                                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                            </li>
                            <li>
                                <a class="grey-text text-darken-2" href="#!">
                                    <span class="material-icons icon-bg-circle purple small">settings</span> Settings updated
                                </a>
                                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                            </li>
                        </ul>
                    </li>
                    <li>
                        @include("core::admin.partials.profile-dropdown")
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
