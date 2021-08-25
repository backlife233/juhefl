<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @isset($title)
        <title>{{$title}} | {{config('website_name')}} | {{safe_str('聚合优质站点！')}}</title>
    @else
        <title>{{config('website_name')}} | {{safe_str('聚合优质站点！')}}</title>
    @endif
    @isset($keyword)
        <meta name="keyword" content="{{$keyword}}">
    @endisset
    @isset($description)
        <meta name="description" content="{{$description}}">
    @endisset
    <meta name="robots" content="noindex, follow"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/plugins.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/pop/bs4pop.css')}}">
    @yield('css')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}?{{get_version()}}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205886969-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-205886969-2');
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-23E8YGJ3D5');
    </script>
</head>

<body class="active-dark-mode">
<div class="main-wrapper">
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <div id="my_switcher" class="my_switcher">
        <ul>
            <li>
                <a href="javascript: void(0);" data-theme="light" class="setColor light">
                    <span title="Light Mode">Light</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                    <span title="Dark Mode">Dark</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Start Header -->
    <header class="header axil-header header-style-6  header-light header-sticky ">
        <div class="header-top">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xl-4">
                    <ul class="social-icon color-white md-size justify-content-center justify-content-sm-start">
                        <li><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                    </ul>
                </div>


                <div class="col-lg-2 col-md-6 col-sm-6 col-xl-4">
                    <div class="logo text-center">
                        <a href="{{route('index')}}">
                            <img class="dark-logo" src="{{safe_logo_black()}}"
                                 alt="Blog logo">
                            <img class="light-logo" src="{{safe_logo_white()}}"
                                 alt="Blog logo">
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 col-sm-12 col-xl-4">
                    <div
                        class="header-top-bar d-flex justify-content-center justify-content-lg-end flex-wrap align-items-center">
                        <ul class="header-top-date liststyle d-flex flrx-wrap align-items-center mr--20">
                            <li><a href="#">{{now()->toFormattedDateString()}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-7 col-12">
                    <div class="mainmenu-wrapper d-none d-xl-block">
                        <nav class="mainmenu-nav">
                            <!-- Start Mainmanu Nav -->
                            <ul class="mainmenu">
                                @foreach($navs as $nav)
                                    <li class="
                                    @if(isset($nav['subNav']) && !empty($nav['subNav']))
                                        menu-item-has-children
                                    @endif
                                        "><a href="{{$nav['link']}}"
                                             title="{{$nav['name']}}">{{safe_str($nav['name'])}}</a>
                                        @if(isset($nav['subNav']) && !empty($nav['subNav']))
                                            <ul class="axil-submenu">
                                                @foreach($nav['subNav'] as $n)
                                                    <li>
                                                        <a class="hover-flip-item-wrapper" href="{{$n['link']}}">
                                                            <span class="hover-flip-item">
                        <span data-text="{{$n['name']}}">{{$n['name']}}</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li><a href="javascript:void(0);" class="collection">收藏本站</a></li>
                                <li><a href="{{route('user.friends')}}" title="友链管理">友链管理</a></li>
                                <li><a href="{{route('friend.create')}}" title="自助添加友链">自助添加友链</a></li>
                            </ul>
                            <!-- End Mainmanu Nav -->
                        </nav>
                    </div>
                </div>
                <div class="col-xl-5 col-12">
                    <div
                        class="header-search d-flex flex-wrap align-items-center justify-content-center justify-content-xl-end">
                        <form class="header-search-form">
                            <div class="axil-search form-group">
                                <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                <input type="text" class="form-control" placeholder="搜索">
                            </div>
                        </form>
                        <ul class="metabar-block">
                            <li class="icon"><a href="#"><i class="fas fa-bookmark"></i></a></li>
                            <li class="icon"><a href="#"><i class="fas fa-bell"></i></a></li>
                            <li class="need_children">
                                <a href="{{route('user.friends')}}" title="友链管理">
                                    <img src="{{asset('assets/images/others/author.png')}}" alt="用户头像" width="40"
                                         height="40">
                                </a>
                                <ul class="submenu">
                                    @guest
                                        <li>
                                            <a href="{{route('login')}}">登录</a>
                                        </li>
                                    @endguest
                                    @auth
                                        <li><a href="{{route('user.friends')}}" title="友链管理">友链管理</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                退出
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                        <!-- Start Hamburger Menu  -->
                        <div class="hamburger-menu d-block d-xl-none">
                            <div class="hamburger-inner">
                                <div class="icon"><i class="fal fa-bars"></i></div>
                            </div>
                        </div>
                        <!-- End Hamburger Menu  -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Start Header -->

    <!-- Start Mobile Menu Area  -->
    <div class="popup-mobilemenu-area">
        <div class="inner">
            <div class="mobile-menu-top">
                <div class="logo">
                    <a href="{{route('index')}}">
                        <img class="dark-logo" src="{{safe_logo_black()}}" alt="Logo Images">
                        <img class="light-logo" src="{{safe_logo_white()}}" alt="Logo Images">
                    </a>
                </div>
                <div class="mobile-close">
                    <div class="icon">
                        <i class="fal fa-times"></i>
                    </div>
                </div>
            </div>
            <ul class="mainmenu">
                @foreach($navs as $nav)
                    <li><a href="{{$nav['link']}}"
                           title="{{$nav['name']}}">{{safe_str($nav['name'])}}</a></li>
                @endforeach
                <li><a href="javascript:void(0);" class="collection">收藏本站</a></li>
            </ul>
        </div>
    </div>
    <!-- End Mobile Menu Area  -->

@yield('content')

<!-- Start Footer Area  -->
    <div class="axil-footer-area axil-footer-style-1 bg-color-white">
        <!-- Start Footer Top Area  -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Start Post List  -->
                        <div class="inner d-flex align-items-center flex-wrap">
                            <h5 class="follow-title mb--0 mr--20">联系客服</h5>
                            <ul class="social-icon color-tertiary md-size justify-content-start">
                                <li><a href="#"><i class="fab fa-telegram-plane"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Post List  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top Area  -->

        <!-- Start Copyright Area  -->
        <div class="copyright-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-md-12">
                        <div class="copyright-left">
                            <div class="logo">
                                <a href="{{route('index')}}">
                                    <img class="dark-logo" src="{{safe_logo_black()}}"
                                         alt="Logo Images">
                                    <img class="light-logo" src="{{safe_logo_white()}}"
                                         alt="Logo Images">
                                </a>
                            </div>
                            <ul class="mainmenu justify-content-start">
                                @foreach($navs as $nav)
                                    <li>
                                        <a class="hover-flip-item-wrapper" href="{{$nav['link']}}">
                                            <span class="hover-flip-item">
                                        <span data-text="{{safe_str($nav['name'])}}">{{safe_str($nav['name'])}}</span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="copyright-right text-left text-lg-right mt_md--20 mt_sm--20">
                            <p class="b3">All Rights Reserved © 2018-2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area  -->
    </div>
    <!-- End Footer Area  -->

    <!-- Start Back To Top  -->
    <a id="backto-top"></a>
    <!-- End Back To Top  -->

</div>

<!-- JS
============================================ -->
<!-- Modernizer JS -->
<script src="{{asset('assets/js/vendor/modernizr.min.js')}}"></script>
<!-- jQuery JS -->
<script src="{{asset('assets/js/vendor/jquery.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/slick.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/tweenmax.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery.style.switcher.js')}}"></script>
<script src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
<script src="{{asset('assets/plugins/pop/bs4pop.js')}}"></script>
<script type="text/javascript">
    function HUB() {
    }

    HUB.public = "{{ asset('/') }}";
    HUB._token = '{{csrf_token()}}';
</script>
<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>
@yield('js')
<script src="{{asset('assets/js/self.js')}}?{{get_version()}}"></script>
@yield('script')
</body>

</html>
