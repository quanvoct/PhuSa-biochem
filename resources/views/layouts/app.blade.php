<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')- {{ config('app.name') }} </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('css/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons-1.11.1/bootstrap-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
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
                                    <li><a href="mailto:cskh@phusagenomics.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i> cskh@phusagenomics.com</a></li>
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
                                                    <li><a href="#" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                        <ul>
                                                            <li><a href="#">English</a></li>
                                                            <li><a href="#">Vietnamese</a></li>
                                                        </ul>
                                                    </li>
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
                        <div class="col">
                            <div class="site-logo">
                                <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.svg') }}" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col header-contact-serarch-column d-none d-xl-block">
                            <div class="header-contact-search">
                                <!-- header-feature-item -->
                                <div class="header-feature-item d-none">
                                    <div class="header-feature-icon">
                                        <i class="icon-phone"></i>
                                    </div>
                                    <div class="header-feature-info">
                                        <h6>Phone</h6>
                                        <p><a href="tel:+84931035935">+84 931035935</a></p>
                                    </div>
                                </div>
                                <!-- header-search-2 -->
                                <div class="header-search-2">
                                    <form id="#123" method="get" action="#">
                                        <input type="text" name="search" value="" placeholder="Search here..." />
                                        <button type="submit">
                                            <span><i class="icon-search"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- header-options -->
                            <div class="ltn__header-options">
                                <ul>
                                    <li class="d-none">
                                        <!-- ltn__currency-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu">
                                            <ul>
                                                <li><a href="#" class="dropdown-toggle"><span class="active-currency">USD</span></a>
                                                    <ul>
                                                        <li><a href="#">USD - US Dollar</a></li>
                                                        <li><a href="#">VND - Việt Nam Đồng</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
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
                                                    <input type="text" name="search" value="" placeholder="Search here..." />
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
                                                        <li><a href="#">Sign in</a></li>
                                                        <li><a href="#">Register</a></li>
                                                        <li><a href="#">My Account</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- mini-cart 2 -->
                                        <div class="mini-cart-icon mini-cart-icon-2">
                                            <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                <span class="mini-cart-icon">
                                                    <i class="icon-shopping-cart"></i>
                                                    <sup>2</sup>
                                                </span>
                                                <h6><span>Your Cart</span> <span class="ltn__secondary-color text-lowercase">890.000<sup>đ</sup></span>
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
                                <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                    <svg viewBox="0 0 800 600">
                                        <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                        <path d="M300,320 L540,320" id="middle"></path>
                                        <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
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
                                    <h2 class="section-bg-1--- ltn__secondary-bg text-color-white">categories</h2>
                                </div>
                                <div class="ltn__category-menu-toggle ltn__one-line-active">
                                    <ul>
                                        <!-- Submenu Column - unlimited -->
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="{{ route('home.shop') }}">All products</a>
                                        </li>
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="#">Oligo/Primer </a>
                                            <ul class="ltn__category-submenu ">
                                                <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="#">Oligo/Primer</a>
                                                    <ul class="ltn__category-submenu-children">
                                                        <li><a href="{{ route('home.shop') }}">Oligo Tubes</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Oligo Plate</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Oligo Modification</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- Submenu -->
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="#">Biology Products</a>
                                            <ul class="ltn__category-submenu">
                                                <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="#">Biology Products</a>
                                                    <ul class="ltn__category-submenu-children">
                                                        <li><a href="{{ route('home.shop') }}">PCR chemicals</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Electrophoretic chemicals</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Diagnostic biological products</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Flow-forming chemicals</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="#">Device</a>
                                            <ul class="ltn__category-submenu">
                                                <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="#">Device</a>
                                                    <ul class="ltn__category-submenu-children">
                                                        <li><a href="{{ route('home.shop') }}">PCR machine</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Mobile phones</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Extraction machine</a></li>
                                                        <li><a href="{{ route('home.shop') }}">spot check machine</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Other equipment</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="#">Utility package</a>
                                            <ul class="ltn__category-submenu">
                                                <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="#">Utility package</a>
                                                    <ul class="ltn__category-submenu-children">
                                                        <li><a href="{{ route('home.shop') }}">Practice combos</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="#">Services</a>
                                            <ul class="ltn__category-submenu">
                                                <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="#">Services</a>
                                                    <ul class="ltn__category-submenu-children">
                                                        <li><a href="{{ route('home.shop') }}">Gene synthesis</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Other services</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="ltn__category-menu-item ltn__category-menu-drop">
                                            <a href="#">Diagnostic kit</a>
                                            <ul class="ltn__category-submenu">
                                                <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="#">Diagnostic kit</a>
                                                    <ul class="ltn__category-submenu-children">
                                                        <li><a href="{{ route('home.shop') }}">Shrimp disease diagnosis kit</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Pangasius disease diagnosis kit</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Tilapia disease diagnosis kit</a></li>
                                                        <li><a href="{{ route('home.shop') }}">GMO detection kit</a></li>
                                                        <li><a href="{{ route('home.shop') }}">Kit detects animal DNA</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- Single menu end -->
                                    </ul>
                                </div>
                            </div>
                            <!-- END CATEGORY-MENU-LIST -->
                        </div>
                        <div class="col-lg-7">
                            <div class="col--- header-menu-column justify-content-center---">
                                <div class="header-menu header-menu-2 text-start">
                                    <nav>
                                        <div class="ltn__main-menu">
                                            <ul>
                                                <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{ route('home.index') }}">Home</a></li>
                                                <li class="{{ Request::path() == 'about' ? 'active' : '' }}"><a href="{{ route('home.about') }}">About</a></li>
                                                <li class="{{ Request::path() == 'shop' ? 'active' : '' }}"><a href="{{ route('home.shop') }}">Shop</a></li>
                                                <li class="menu-icon {{ Request::path() == 'posts' ? 'active' : '' }}"><a href="#">News</a>
                                                    <ul>
                                                        <li><a href="{{ route('home.posts') }}">News</a></li>
                                                        <li><a href="{{ route('home.posts') }}">Recruitment</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-icon {{ Request::path() == 'post' ? 'active' : '' }}"><a href="#">Policies</a>
                                                    <ul>
                                                        <li><a href="{{ route('home.post') }}">Sales policy</a></li>
                                                        <li><a href="{{ route('home.post') }}">Delivery & return policy</a>
                                                        </li>
                                                        <li><a href="{{ route('home.post') }}">Payment Guide</a></li>
                                                    </ul>
                                                </li>
                                                <li class="{{ Request::path() == 'contact' ? 'active' : '' }}"><a href="{{ route('home.contact') }}">Contact</a></li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-2 align-self-center d-none d-xl-block">
                            <div class="header-contact-info text-end">
                                <a class="font-weight-6 ltn__primary-color" href="tel:+84931035935"><span class="ltn__secondary-color"><i class="icon-call font-weight-7"></i></span> +84
                                    931035935</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-bottom-area end -->
        </header>
        <!-- HEADER AREA END -->

        <!-- Utilize Cart Menu Start -->
        <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
            <div class="ltn__utilize-menu-inner ltn__scrollbar">
                <div class="ltn__utilize-menu-head">
                    <span class="ltn__utilize-menu-title">Cart</span>
                    <button class="ltn__utilize-close">×</button>
                </div>
                <div class="mini-cart-product-area ltn__scrollbar">
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Antiseptic Spray</a></h6>
                            <span class="mini-cart-quantity">1 x 190.000<sup>đ</sup></span>
                        </div>
                    </div>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="{{ asset('img/product/product-demo-8.jpg') }}" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Digital Stethoscope</a></h6>
                            <span class="mini-cart-quantity">1 x 190.000<sup>đ</sup></span>
                        </div>
                    </div>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="{{ asset('img/product/product-demo-7.jpg') }}" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Cosmetic Containers</a></h6>
                            <span class="mini-cart-quantity">1 x 190.000<sup>đ</sup></span>
                        </div>
                    </div>
                    <div class="mini-cart-item clearfix">
                        <div class="mini-cart-img">
                            <a href="#"><img src="{{ asset('img/product/product-demo-2.jpg') }}" alt="Image"></a>
                            <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                        </div>
                        <div class="mini-cart-info">
                            <h6><a href="#">Thermometer Gun</a></h6>
                            <span class="mini-cart-quantity">1 x 190.000<sup>đ</sup></span>
                        </div>
                    </div>
                </div>
                <div class="mini-cart-footer">
                    <div class="mini-cart-sub-total">
                        <h5>Subtotal: <span>2.190.000<sup>đ</sup></span></h5>
                    </div>
                    <div class="btn-wrapper">
                        <a href="{{ route('home.cart') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                        <a href="{{ route('home.cart') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                    </div>
                    <p>Free Shipping on All Orders Over $100!</p>
                </div>

            </div>
        </div>
        <!-- Utilize Cart Menu End -->

        <!-- Utilize Mobile Menu Start -->
        <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
            <div class="ltn__utilize-menu-inner ltn__scrollbar">
                <div class="ltn__utilize-menu-head">
                    <div class="site-logo">
                        <a href="{{ route('home.index') }}"><img src="img/logo.svg" alt="Logo"></a>
                    </div>
                    <button class="ltn__utilize-close">×</button>
                </div>
                <div class="ltn__utilize-menu-search-form">
                    <form action="#">
                        <input type="text" placeholder="Search...">
                        <button><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="ltn__utilize-menu">
                    <ul>
                        <li class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{ route('home.index') }}">Home</a></li>
                        <li class="{{ Request::path() == 'about' ? 'active' : '' }}"><a href="{{ route('home.about') }}">About</a></li>
                        <li class="{{ Request::path() == 'shop' ? 'active' : '' }}"><a href="{{ route('home.shop') }}">Shop</a> </li>
                        <li class="{{ Request::path() == 'posts' ? 'active' : '' }}"><a href="#">News</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('home.posts') }}">News</a></li>
                                <li><a href="{{ route('home.posts') }}">Recruitment</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Policies</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('home.post') }}">Sales policy</a></li>
                                <li><a href="{{ route('home.post') }}">Delivery & return policy</a></li>
                                <li><a href="{{ route('home.post') }}">Payment Guide</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::path() == '/' ? 'contact' : '' }}"><a href="{{ route('home.contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                    <ul>
                        <li>
                            <a href="#" title="My Account">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                My Account
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home.cart') }}" title="Shoping Cart">
                                <span class="utilize-btn-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                    <sup>5</sup>
                                </span>
                                Shoping Cart
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
                                        <img src="{{ asset('img/logo.svg') }}" alt="Logo">
                                    </div>
                                </div>
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="icon-placeholder"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p>Address: K1.15-16, Vo Nguyen Giap, Phu Thu ward, Cai Rang district,
                                                    City. Can Tho. Viet Nam</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="bi bi-headset"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p><a href="tel:02926515678">Customer service: 02926515678</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="icon-call"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p><a href="tel:+02926533888">Accounting: 02926533888</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="icon-mail"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p><a href="mailto:cskh@phusagenomics.com">Email:
                                                        cskh@phusagenomics.com</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="bi bi-credit-card-2-front"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p>Business code: 1801727039 Issued on July 8, 2022 at the City
                                                    Department of Planning and Investment. Can Tho. Viet Nam</p>
                                            </div>
                                        </li>
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
                                <h4 class="footer-title">Main category</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="{{ route('home.index') }}">Home</a></li>
                                        <li><a href="{{ route('home.about') }}">About</a></li>
                                        <li><a href="{{ route('home.shop') }}">Shop</a></li>
                                        <li><a href="{{ route('home.posts') }}">News</a></li>
                                        <li><a href="{{ route('home.contact') }}">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">Policies</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="{{ route('home.post') }}">Shopping guide</a></li>
                                        <li><a href="{{ route('home.post') }}">Sales policy</a></li>
                                        <li><a href="{{ route('home.post') }}">Delivery &amp; return policy</a></li>
                                        <li><a href="{{ route('home.post') }}">Payment Guide</a></li>
                                        <li><a href="{{ route('home.posts') }}">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">Product Categories</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="{{ route('home.shop') }}">Oligo/Primer </a></li>
                                        <li><a href="{{ route('home.shop') }}">Biology Products</a></li>
                                        <li><a href="{{ route('home.shop') }}">Device</a></li>
                                        <li><a href="{{ route('home.shop') }}">Utility package</a></li>
                                        <li><a href="{{ route('home.shop') }}">Services</a></li>
                                        <li><a href="{{ route('home.shop') }}">Diagnostic kit</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                            <div class="footer-widget footer-newsletter-widget">
                                <h4 class="footer-title">Newsletter</h4>
                                <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                                <div class="footer-newsletter">
                                    <form action="#">
                                        <input type="email" name="email" placeholder="Email*">
                                        <div class="btn-wrapper">
                                            <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <h5 class="mt-30">We Accept</h5>
                                <img src="img/icons/payment-4.png" alt="Payment Image">
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
                                <p>All Rights Reserved @ PHUSA Genomics <span class="current-year"></span></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 align-self-center">
                            <div class="ltn__copyright-menu text-end">
                                <ul>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="#">My account</a></li>
                                    <li><a href="#">Order tracking</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER AREA END -->

        <!-- MODAL AREA START (Quick View Modal) -->
        <div class="ltn__modal-area ltn__quick-view-modal-area">
            <div class="modal fade" id="quick_view_modal" tabindex="-1">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <!-- <i class="fas fa-times"></i> -->
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="modal-product-img">
                                                <img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="#">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="modal-product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                                    </ul>
                                                </div>
                                                <h3>Digital Stethoscope</h3>
                                                <div class="product-price">
                                                    <span>350,000<sup>đ</sup></span>
                                                    <!-- <del>$165.00</del> -->
                                                </div>
                                                <div class="modal-product-meta ltn__product-details-menu-1">
                                                    <ul>
                                                        <li>
                                                            <strong>Categories:</strong>
                                                            <span>
                                                                <a href="#">Parts</a>
                                                                <a href="#">Car</a>
                                                                <a href="#">Seat</a>
                                                                <a href="#">Cover</a>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ltn__product-details-menu-2">
                                                    <ul>
                                                        <li>
                                                            <div class="cart-plus-minus">
                                                                <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                                <i class="fas fa-shopping-cart"></i>
                                                                <span>ADD TO CART</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="ltn__product-details-menu-3">
                                                    <ul>
                                                        <li>
                                                            <a href="#" class="" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i>
                                                                <span>Add to Wishlist</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                                <i class="fas fa-exchange-alt"></i>
                                                                <span>Compare</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <hr>
                                                <div class="ltn__social-media">
                                                    <ul>
                                                        <li>Share:</li>
                                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

        <!-- MODAL AREA START (Add To Cart Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-product-img">
                                                <img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="#">
                                            </div>
                                            <div class="modal-product-info">
                                                <h5><a href="{{ route('home.product') }}">Digital Stethoscope</a></h5>
                                                <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully
                                                    added to your Cart</p>
                                                <div class="btn-wrapper">
                                                    <a href="{{ route('home.cart') }}" class="theme-btn-1 btn btn-effect-1">View
                                                        Cart</a>
                                                    <a href="#" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                                </div>
                                            </div>
                                            <!-- additional-info -->
                                            <div class="additional-info d-none">
                                                <p>We want to give you <b>10% discount</b> for your first order, <br>
                                                    Use discount code at checkout</p>
                                                <div class="payment-method">
                                                    <img src="{{ asset('img/icons/payment.png') }}" alt="#">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

        <!-- MODAL AREA START (Wishlist Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-product-img">
                                                <img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="#">
                                            </div>
                                            <div class="modal-product-info">
                                                <h5><a href="{{ route('home.product') }}">Digital Stethoscope</a></h5>
                                                <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully
                                                    added to your Wishlist</p>
                                                <div class="btn-wrapper">
                                                    <a href="#" class="theme-btn-1 btn btn-effect-1">View
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                            <!-- additional-info -->
                                            <div class="additional-info d-none">
                                                <p>We want to give you <b>10% discount</b> for your first order, <br>
                                                    Use discount code at checkout</p>
                                                <div class="payment-method">
                                                    <img src="{{ asset('img/icons/payment.png') }}" alt="#">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

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
    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>