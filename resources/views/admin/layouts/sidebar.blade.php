<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>

        <li>
            <a href="{{ route('home') }}" class="waves-effect">
                <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end"></span>
                <span key="t-dashboards">Dashboards</span>
            </a>
        </li>

        <li class="menu-title" key="t-apps">Doctors Section</li>

        @can('category_list')
        <li>
            <a href="{{ route('category.index') }}" class="waves-effect">
                <i class="fas fa-sitemap"></i>
                <span key="t-chat">Category</span>
            </a>
        </li>
        @endcan
        @canany('doctor_list','doctor_create')
        <li>
            <a href="javascript: void(0);">
                <i class="fas fa-plus-square"></i>
                <span key="t-layouts">Doctors</span>
                <span class="fas fa-arrow-circle-down"></span>
            </a>
            <ul class="sub-menu" aria-expanded="true">
                @can('doctor_list')
                <li>
                    <a href="{{ route('doctor.index') }}" key="t-vertical">Doctors List</a>
                </li>
                @endcan
                @can('doctor_create')
                <li>
                    <a href="{{ route('doctor.create') }}" key="t-vertical">Add Doctors</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        <li class="menu-title" key="t-apps">General Options</li>

        @canany('banner_list','banner_create')
        <li>
            <a href="javascript: void(0);">
                <i class="fas fa-image"></i>
                <span key="t-layouts">Banners</span>
                <span class="fas fa-arrow-circle-down"></span>
            </a>
            <ul class="sub-menu" aria-expanded="true">
                @can('banner_list')
                <li>
                    <a href="{{ route('banners.index') }}" key="t-vertical">Banner List</a>
                </li>
                @endcan
                @can('banner_create')
                <li>
                    <a href="{{ route('banners.create') }}" key="t-vertical">Add Banners</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        <li class="menu-title" key="t-apps">User Management</li>

        @canany('role_list','permission_assign')
        <li>
            <a href="javascript: void(0);">
                <i class="fas fa-user-shield"></i>
                <span key="t-layouts">Roles & Permissions</span>
                <span class="fas fa-arrow-circle-down"></span>
            </a>
            <ul class="sub-menu" aria-expanded="true">
                @can('role_list')
                <li>
                    <a href="{{ route('roles.index') }}" key="t-vertical">Roles</a>
                </li>
                @endcan
                @can('permission_assign')
                <li>
                    <a href="{{ route('role.lists') }}" key="t-vertical">Assign Permission</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany

        @can('user_list')
        <li>
            <a href="{{ route('users.index') }}" class="waves-effect">
                <i class="fa fa-users"></i>
                <span key="t-chat">Users</span>
            </a>
        </li>
        @endcan

        <li class="menu-title" key="t-apps">Settings</li>

        @can('web_settings')
        <li>
            <a href="javascript: void(0);">
                <i class="fas fa-cogs"></i>
                <span key="t-layouts">Web Settings</span>
                <span class="fas fa-arrow-circle-down"></span>
            </a>
            <ul class="sub-menu" aria-expanded="true">
                <li>
                    <a href="{{ route('settings.index') }}" key="t-vertical">General</a>
                </li>
            </ul>
        </li>
        @endcan

    </ul>
</div>
<!-- Sidebar -->