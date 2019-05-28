<li class="light-blue">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <img id="avatar-header" class="nav-user-photo" src="{{ url('public/avatars/user.jpg') }}" alt="{{ Auth::user()->first_name }}'s Photo"/>
        <span class="user-info">
            <small>Welcome,</small>
            {{ Auth::user()->first_name }}
        </span>

        <i class="ace-icon fa fa-caret-down"></i>
    </a>

    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
        <li class="divider"></li>

        <li>
            <a href="{{ url('/logout') }}">
                <i class="ace-icon fa fa-power-off"></i>
                Logout
            </a>
        </li>
    </ul>
</li>