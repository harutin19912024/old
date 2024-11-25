<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon"/>
    <title>{{$title}}</title>

    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/css/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- This is a Custom CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- This is a colors CSS -->
    <link href="{{asset('assets/css/colors/default.css')}}" id="theme" rel="stylesheet">

    {{--custom style--}}
    @stack('header')
</head>

<body class="fix-sidebar">

<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <a class="logo" href="/admin">
{{--add image for logo --}}
                </a>
            </div>

            <ul class="nav navbar-top-links navbar-left">
                <li>
                    <a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i
                            class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <b class="hidden-xs">{{Auth::user()->name}}</b>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>Logout
                            </a>
                        </li>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3>
                    <span class="fa-fw open-close">
                        <i class="fas fa-align-justify hidden-xs"></i>
                        <i class="fas fa-times visible-xs"></i>
                    </span>
                    <span class="hide-menu">Navigation</span>
                </h3>
            </div>

            <ul class="nav" id="side-menu">

                <li><a href="/admin" class="waves-effect"><i class="mdi mdi-home fa-fw"></i>
                        <span class="hide-menu">Главная</span></a>
                </li>

                <li class="devider"></li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/productmanagment.svg') }}">
                        <span class="hide-menu">Управление продуктом<span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/admin/products" class="waves-effect">
                                <span class="hide-menu">Товары</span></a>
                        </li>
                        {{--<li><a href="/admin/product/details" class="waves-effect"><i class="mdi mdi-cart fa-fw"></i>
                                <span class="hide-menu">Product Details</span></a>
                        </li>--}}
{{--                        <li><a href="/admin/product-tabs" class="waves-effect">
                                <span class="hide-menu">Product Tabs</span></a>
                        </li>--}}
                        {{--<li><a href="/admin/product/configuration" class="waves-effect"><i class="mdi mdi-cart fa-fw"></i>
                                <span class="hide-menu">Product Configuration</span></a>
                        </li>--}}
                        <li><a href="/admin/categories" class="waves-effect">
                                <span class="hide-menu">Категория</span></a>
                        </li>
                        <li><a href="/admin/catalog" class="waves-effect">
                                <span class="hide-menu">Каталог продукции</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/home.svg') }}">
                        <span class="hide-menu">Главная страница<span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="/admin/slider" class="waves-effect">
                                <span class="hide-menu">Слайдер</span></a>
                        </li>
                        <li><a href="/admin/about-us" class="waves-effect">
                                <span class="hide-menu">О Ресторане</span></a>
                        </li>
                        <li><a href="/admin/overview" class="waves-effect">
                                <span class="hide-menu">Что они сказали</span></a>
                        </li>
                        <li><a href="/admin/history" class="waves-effect">
                                <span class="hide-menu">ИСТОРИЯ</span></a>
                        </li>
                    </ul>
                </li>

{{--                <li>--}}
{{--                    <a href="javascript:void(0);" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/about.svg') }}">--}}
{{--                        <span class="hide-menu">О нас<span class="fa arrow"></span>--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                   --}}
{{--                </li>--}}

                <li><a href="/admin/media-center" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/mediacenter.svg') }}">
                        <span class="hide-menu">Галерея</span></a>
                </li>

                <li><a href="/admin/social" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/sociallinks.svg') }}">
                        <span class="hide-menu">СОЦИАЛЬНЫЕ ССЫЛКИ</span></a>
                </li>

                <li>
                    <a href="/admin/contact-us" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/contactus.svg') }}">
                        <span class="hide-menu">Контакты</span></a>
                </li>
                <li>
                    <a href="/admin/contact-us-data" class="waves-effect"><img class="menu-icon" src="{{ URL::asset('assets/icons/mailsettings.svg') }}">
                        <span class="hide-menu">Письмо</span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">{{$title}}</h4>
                </div>
            </div>

            <!-- .row -->
            <main class="py-4">
                @yield('content')
            </main>
            <!-- .row -->

        </div>
        <footer class="footer text-center"> 2022 &copy; Created By Levon</footer>
    </div>
</div>

</body>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('assets/css/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Sidebar menu plugin JavaScript -->
<script src="{{asset('assets/js/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('assets/js/waves.js')}}"></script>
<!-- Custom Theme JavaScript min -->
<script src="{{asset('assets/js/custom.min.js')}}"></script>

{{--custom script--}}

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--Datatable js-->
<script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/plugins/swal/sweetalert.min.js')}}"></script>
@stack('footer')

</html>
