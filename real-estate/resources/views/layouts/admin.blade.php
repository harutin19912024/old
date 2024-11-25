<!DOCTYPE html>
<html>

<head>
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <title>AdminDesigns - A Responsive HTML5 Admin UI Framework</title>
  <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme" />
  <meta name="description" content="AdminDesigns - A Responsive HTML5 Admin UI Framework">
  <meta name="author" content="AdminDesigns">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font CSS (Via CDN) -->
  <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-forms.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/footable.core.min.css') }}">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('/img/favicon.ico')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>

<body class="">


  <!-- Start: Main -->
  <div id="main">

    <!-- Start: Header -->
    <header class="navbar navbar-fixed-top">
      <div class="navbar-branding">
        <a class="navbar-brand" href="dashboard.html">
          <b>Admin</b>Designs
        </a>
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
      </div>
      
      <form class="navbar-form navbar-left navbar-search" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search..." value="Search...">
        </div>
      </form>

      <ul class="nav navbar-nav navbar-right">
       
        
        <li class="menu-divider hidden-xs">
          <i class="fa fa-circle"></i>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> 
              <img src="{{ asset('img/avatars/1.jpg')}}" alt="avatar" class="mw30 br64 mr15"> John.Smith
            <span class="caret caret-tp hidden-xs"></span>
          </a>
          <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">

<!--            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-envelope"></span> Messages
                <span class="label label-warning">2</span>
              </a>
            </li>
            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-user"></span> Friends
                <span class="label label-warning">6</span>
              </a>
            </li>-->
            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-gear"></span> Account Settings </a>
            </li>
            <li class="list-group-item">
              <a href="/logout" class="animated animated-short fadeInUp">
                <span class="fa fa-power-off"></span> Logout </a>
            </li>
          </ul>
        </li>
      </ul>

    </header>
    <!-- End: Header -->

    <!-- Start: Sidebar -->
    <aside id="sidebar_left" class="nano nano-primary affix">

      <!-- Start: Sidebar Left Content -->
      <div class="sidebar-left-content nano-content">

        <!-- Start: Sidebar Header -->
        <header class="sidebar-header">

          <!-- Sidebar Widget - Menu (Slidedown) -->
          <div class="sidebar-widget menu-widget">
            <div class="row text-center mbn">
              <div class="col-xs-4">
                <a href="dashboard.html" class="text-primary" data-toggle="tooltip" data-placement="top" title="Dashboard">
                  <span class="glyphicon glyphicon-home"></span>
                </a>
              </div>
              <div class="col-xs-4">
                <a href="pages_messages.html" class="text-info" data-toggle="tooltip" data-placement="top" title="Messages">
                  <span class="glyphicon glyphicon-inbox"></span>
                </a>
              </div>
              <div class="col-xs-4">
                <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tasks">
                  <span class="glyphicon glyphicon-bell"></span>
                </a>
              </div>
              <div class="col-xs-4">
                <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Activity">
                  <span class="fa fa-desktop"></span>
                </a>
              </div>
              <div class="col-xs-4">
                <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Settings">
                  <span class="fa fa-gears"></span>
                </a>
              </div>
              <div class="col-xs-4">
                <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cron Jobs">
                  <span class="fa fa-flask"></span>
                </a>
              </div>
            </div>
          </div>

          <!-- Sidebar Widget - Author (hidden)  -->
          <div class="sidebar-widget author-widget hidden">
            <div class="media">
              <a class="media-left" href="#">
                <img src="assets/img/avatars/3.jpg" class="img-responsive">
              </a>
              <div class="media-body">
                <div class="media-links">
                   <a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="pages_login(alt).html">Logout</a>
                </div>
                <div class="media-author">Michael Richards</div>
              </div>
            </div>
          </div>

          <!-- Sidebar Widget - Search (hidden) -->
          <div class="sidebar-widget search-widget hidden">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-search"></i>
              </span>
              <input type="text" id="sidebar-search" class="form-control" placeholder="Search...">
            </div>
          </div>

        </header>
        <!-- End: Sidebar Header -->

        <!-- Start: Sidebar Menu -->
        <ul class="nav sidebar-menu">
          <li class="sidebar-label pt20">Menu</li>
          <li  class="{{ Request::is('/') || Request::is('/*') ? 'active' : '' }}">
            <a href="/">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Dashboard</span>
            </a>
          </li>
          @if(Auth::check() && (Auth::user()->hasRole('broker') || Auth::user()->hasRole('agent')))
          <li  class="{{ Request::is('users') || Request::is('users/*') ? 'active' : '' }}">
            <a href="/users">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Users</span>
            </a>
          </li>
          <li  class="{{ Request::is('deals') || Request::is('deals/*') ? 'active' : '' }}">
            <a href="/deals">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Deals</span>
            </a>
          </li>
          <li  class="{{ Request::is('deal-parties') || Request::is('deal-parties/*') ? 'active' : '' }}">
            <a href="/deal-parties">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Deal Parties</span>
            </a>
          </li>
          <li  class="{{ Request::is('deal-status') || Request::is('deal-status/*') ? 'active' : '' }}">
            <a href="/deal-status">
              <span class="fa fa-calendar"></span>
              <span class="sidebar-title">Deal Status</span>
            </a>
          </li>
          @endif
         
         
        </ul>
        <!-- End: Sidebar Menu -->

      </div>
      <!-- End: Sidebar Left Content -->

    </aside>

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">
        @yield('content')
    </section>
    
  </div>
  <!-- End: Main -->

  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->

  <!-- Theme Javascript -->
    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/utility.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('js/footable.all.min.js') }}"></script>
    <script src="{{ asset('js/footable.filter.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core    
    Core.init();


  });
  </script>
  <!-- END: PAGE SCRIPTS -->
    @yield('page-js-script')
</body>

</html>
