<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu" style="margin-left: 10px; margin-bottom: 0px; background: #8C001B; color: white!important;">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle" style="color: white!important;"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right" style="color: white!important;">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}">
                        {{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                            <a href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->role_id == 2)
                    <li role="presentation" class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="color: white!important;">
                            <i class="fa fa-user"></i>
                            <span class="badge bg-green">6</span>
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span class="image"><img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Profile Image" /></span>
                                    <span>
                              <span>John Smith</span>
                              <span class="time">3 mins ago</span>
                            </span>
                                    <span class="message">
                              Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                                </a>
                            </li>
                            <li>
                                <div class="text-center">
                                    <a>
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->