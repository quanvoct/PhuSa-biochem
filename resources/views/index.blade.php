@extends('layouts.app')
@section('title')
{{ $pageName }}
@endsection
@section('content')
<!-- SLIDER AREA START (slider-3) -->
<div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="ltn__slide-active-2 slick-slide-arrow-1 slick-slide-dots-1 mb-30">
                    <!-- ltn__slide-item -->
                    <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bs-bg="{{ asset('img/banner/banner-demo.jpg') }}">
                        <div class="ltn__slide-item-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                        <div class="slide-item-info">
                                            <div class="slide-item-info-inner ltn__slide-animation">
                                                <!-- <h6 class="slide-sub-title ltn__secondary-color animated">Up To 50% Off Today Only!</h6>
                                                    <h1 class="slide-title  animated">Gold Standard <br>Pre-Workout</h1>
                                                    <div class="slide-brief animated d-none">
                                                        <p>Predictive analytics is drastically changing the real estate industry. In the past, providing data for quick</p>
                                                    </div>
                                                    <h5 class="color-orange  animated">Starting at &16.99</h5> -->
                                                <div class="btn-wrapper  animated">
                                                    <a href="{{ route('shop.index') }}" class="theme-btn-1 btn btn-effect-1">{{ __('Shop now') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
                                        <div class="slide-item-img">
                                            <!-- <a href="{{ route('shop.index') }}"><img src="{{ asset('img/product/1.png') }}" alt="Image"></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__slide-item -->
                    <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bs-bg="{{ asset('img/banner/banner-demo-2.jpg') }}">
                        <div class="ltn__slide-item-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                        <div class="slide-item-info">
                                            <div class="slide-item-info-inner ltn__slide-animation">
                                                <!-- <h4 class="slide-sub-title ltn__secondary-color animated text-uppercase">Welcome to our shop</h4>
                                                    <h1 class="slide-title  animated">TGold Standard <br>Pre-Workout</h1>
                                                    <div class="slide-brief animated d-none">
                                                        <p>Predictive analytics is drastically changing the real estate industry. In the past, providing data for quick</p>
                                                    </div> -->
                                                <div class="btn-wrapper  animated">
                                                    <a href="{{ route('shop.index') }}" class="theme-btn-1 btn btn-effect-1 text-uppercase">Shop
                                                        now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
                                        <div class="slide-item-img">
                                            <!-- <a href="{{ route('shop.index') }}"><img src="{{ asset('img/slider/62.jpg') }}" alt="Image"></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="{{ route('shop.index') }}"><img src="{{ asset('img/banner/banner_Cong-nghe.jpg') }}" alt="Banner Image"></a>
                    </div>
                </div>
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="{{ route('shop.index') }}"><img src="{{ asset('img/banner/img-demo-2.jpg') }}" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SLIDER AREA END -->

<!-- FEATURE AREA START ( Feature - 3) -->
<div class="ltn__feature-area section-bg-1 mt-90--- pt-30 pb-30 mt--65---">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="">
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="{{ asset('img/icons/svg/thiet-bi-chinh-hang.svg') }}" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Genuine equipment</h4>
                            <p>From Phu Sa BIOCHEM and leading equipment manufacturers.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="">
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="{{ asset('img/icons/svg/san-pham-chat-luong.svg') }}" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Quality products</h4>
                            <p>Producing the right quantity and quality, meeting requirements.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="">
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="{{ asset('img/icons/svg/giao-hang-dung-tien-do.svg') }}" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Fast production</h4>
                            <p>Key products are manufactured by the company according to approved technological processes
                                invent.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="">
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="{{ asset('img/icons/svg/ho-tro-chuyen-nghiep.svg') }}" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Professional support</h4>
                            <p>Product consultation and professional, quick support.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->
<!-- CATEGORY AREA START -->
<div class="ltn__category-area section-bg-1-- pt-30 pb-50">
    <div class="container">
        <div class="row ltn__category-slider-active-six slick-arrow-1 border-bottom">
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="bi bi-grid"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">{{ __('All Products') }}</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="bi bi-align-bottom"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">Oligo/Primer</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="fas fa-bong"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">Biology Products</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="fas fa-microscope"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">Device</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="fas fa-box-tissue"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">Utility package</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="bi bi-noise-reduction"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">Services</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="ltn__category-item ltn__category-item-6 text-center">
                    <div class="ltn__category-item-img">
                        <a href="{{ route('shop.index') }}">
                            <i class="bi bi-screwdriver"></i>
                        </a>
                    </div>
                    <div class="ltn__category-item-name">
                        <h6><a href="{{ route('shop.index') }}">Diagnostic kit</a></h6>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="{{ route('shop.index') }}">
                                <i class="fas fa-syringe"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="{{ route('shop.index') }}">All Products</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="{{ route('shop.index') }}">
                                <i class="fas fa-stethoscope"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="{{ route('shop.index') }}">Germs Pads</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="{{ route('shop.index') }}">
                                <i class="fas fa-hand-holding-medical"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="{{ route('shop.index') }}">Accessories</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="{{ route('shop.index') }}">
                                <i class="fas fa-procedures"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="{{ route('shop.index') }}">Medicine Cap</a></h6>
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
</div>
<!-- CATEGORY AREA END -->

<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter  no-product-ratting pt-20--- pt-65  pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">{{ __('Featured Products') }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="{{ route('shop.index') }}"><img src="{{ asset('img/featured-products-banner1.jpg') }}" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="{{ route('shop.index') }}"><img src="{{ asset('img/featured-products-banner2.jpg') }}" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                    @if($uniqueProducts->isEmpty())
                    <p>{{ __('Products are being updated') }}</p>
                    @else
                    @foreach($uniqueProducts->where('status', 2)->take(6) as $product)
                    <!-- ltn__product-item -->
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-2 text-left">
                            <div class="product-img">
                                <a href="{{ route('shop.index', ['catalogue' => $product->catalogues->first()->slug, 'product' => $product->slug]) }}">
                                    <img src="{{ $product->getImageUrlAttribute() }}" alt="img">
                                </a>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('shop.index', ['catalogue' => $product->catalogues->first()->slug, 'product' => $product->slug]) }}">
                                        {!! $product->name !!}
                                    </a>
                                </h2>
                                <div class="product-price">
                                    <span>{!! $product->displayPrice() !!}</span>
                                    <!-- <del>$46.00</del> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT AREA END -->

