 <div class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="brand">My-Dash</a>
    </div>
    <ul class="menu">
        <li class="menu-item">
            <a href="{{route('admin.index')}}" class="menu-item-link @yield('dash-active')">
                <i class="far fa-desktop"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-item-link @yield('user-active')">
                <i class="far fa-user-cog"></i><span>Users Management</span><i
                    class="fas fa-angle-down menu-item-toggler"></i>
            </a>
            <ul class="menu sub-menu">
                <li class="menu-item sub-menu-item">
                    <a href="{{route('admin.admin-users.index')}}" class="menu-item-link sub-menu-item-link @yield('admin-user-active')">
                        <i class="far fa-user"></i><span>Admin User</span>
                    </a>
                </li>
                <li class="menu-item sub-menu-item">
                    <a href="{{route('admin.users.index')}}" class="menu-item-link sub-menu-item-link @yield('customer-active')">
                        <i class="far fa-user"></i><span>Customer</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{route('admin.wallets.index')}}" class="menu-item-link @yield('wallet-active')">
                <i class="far fa-wallet"></i><span>Wallets</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-item-link">
                <i class="far fa-comment-alt"></i><span>Messages</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-item-link">
                <i class="far fa-analytics"></i><span>Analytics</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-item-link">
                <i class="far fa-folder"></i><span>File Manager</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-item-link">
                <i class="far fa-cog"></i><span>Settings</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-item-link">
                <i class="far fa-sign-out"></i><span>Sign Out</span>
            </a>
        </li>
    </ul>
</div>