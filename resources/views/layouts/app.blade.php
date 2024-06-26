<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name') }} </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link type="image/x-icon" href="{{ asset('img/favicon.png') }}" rel="shortcut icon" />
    <!-- Font Icons css -->
    <link href="{{ asset('css/font-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons-1.11.1/bootstrap-icons.css') }}" rel="stylesheet">
    <!-- plugins css -->
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Responsive css -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    {{-- Include Select2 CSS --}}
    <link href="{{ asset('vendors/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    {{-- Toastify --}}
    <link href="{{ asset('admin/vendors/toastify/toastify.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- HEADER AREA START (header-3) -->
        <header class="ltn__header-area ltn__header-3 section-bg-6---">
            <!-- ltn__header-top-area start -->
            <div class="ltn__header-top-area border-bottom top-area-color-white---">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    @if (isset(session('settings')['company_email']))
                                        <li><a href="mailto:{{ session('settings')['company_email'] }}?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i> {{ session('settings')['company_email'] }}</a></li>
                                    @endif
                                    <!-- <li><a href="#"><i class="icon-placeholder"></i> K1.15-16, Vo Nguyen Giap, Phu Thu ward, Cai Rang district,
                                            City. Can Tho. Viet Nam</a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="top-bar-right text-end">
                                <div class="ltn__top-bar-menu">
                                    <ul>
                                        <li>
                                            <!-- ltn__language-menu -->
                                            <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                                <ul>
                                                    @if (Session::get('language') == 'en')
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('language.change', ['language' => 'vn']) }}@stack('url')">
                                                                <span class="active-currency"><img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Flag_of_Vietnam.svg" width="18px"/> {{ __('Vietnamese') }}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (Session::get('language') == 'vn')
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('language.change', ['language' => 'en']) }}@stack('url')">
                                                                <span class="active-currency"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg" width="18px"/> {{ __('English') }}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <!-- ltn__social-media -->
                                            <div class="ltn__social-media">
                                                <ul>
                                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                                                    </li>

                                                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                    <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__header-top-area end -->
            <!-- ltn__header-middle-area start -->
            <div class="ltn__header-middle-area">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="site-logo">
                                <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.jpg') }}" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-md-6 header-contact-serarch-column d-none d-xl-block">
                            <div class="header-contact-search justify-content-end">
                                <!-- header-feature-item -->
                                <div class="header-feature-item d-none">
                                    <div class="header-feature-icon">
                                        <i class="icon-phone"></i>
                                    </div>
                                    <div class="header-feature-info">
                                        @if (isset(session('settings')['company_hotline']))
                                            <h6>Phone</h6>
                                            <p><a href="tel:{{ session('settings')['company_hotline'] }}">{{ session('settings')['company_hotline'] }}</a></p>
                                        @endif
                                    </div>
                                </div>
                                <!-- header-search-2 -->
                                <div class="header-search-2">
                                    <form id="#123" method="get" action="#">
                                        <input name="search" type="text" value="" placeholder="{{ __('Search here...') }}" />
                                        <button type="submit">
                                            <span><i class="icon-search"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <!-- header-options -->
                            <div class="ltn__header-options">
                                <ul>
                                    {{-- <li class="">
                                        <!-- ltn__currency-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu">
                                            <ul>
                                                <li><a class="dropdown-toggle" href="#"><span class="active-currency">USD</span></a>
                                                    <ul>
                                                        <li><a href="#">USD - US Dollar</a></li>
                                                        <li><a href="#">VND - Việt Nam Đồng</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> --}}
                                    <li class="d-none--- ">
                                        <!-- header-search-1 -->
                                        <div class="header-search-wrap d-block d-xl-none">
                                            <div class="header-search-1">
                                                <div class="search-icon">
                                                    <i class="icon-search  for-search-show"></i>
                                                    <i class="icon-cancel  for-search-close"></i>
                                                </div>
                                            </div>
                                            <div class="header-search-1-form">
                                                <form id="#" method="get" action="#">
                                                    <input name="search" type="text" value="" placeholder="{{ __('Search here...') }}" />
                                                    <button type="submit">
                                                        <span><i class="icon-search"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-none---">
                                        <!-- user-menu -->
                                        <div class="ltn__drop-menu user-menu">
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="icon-user"></i></a>
                                                    <ul>
                                                        @guest
                                                            @if (Route::has('login'))
                                                                <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Sign in') }}</a></li>
                                                            @endif
                                                            @if (Route::has('register'))
                                                                <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                                            @endif
                                                        @else
                                                            @if (Auth::user()->can(app\Models\User::ACCESS_ADMIN))
                                                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{ __('Admin Dashbard') }}</a></li>
                                                            @endif
                                                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">{{ __('My Account') }}</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                                    {{ __('Logout') }}
                                                                </a>
                                                            </li>
                                                        @endguest
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- mini-cart 2 -->
                                        <div class="mini-cart-icon mini-cart-icon-2">
                                            <a class="ltn__utilize-toggle" href="#ltn__utilize-cart-menu">
                                                <span class="mini-cart-icon">
                                                    <i class="icon-shopping-cart"></i>
                                                    @if (session('cart'))
                                                        <sup>{{ session('cart')->count }}</sup>
                                                    @endif
                                                </span>
                                                <h6><span>{{ __('Your Cart') }}</span> <span class="ltn__secondary-color text-lowercase">
                                                        @if (session('cart'))
                                                            {{ number_format(session('cart')->total) }}đ
                                                        @endif
                                                    </span>
                                                </h6>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__header-middle-area end -->

            <!-- MOBILE MENU START -->
            <div class="mobile-header-menu-fullwidth mb-20 d-block d-lg-none">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Mobile Menu Button -->
                            <div class="mobile-menu-toggle d-lg-none">
                                <span>MENU</span>
                                <a class="ltn__utilize-toggle" href="#ltn__utilize-mobile-menu">
                                    <svg viewBox="0 0 800 600">
                                        <path id="top" d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"></path>
                                        <path id="middle" d="M300,320 L540,320"></path>
                                        <path id="bottom" d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MOBILE MENU END -->

            <!-- header-bottom-area start -->
            <div class="header-bottom-area ltn__border-top--- ltn__header-sticky  ltn__sticky-bg-white ltn__primary-bg---- menu-color-white---- d-none--- d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 align-self-center">
                            <!-- CATEGORY-MENU-LIST START -->
                            <div class="ltn__category-menu-wrap ltn__category-dropdown-hide ltn__category-menu-with-header-menu">
                                <div class="ltn__category-menu-title">
                                    <h2 class="section-bg-1--- ltn__secondary-bg text-color-white">{{ __('Catalogues') }}</h2>
                                </div>
                                <div class="ltn__category-menu-toggle ltn__one-line-active">
                                    <ul>
                                        <!-- Submenu Column - unlimited -->
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="{{ route('shop.index') }}">{{ __('All Products') }}</a>
                                        </li>
                                        @if (session()->has('catalogues'))
                                            @foreach (session('catalogues')->where('status', 1)->whereNull('parent_id') as $catalogue)
                                                <li class="ltn__category-menu-item ltn__category-menu-drop">
                                                    <a class="cursor-pointer">{{ __($catalogue->name) }} </a>
                                                    <ul class="ltn__category-submenu ">
                                                        <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="{{ route('shop.index', ['catalogue' => $catalogue->slug]) }}">{{ __($catalogue->name) }}</a>
                                                            <ul class="ltn__category-submenu-children">
                                                                @foreach ($catalogue->children->where('status', 1) as $catalogue)
                                                                    <li><a href="{{ route('shop.index', ['catalogue' => $catalogue->slug]) }}">{{ __($catalogue->name) }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endforeach
                                        @endif
                                        <!-- Single menu end -->
                                    </ul>
                                </div>
                            </div>
                            <!-- END CATEGORY-MENU-LIST -->
                        </div>
                        <div class="col-lg-7">
                            <div class="col--- header-menu-column justify-content-center---">
                                <div class="header-menu header-menu-2 text-center">
                                    <nav>
                                        <div class="ltn__main-menu">
                                            <ul>
                                                <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
                                                <li class="{{ Request::path() == 'about' ? 'active' : '' }}"><a href="{{ route('home.index', ['page' => 'about']) }}">{{ __('About') }}</a></li>
                                                <li class="{{ Request::path() == 'shop' ? 'active' : '' }}"><a href="{{ route('shop.index') }}">{{ __('Shop') }}</a></li>
                                                <li class="menu-icon {{ Request::path() == 'posts' ? 'active' : '' }}"><a href="{{ route('home.index', ['page' => 'posts']) }}">{{ __('News') }}</a>
                                                    <ul>
                                                        @if (session('categories')->where('code', '!=', 'policies')->count())
                                                            @foreach (session('categories')->where('code', '!=', 'policies') as $category)
                                                                <li><a href="{{ route('home.index', ['page' => 'posts', 'category' => $category->code]) }}">{!! __($category->name) !!}</a></li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                                <li class="menu-icon {{ Request::path() == 'post' ? 'active' : '' }}"><a href="#">{{ __('Policies') }}</a>
                                                    <ul>
                                                        @if (session('categories')->where('code', 'policies')->first())
                                                            @foreach (session('categories')->where('code', 'policies')->first()->posts as $post)
                                                                <li><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                                <li class="{{ Request::path() == 'contact' ? 'active' : '' }}"><a href="{{ route('home.contact') }}">{{ __('Contact') }}</a></li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2 align-self-center d-none d-xl-block">
                            <div class="header-contact-info text-end">
                                @if (isset(session('settings')['company_hotline']))
                                    <a class="font-weight-6 ltn__primary-color" href="tel:{{ session('settings')['company_hotline'] }}">
                                        <span class="ltn__secondary-color">
                                            <i class="icon-call font-weight-7"></i>
                                        </span>
                                        {{ session('settings')['company_hotline'] }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-bottom-area end -->
        </header>
        <!-- HEADER AREA END -->

        @if (Request::path() != 'cart')
            <!-- Utilize Cart Menu Start -->
            <div class="ltn__utilize ltn__utilize-cart-menu" id="ltn__utilize-cart-menu">
                <div class="ltn__utilize-menu-inner ltn__scrollbar">
                    <div class="ltn__utilize-menu-head">
                        <span class="ltn__utilize-menu-title">{{ __('Cart') }}</span>
                        <button class="ltn__utilize-close">×</button>
                    </div>
                    <div class="mini-cart-product-area ltn__scrollbar">
                        @if (session('cart'))
                            @foreach (session('cart')->items as $item)
                                <div class="mini-cart-item clearfix">
                                    <div class="mini-cart-img">
                                        <a href="{{ $item->variable->product->url }}"><img src="{{ $item->variable->product->imageUrl }}" alt="Image"></a>
                                        <form action="{{ route('cart.remove') }}" method="post">
                                            @csrf
                                            <input name="variable_id" type="hidden" value="{{ $item->variable_id }}">
                                            <button class="mini-cart-item-delete" type="submit"><i class="icon-cancel"></i></button>
                                        </form>
                                    </div>
                                    <div class="mini-cart-info">
                                        <h6 class="mb-0"><a href="{{ $item->variable->product->url }}">{{ $item->variable->product->sku . ' - ' . $item->variable->product->name }}</a></h6>
                                        <small class="text-secondary mb-0">{{ ($item->variable->sub_sku != null ? $item->variable->sub_sku : '') . ($item->variable->name != null ? ' - ' . $item->variable->name : '') }}</small>
                                        <span class="mini-cart-quantity">{{ $item->quantity }} &times; {{ number_format($item->price) }}đ</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="mini-cart-footer">
                        <div class="mini-cart-sub-total">
                            <h5>{{ __('Subtotal:') }} <span>
                                    @if (session('cart'))
                                        {{ number_format(session('cart')->total) }}đ
                                    @endif
                                </span></h5>
                        </div>
                        <div class="btn-wrapper">
                            <a class="theme-btn-1 btn btn-effect-1 p-3" href="{{ route('cart.index') }}">{{ __('View Cart') }}</a>
                            <a class="theme-btn-2 btn btn-effect-2 p-3" href="{{ route('cart.checkout') }}">{{ __('Checkout') }}</a>
                        </div>
                        {{-- <p>{{ __('Free Shipping on All Orders Over') }} 1.000.000đ!</p> --}}
                    </div>

                </div>
            </div>
            <!-- Utilize Cart Menu End -->
        @endif

        <!-- Utilize Mobile Menu Start -->
        <div class="ltn__utilize ltn__utilize-mobile-menu" id="ltn__utilize-mobile-menu">
            <div class="ltn__utilize-menu-inner ltn__scrollbar">
                <div class="ltn__utilize-menu-head">
                    <div class="site-logo">
                        <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.jpg') }}" alt="Logo"></a>
                    </div>
                    <button class="ltn__utilize-close">×</button>
                </div>
                <div class="ltn__utilize-menu-search-form">
                    <form action="#">
                        <input type="text" placeholder="{{ __('Search here...') }}">
                        <button><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="ltn__utilize-menu">
                    <ul>
                        <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
                        <li class="{{ Request::path() == 'about' ? 'active' : '' }}"><a href="{{ route('home.index', ['page' => 'about']) }}">{{ __('About') }}</a></li>
                        <li class="{{ Request::path() == 'shop' ? 'active' : '' }}"><a href="{{ route('shop.index') }}">{{ __('Shop') }}</a> </li>
                        <li class="{{ Request::path() == 'posts' ? 'active' : '' }}"><a href="#">{{ __('News') }}</a>
                            <ul class="sub-menu">
                                @if (session('categories')->where('code', '!=', 'policies')->count())
                                    @foreach (session('categories')->where('code', '!=', 'policies') as $category)
                                        <li><a href="{{ route('home.index', ['page' => 'posts', 'category' => $category->code]) }}">{!! __($category->name) !!}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li><a href="#">{{ __('Policies') }}</a>
                            <ul class="sub-menu">
                                @if (session('categories')->where('code', 'policies')->first())
                                    @foreach (session('categories')->where('code', 'policies')->first()->posts as $post)
                                        <li><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="{{ Request::path() == '/' ? 'contact' : '' }}"><a href="{{ route('home.contact') }}">{{ __('Contact') }}</a></li>
                    </ul>
                </div>
                <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                    <ul>
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}" title="{{ __('Sign in') }}">
                                        <span class="utilize-btn-icon">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </span>
                                        {{ __('Sign in') }}
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" title="{{ __('Register') }}">
                                        <span class="utilize-btn-icon">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="{{ route('profile.index') }}" title="{{ __('My Account') }}">
                                    <span class="utilize-btn-icon">
                                        <i class="far fa-user"></i>
                                    </span>
                                    {{ __('My Account') }}
                                </a>
                            </li>
                        @endguest
                        <li>
                            <a href="{{ route('cart.index') }}" title="Shoping Cart">
                                <span class="utilize-btn-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                    <sup>
                                        @if (session('cart'))
                                            {{ number_format(session('cart')->count) }}
                                        @endif
                                    </sup>
                                </span>
                                {{ __('Shoping Cart') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ltn__social-media-2">
                    <ul>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Utilize Mobile Menu End -->

        <div class="ltn__utilize-overlay"></div>

        @yield('content')

        <!-- FOOTER AREA START -->
        <footer class="ltn__footer-area  ">
            <div class="footer-top-area  section-bg-2 plr--5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-about-widget">
                                <div class="footer-logo">
                                    <div class="site-logo">
                                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                                    </div>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                        @if (isset(session('settings')['company_address']))
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-placeholder"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p>{{ __('Address') }}: {{ session('settings')['company_address'] }}</p>
                                                </div>
                                            </li>
                                        @endif
                                        @if (isset(session('settings')['company_phone']))
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="bi bi-headset"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p>{{ __('Customer service') }}: <a href="tel:{{ session('settings')['company_phone'] }}">{{ session('settings')['company_phone'] }}</a></p>
                                                </div>
                                            </li>
                                        @endif
                                        @if (isset(session('settings')['company_email']))
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-mail"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p>{{ __('Email') }}: <a href="mailto:{{ session('settings')['company_email'] }}">{{ session('settings')['company_email'] }}</a></p>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="ltn__social-media mt-20">
                                    <ul>
                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">{{ __('Main category') }}</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
                                        <li><a href="{{ route('home.index', ['page' => 'about']) }}">{{ __('About') }}</a></li>
                                        <li><a href="{{ route('shop.index') }}">{{ __('Shop') }}</a></li>
                                        <li><a href="{{ route('home.index', ['page' => 'posts']) }}">{{ __('News') }}</a></li>
                                        <li><a href="{{ route('home.contact') }}">{{ __('Contact us') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">{{ __('Policies') }}</h4>
                                <div class="footer-menu">
                                    <ul>
                                        @if (session('categories')->where('code', 'policies')->first())
                                            @foreach (session('categories')->where('code', 'policies')->first()->posts as $post)
                                                <li><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">{{ __('Product Categories') }}</h4>
                                <div class="footer-menu">
                                    <ul>
                                        @foreach (session('catalogues')->whereNull('parent_id') as $catalogue)
                                            <li><a href="{{ route('shop.index', ['catalogue' => $catalogue->slug]) }}">{!! __($catalogue->name) !!}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                            <div class="footer-widget footer-newsletter-widget">
                                <h4 class="footer-title">{{ __('Newsletter') }}</h4>
                                <p>{{ __('Subscribe to our weekly Newsletter and receive updates via email.') }}</p>
                                <div class="footer-newsletter">
                                    <form action="#">
                                        <input name="email" type="email" placeholder="Email*">
                                        <div class="btn-wrapper">
                                            <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <h5 class="mt-30">{{ __('We Accept') }}</h5>
                                <img src="{{ asset('img/icons/payment-4.png') }}" alt="Payment Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
                <div class="container-fluid ltn__border-top-2">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="ltn__copyright-design clearfix">
                                <p>{{ __('All Rights Reserved @ PHUSA Genomics') }} <span class="current-year"></span></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 align-self-center">
                            <div class="ltn__copyright-menu text-end">
                                <ul>
                                    @guest
                                        @if (Route::has('login'))
                                            <li><a href="{{ route('login') }}">{{ __('Sign in') }}</a></li>
                                        @endif
                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                        @endif
                                    @else
                                        @if (Auth::user()->can(app\Models\User::ACCESS_ADMIN))
                                            <li><a href="{{ route('admin.dashboard') }}">{{ __('Admin Dashbard') }}</a></li>
                                        @endif
                                        <li><a href="{{ route('profile.index') }}">{{ __('My Account') }}</a></li>
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </li>
                                    @endguest
                                    <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER AREA END -->
    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    <!-- All JS Plugins -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    {{-- Include Toastify --}}
    <script src="{{ asset('admin/vendors/toastify/toastify.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- Include moment JS --}}
    <script type="text/javascript" src="{{ asset('admin/vendors/momentJS/moment.js') }}"></script>
    {{-- input image JSCompressor --}}
    <script src="{{ asset('admin/vendors/compressorjs/compressor.min.js') }}"></script>
    {{-- Include Select2 --}}
    <script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/i18n/vi.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        moment.locale("vi");
        const config = {
            routes: {
                login: `{{ route('login') }}`,
                placeholder: `asset('admin/images/placeholder.webp')`
            },
            select2: {
                ajax: {
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data,
                            pagination: {
                                more: false
                            }
                        }
                    },
                    cache: 500,
                    delay: true,
                },
                language: "vi",
                theme: "bootstrap-5",
                width: '100%',
                allowClear: true,
                closeOnSelect: false,
                scrollOnSelect: true,
            }
        }
    </script>
    @stack('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.btn-add-to-cart', function(e) {
                e.preventDefault();
                const form = $(this).closest('form')
                submitForm(form).done(function(response) {
                    form.find('[type=submit]:last').prop("disabled", false).html('<i class="fas fa-shopping-cart"></i> <span>ADD TO CART</span>');
                    updateMiniCart(response.cart);
                    $("body").addClass("ltn__utilize-open");
                    $(".ltn__utilize-overlay").fadeIn();
                    $("#ltn__utilize-cart-menu").addClass("ltn__utilize-open");
                })
            })

            function updateMiniCart(cart) {
                // Update mini cart icon
                $('.mini-cart-icon sup').add('.ltn__utilize-buttons sup').text(cart.count);
                $('.mini-cart-icon h6 .ltn__secondary-color').text(number_format(cart.total) + 'đ');

                // Update cart menu
                var miniCartHtml = '';
                cart.items.forEach(function(item) {
                    miniCartHtml += `
                        <div class="mini-cart-item clearfix">
                            <div class="mini-cart-img">
                                <a href="${item.variable.product.url}"><img src="${item.variable.product.imageUrl}" alt="${item.variable.product.sku + (item.variable.sub_sku != null ? item.variable.sub_sku : '')} - ${item.variable.product.name + (item.variable.name != null ? ' - ' + item.variable.name : '')}"></a>
                                <form action="{{ route('cart.remove') }}" method="post">
                                    @csrf
                                    <input name="variable_id" type="hidden" value="${item.variable_id}">
                                    <button class="mini-cart-item-delete" type="submit"><i class="icon-cancel"></i></button>
                                </form>
                            </div>
                            <div class="mini-cart-info">
                                <h6><a href="${item.variable.product.url}">${item.variable.product.sku + (item.variable.sub_sku != null ? item.variable.sub_sku : '')} - ${item.variable.product.name + (item.variable.name != null ? ' - ' + item.variable.name : '')}</a></h6>
                                <span class="mini-cart-quantity">${item.quantity} &times; ${number_format(item.price)}đ</span>
                            </div>
                        </div>`;
                });
                $('.mini-cart-product-area').html(miniCartHtml);

                // Update subtotal
                $('.mini-cart-sub-total span').text(number_format(cart.total) + 'đ');
            }

            // Handle item removal from mini cart
            $(document).on('click', '.mini-cart-item-delete', function(e) {
                e.preventDefault();
                const form = $(this).closest('form')
                submitForm(form).done(function(response) {
                    form.find('[type=submit]:last').prop("disabled", false).html('<i class="icon-cancel"></i>');
                    updateMiniCart(response.cart);
                })
            })
        });
    </script>
</body>

</html>