<!-- COUNTDOWN AREA START -->
<div class="ltn__call-to-action-area section-bg-1 bg-image pt-120 pb-120" data-bs-bg="{{ asset('img/bg/31.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="call-to-action-inner text-color-white--- text-center---">
                    <div class="section-title-area ltn__section-title-2--- text-center---">
                        <h6 class="ltn__secondary-color">{{ __('Todays Hot Offer') }}</h6>
                        <h1 class="section-title">{{ __('Monthly promotional campaign') }}</h1>
                        <p>Don't miss out on the opportunity to receive promotions today from PhuSa Biochem.</p>
                    </div>
                    <div class="ltn__countdown ltn__countdown-3 bg-white--" data-countdown="2024/08/31"></div>
                    <div class="btn-wrapper animated">
                        <a href="{{ route('home.contact') }}" class="theme-btn-1 btn btn-effect-1 text-uppercase">{{ __('Book Now') }}</a>
                        <a href="{{ route('shop.index') }}" class="ltn__secondary-color text-decoration-underline">{{ __('Deal of The
                            Day') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <!-- <img src="{{ asset('img/banner/15.png') }}" alt="#"> -->
            </div>
        </div>
    </div>
</div>
<!-- COUNTDOWN AREA END -->


<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">{{ __('Best Selling Item') }}</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
            <!-- ltn__product-item -->
            @if($uniqueProducts->isEmpty())
            <p>{{ __('Products are being updated') }}</p>
            @else
            @foreach($uniqueProducts->take(8) as $product)
            <!-- ltn__product-item -->
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="ltn__product-item ltn__product-item-2 text-left">
                    <div class="product-img">
                        <a href="{{ route('shop.index', ['catalogue' => $product->catalogues->first()->slug, 'product' => $product->slug]) }}">
                            <img src="{{ $product->getImageUrlAttribute() }}" alt="img">
                        </a>
                    </div>
                    <div class="product-info">
                        <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h2 class="product-title">
                            <a href="{{ route('shop.index', ['catalogue' => $product->catalogues->first()->slug, 'product' => $product->slug]) }}">
                                {!! $product->name !!}
                            </a>
                        </h2>
                        <div class="product-price">
                            <span>{!! $product->displayPrice() !!}</span>
                            <!-- <del>$46.00</del> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__product-item -->
            @endforeach
            @endif
        </div>
    </div>
</div>
<!-- PRODUCT AREA END -->

<!-- ABOUT US AREA START -->
<div class="ltn__about-us-area bg-image pt-115 pb-110" data-bs-bg="{{ asset('img/bg/26.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    <!-- <img src="{{ asset('img/others/7.png') }}" alt="About Us Image"> -->
                </div>
            </div>
            <div class="col-lg-7 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2--- mb-20">
                        <h6 class="section-subtitle section-subtitle-2--- ltn__secondary-color">About Us</h6>
                        <h1 class="section-title">{{ __('Phu Sa Genomics Joint Stock Company') }}</h1>
                        <p>{{ __('The predecessor of PHU SA Genomics comes from PHU SA Biochem. After more than 14
                            years of establishment, with the enthusiasm of a team of professional and creative
                            leaders, along with accumulated experience, PHU SA is honored to be a trusted
                            partner of more than 300 agencies/units and experienced customers. long across the
                            country.') }}</p>
                    </div>
                    <ul class="ltn__list-item-half clearfix">
                        <li>
                            <i class="flaticon-home-2"></i>
                            {{ __('Genuine equipment') }}
                        </li>
                        <li>
                            <i class="flaticon-mountain"></i>
                            {{ __('Quality products') }}
                        </li>
                        <li>
                            <i class="flaticon-heart"></i>
                            {{ __('Fast production') }}
                        </li>
                        <li>
                            <i class="flaticon-secure"></i>
                            {{ __('Professional support') }}
                        </li>
                    </ul>
                    <div class="btn-wrapper animated">
                        <a href="{{ route('home.index', ['page' => 'about']) }}" class="ltn__secondary-color text-uppercase text-decoration-underline">{{ __('Read more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->

<!-- BLOG AREA START (blog-3) -->
<div class="ltn__blog-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">{{ __('News & Blogs') }}
                    </h6>
                    <h1 class="section-title">{{ __('Leatest Blogs') }}</h1>
                </div>
            </div>
        </div>
        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
            @foreach($categories as $category)
            @foreach($category->posts as $post)
            <!-- Blog Item -->
            <div class="col-lg-12">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}"><img src="{{ $post->imageUrl() }}" alt="#"></a>
                    </div>
                    <div class="ltn__blog-brief">
                        <h3 class="ltn__blog-title"><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></h3>
                        <p>{!! ($post->excerpt) ? Illuminate\Support\Str::limit($post->excerpt, 60) : Illuminate\Support\Str::limit($post->content, 60) !!}</p>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="ltn__blog-btn">
                                <a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{{ __('Read more') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</div>
<!-- BLOG AREA END -->
<!-- Partners -->
<div class="ltn__category-area section-bg-1-- pt-30 pb-50">
    <div class="container">
        <div class="row ltn__category-slider-active-six slick-arrow-1">
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_clrri.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_ctu.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_ctump.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_eurogentec.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_khtn.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_millipore_sigma.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_t4oligo.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_utah.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_vienhanlam.png') }}" alt="partner">
            </div>
            <div class="col-12">
                <img class="partner" src="{{ asset('img/partners/logo_yale.png') }}" alt="partner">
            </div>
        </div>
    </div>
</div>
<!-- Partners END -->
@endsection