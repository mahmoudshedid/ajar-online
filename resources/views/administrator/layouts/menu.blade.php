<ul class="nav nav-list">
    <li class="{{(@$data['module']=='dashboard')?'active hover highlight':''}}">
        <a href="{{ url('/') }}">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{(@$data['module']=='unit')?'active hover highlight':''}}">
        <a href="{{ url('/units') }}">
            <i class="menu-icon fa fa-home home-icon"></i>
            <span class="menu-text"> Units </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li class="{{(@$data['module']=='ticket')?'active hover highlight':''}}">
        <a href="{{ url('/tickets') }}">
            <i class="menu-icon fa fa-tag"></i>
            <span class="menu-text"> Tickets </span>
        </a>

        <b class="arrow"></b>
    </li>
</ul><!-- /.nav-list -->