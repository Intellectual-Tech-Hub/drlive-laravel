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

        <li class="menu-title" key="t-apps">User Management</li>

        <li>
            <a href="javascript: void(0);">
                <i class="bx bx-user-circle"></i>
                <span key="t-layouts">Roles & Permissions</span>
                <span class="fas fa-arrow-circle-down"></span>
            </a>
            <ul class="sub-menu" aria-expanded="true">
                <li>
                    <a href="{{ route('roles.index') }}" key="t-vertical">Roles</a>
                </li>
                <li>
                    <a href="{{ route('role.lists') }}" key="t-vertical">Assign Permission</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('users.index') }}" class="waves-effect">
                <i class="fa fa-users"></i>
                <span key="t-chat">Users</span>
            </a>
        </li>

    </ul>
</div>
<!-- Sidebar -->