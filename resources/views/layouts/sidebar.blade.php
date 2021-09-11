<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
                    <h2 class="brand-text">SIG - Margaasih</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item {{request()->is('admin/dashboard') ? 'active' : ''}}">
                <a class="d-flex align-items-center" href="{{route('admin.dashboard')}}">
                    <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role_id == 1)
                <li class=" nav-item {{request()->is('admin/category/*') ? 'active' : ''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.category.index')}}">
                        <i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Category">Category</span>
                    </a>
                </li>
            @endif
            <li class=" nav-item {{request()->is('admin/poi/*') ? 'active' : ''}}">
                <a class="d-flex align-items-center" href="{{route('admin.poi.index')}}">
                    <i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Point Of Interest">Point Of Interest</span>
                </a>
            </li>

            @if (auth()->user()->role_id == 1)
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User Config</span></a>
                    <ul class="menu-content">
                        <li class="{{request()->is('admin/role/*') ? 'active' : ''}}">
                            <a class="d-flex align-items-center" href="{{route('admin.role.index')}}">
                                <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Role">Role</span>
                            </a>
                        </li>
                        <li class="{{request()->is('admin/user/*') ? 'active' : ''}}">
                            <a class="d-flex align-items-center" href="{{route('admin.user.index')}}">
                                <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="User Admin">User Admin</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>