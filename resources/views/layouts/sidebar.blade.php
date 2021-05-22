<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
                    <h2 class="brand-text">Margaasih</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                </a>
            </li>
            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('email')}}">
                    <i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{route('chat')}}">
                    <i data-feather="message-square"></i><span class="menu-title text-truncate" data-i18n="Chat">Chat</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="app-calendar.html">
                    <i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">Calendar</span>
                </a>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="app-user-list.html">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="View">View</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Edit</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>