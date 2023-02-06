<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#">
                <i class="feather icon-menu"></i>
            </a>
            <a href="{{route('admin.index_route')}}">
                <img class="img-fluid" src="{{asset('files/assets/images/logo.png')}}" alt="Theme-Logo" />
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                
                @can('chat-list')
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" id="notifications_count" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            <span class="badge bg-c-pink" >{{ auth()->user()->unreadNotifications->count() }}</span>
                        </div>
                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <h6>Notifications</h6>
                                <label class="label label-danger"><a href="{{route('MarkAsRead_all')}}">Read ALL </a></label>
                            </li>
                                <div id="unreadNotifications"  >
                            @foreach(auth()->user()->unreadNotifications as $notification)


                                <li>
                                    <div class="media">

                                        <img class="d-flex align-self-center img-radius" src="{{asset('/files/assets/users/'.auth()->user()->user_image)}}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h5 class="notification-user">
                                                <a href="{{route('Chat.index')}}"> {{ $notification->data['title'] }}-
                                                    {{$notification->data['user'] }}</a>

                                            </h5>
                                            <span class="notification-time">{{$notification->created_at->diffForHumans()}}</span>
                                        </div>
                                    </div>
                                </li>

                            @endforeach
                                </div>
                        </ul>
                    </div>
                </li>
                @endcan
                <!--<li class="header-notification">-->
                <!--    <div class="dropdown-primary dropdown">-->
                <!--        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">-->
                <!--            <i class="feather icon-message-square"></i>-->
                <!--            <span class="badge bg-c-green">3</span>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</li>-->
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            @if(auth()->user()->user_image !='')

                                <img src="{{asset('/files/assets/users/'.auth()->user()->user_image)}}" class="img-radius" alt="Profile-Image">

                            @else
                                <img src="https://www.w3schools.com/howto/img_avatar.png" class="img-radius" alt="Use)}}'r-Profile-Image">

                            @endif                            <span>{{auth()->user()->name}}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <!--<li>-->
                            <!--    <a href="#!">-->
                            <!--        <i class="feather icon-settings"></i> Settings-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li>
                                <a href="{{{route('profile.index')}}}">
                                    <i class="feather icon-user"></i> Profile
                                </a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="default/email-inbox.html">-->
                            <!--        <i class="feather icon-mail"></i> My Messages-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a href="default/auth-lock-screen.html">-->
                            <!--        <i class="feather icon-lock"></i> Lock Screen-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li>


                                <a href="{{ route('admin.logout')}}') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
