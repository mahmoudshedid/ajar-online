<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>@yield('title') - {{ config('app.name', 'Backend') }} - Admin</title>

    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <meta name="description" content="@yield('description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{!! asset('public/css/bootstrap.css') !!}"/>
    <link rel="stylesheet" href="{!! asset('public/css/font-awesome.css') !!}"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="{!! asset('public/css/ace-fonts.css') !!}"/>

    @yield('css-before')

    <!-- ace styles -->
    <link rel="stylesheet" href="{!! asset('public/css/ace.css') !!}"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{!! asset('public/css/ace-part2.css') !!}"/>
    <![endif]-->
    <link rel="stylesheet" href="{!! asset('public/css/ace-rtl.css') !!}"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{!! asset('public/css/ace-ie.css') !!}"/>
    <![endif]-->

    @yield('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="{!! asset('public/js/html5shiv.js') !!}"></script>
    <script src="{!! asset('public/js/respond.js') !!}"></script>
    <![endif]-->
</head>

<body class="no-skin">
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <!-- /section:basics/sidebar.mobile.toggle -->
        <div class="navbar-header pull-left">
            <!-- #section:basics/navbar.layout.brand -->
            <a href="#" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    {{ config('app.name', 'Laravel') }} Admin
                </small>
            </a>
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                @include('administrator.layouts.notifications')

                <!-- #section:basics/navbar.user_menu -->
                @include('administrator.layouts.user-menu')

                <!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
    </div><!-- /.navbar-container -->
</div>

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <!-- #section:basics/sidebar -->
    <div id="sidebar" class="sidebar responsive">
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <!-- #section:basics/sidebar.layout.shortcuts -->
                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>

                <!-- /section:basics/sidebar.layout.shortcuts -->
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        @include('administrator.layouts.menu')

        <!-- #section:basics/sidebar.layout.minimize -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
            try{ace.settings.check('sidebar', 'collapsed')}catch(e){}
        </script>
    </div>

    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <div class="main-content-inner">
            <!-- #section:basics/content.breadcrumbs -->
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                @include('administrator.layouts.breadcrumb')
                <!-- /.breadcrumb -->


                <!-- /section:basics/content.searchbox -->
            </div>

            <!-- /section:basics/content.breadcrumbs -->
            <div class="page-content">

                <!-- /section:settings.box -->
                <div class="page-header">
                    <div class="col-md-6">
                        <h1>
                            @yield('module-title')
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                @yield('module-sub-title')
                            </small>
                        </h1>
                    </div>

                    <div class="col-md-6">
                        @if (Auth::user()->type == 2)
                        @yield('button-action')
                        @endif
                    </div>

                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE ALERT -->
                        @if(Session::has('message'))
                            <div class="alert alert-block alert-{{Session::get('alert','success')}}">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                <i class="ace-icon fa fa-check green"></i>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-block alert-{{Session::get('alert','danger')}}">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                <i class="ace-icon fa fa-times"></i>
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @yield('error')


                        @yield('content')
                    </div>
                </div>

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <!-- #section:basics/footer -->
            <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">{{ config('app.name', 'Laravel') }}</span>
                    Application &copy; 2019
                </span>
            </div>

            <!-- /section:basics/footer -->
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='{!! asset('public/js/jquery.js') !!}'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='{!! asset('public/js/jquery1x.js') !!}'>" + "<" + "/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{!! asset('public/js/jquery.mobile.custom.js') !!}'>" + "<" + "/script>");
</script>


<script src="{!! asset('public/js/bootstrap.js') !!}"></script>
<script src="{!! asset('public/js/ace.js') !!}"></script>

@yield('js')

<!-- inline scripts related to this page -->
<script type="text/javascript">

</script>
@yield('script')
</body>
</html>