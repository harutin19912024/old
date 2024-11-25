<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ресторан 1001 ночь</title>
    <link rel="icon" href="../images/favicon.png" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/flaticon.css">
    <link rel="stylesheet" href="./css/gijgo.min.css">
    <link rel="stylesheet" href="./css/magnific-popup.css">
    <link rel="stylesheet" href="./css/nice-select.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/slick.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/themify-icons.css">

</head>
<body>


<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img
                            src="../images/logo.jpg" width="77" height="47"
{{--                            src="data:image/webp;base64,UklGRjoBAABXRUJQVlA4TC4BAAAvTMAEEMdAmG1Uf5gp3vMUBAJJ/oLjLCAoem82g2wjnUJZ5s/0CJ/Y/nGnGgBCgAAgQbbttm3+xQdYQXz3cP9bRUc2ENH/CYha91uUulcvdVP1Uty0Gk6T6qV6SH2j2aWSgWu4wRWM5qOywdbh8gxsHXTUJsUUgH1aMjNLJ8AxR8TDNs2k7IBZYaUE2CS/kk1LAbj/P1wRYJdl7gmtxzIPoDJInXNOM8K0K8YYLw9wD9qknDwQK1hTaGg9ZJKIwjbggG3EI/P2prOmbcd5npcCtkCoiAesdAGxwUREDPDTbAfOQgR4sgNw0iM3cPZ8/Hv/PjZwoajkVhAPoKrksU82IHX8vO/7vdEZpRpovGWAAK7jt89f0hq1tJsMeYAr2ytf7/t+ykx70pNk3Y9PEQ=="--}}
                            alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg>
                    </button>
                    <div class="collapse navbar-collapse main-menu-item justify-content-end"
                         id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about') }}">О ресторане</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('food_menu') }}">Меню</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" target="blank" href="https://eda.yandex.ru/restaurant/tysyacha_i_odna_noch_millionnaya_21">Доставка</a>
                            </li>
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a class="nav-link dropdown-toggle" href="./blog.html" id="navbarDropdown" role="button"--}}
{{--                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    Blog--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('blog') }}">Blog</a>--}}
{{--                                    <a class="dropdown-item" href="{{ route('single_blog') }}">Single blog</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a class="nav-link dropdown-toggle" href="{{ route('blog') }}" id="navbarDropdown_1"--}}
{{--                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                    Галерея--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">--}}
{{--                                    <a class="dropdown-item" href="{{ route('elements') }}">Elements</a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('elements') }}">Галерея</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">Контакты</a>
                            </li>
                        </ul>
                    </div>
                    <div class="social_icon d-none d-lg-block">
                        <a target="blank" href="https://eda.yandex.ru/restaurant/tysyacha_i_odna_noch_millionnaya_21" class="single_social_icon"><i class="fab fa-yandex-international fa-2x"></i></a>
                        <a target="blank" href="https://instagram.com/1001night.restaurant?igshid=YmMyMTA2M2Y=" class="single_social_icon"><i class="fab fa-instagram fa-2x"></i></a>
                        <a target="blank" href="https://vk.com/club74506872" class="single_social_icon"><i class="fab fa-vk fa-2x"></i></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<div id="app">
    <main class="py-4--">
        @yield('content')
    </main>
</div>


<footer class="footer-area">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-6 col-md-3 col-lg-3">
                <div class="single-footer-widget footer_1">
                    <img
                        src="../images/logo.jpg" width="77" height="47"
{{--                        src="data:image/webp;base64,UklGRjoBAABXRUJQVlA4TC4BAAAvTMAEEMdAmG1Uf5gp3vMUBAJJ/oLjLCAoem82g2wjnUJZ5s/0CJ/Y/nGnGgBCgAAgQbbttm3+xQdYQXz3cP9bRUc2ENH/CYha91uUulcvdVP1Uty0Gk6T6qV6SH2j2aWSgWu4wRWM5qOywdbh8gxsHXTUJsUUgH1aMjNLJ8AxR8TDNs2k7IBZYaUE2CS/kk1LAbj/P1wRYJdl7gmtxzIPoDJInXNOM8K0K8YYLw9wD9qknDwQK1hTaGg9ZJKIwjbggG3EI/P2prOmbcd5npcCtkCoiAesdAGxwUREDPDTbAfOQgR4sgNw0iM3cPZ8/Hv/PjZwoajkVhAPoKrksU82IHX8vO/7vdEZpRpovGWAAK7jt89f0hq1tJsMeYAr2ytf7/t+ykx70pNk3Y9PEQ=="--}}
                        alt="logo">
{{--                    <p>+880 253 356 263</p>--}}
{{--                    <span>burires@contact.com</span>--}}
                    <div class="social_icon">
                        <a target="blank" href="https://eda.yandex.ru/restaurant/tysyacha_i_odna_noch_millionnaya_21" class="single_social_icon"><i class="fab fa-yandex-international fa-2x"></i></a>
                        <a target="blank" href="https://instagram.com/1001night.restaurant?igshid=YmMyMTA2M2Y=" class="single_social_icon"><i class="fab fa-instagram fa-2x"></i></a>
                        <a target="blank" href="https://vk.com/club74506872" class="single_social_icon"><i class="fab fa-vk fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-md-2 col-lg-3">
                <div class="single-footer-widget footer_2">
                    <h4>Карта сайта</h4>
                    <div class="contact_info">
                        <ul>
                            <li><a href="{{ route('home') }}">Главная</a></li>
                            <li><a href="{{ route('about') }}">О ресторане</a></li>
{{--                            <li><a href="{{ route('menu') }}"> Меню</a></li>--}}
                            <li><a href="https://eda.yandex.ru/restaurant/tysyacha_i_odna_noch_millionnaya_21">Доставка</a></li>
                            <li><a href="{{ route('contact') }}">Контакты</a></li>
                            <li><a href="{{ route('elements') }}"> Галерея</a></li>
                            <li><a href="{{ route('food_menu') }}">Меню</a></li>
                        </ul>
                    </div>
                </div>
            </div>
{{--            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">--}}
{{--                <div class="single-footer-widget footer_3">--}}
{{--                    <h4>Subscribe newsletter</h4>--}}
{{--                    <form action="https://preview.colorlib.com/theme/buri/index.html#">--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="input-group mb-3">--}}
{{--                                <input type="text" class="form-control" placeholder="Email Address"--}}
{{--                                       onfocus="this.placeholder = &#39;&#39;"--}}
{{--                                       onblur="this.placeholder = &#39;Email Address&#39;">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn" type="button">--}}
{{--                                        <i class="fas fa-paper-plane"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <p>--}}
{{--                        Subscribe newsletter to get all updates about discount and offers.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="copyright_part_text">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="footer-text m-0">Все права защищены ©  {{ date("Y") }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="./js/jquery-1.12.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/gijgo.min.js"></script>
<script src="./js/jquery.magnific-popup.js"></script>
<script src="./js/jquery.nice-select.min.js"></script>
<script src="./js/masonry.pkgd.js"></script>
<script src="./js/owl.carousel.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/slick.min.js"></script>
<script src="./js/swiper.min.js"></script>
<script src="./js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
