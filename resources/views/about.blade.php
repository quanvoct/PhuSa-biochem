@extends('layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="{{ asset('img/bg/14.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ $pageName }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span>{{ __('Home') }}</a></li>
                                <li>{{ $pageName }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- ABOUT US AREA START -->
    <div class="ltn__about-us-area pt-25--- pb-120 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-img-wrap about-img-left">
                        <img src="{{ asset('img/default.jpg') }}" alt="About Us Image">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-us-info-wrap">
                        <div class="section-title-area ltn__section-title-2--- mb-30">
                            <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">{{ __('About Us') }}</h6>
                            <h1 class="section-title">{{ __('Phu Sa Biochem Joint Stock Company') }}</h1>
                            <p>{{ __('With the orientation of diversifying products and focusing on quality, step by step improvement we will bring to our customers and partners high quality products and services at affordable prices and fast delivery. in the Vietnamese market and Southeast Asian countries, meeting the needs of customers in the field of Biology - Chemistry.') }}
                            </p>
                            <p>{{ __('PHU SA is a unit operating in three main areas including: Chemistry, Biology and Automation to serve molecular biology research. We are always proud to be the leading company in providing technology platforms and products used to synthesize oligonucleotides (primers) in Vietnam and around the world. The products, services and equipment applied in the field of Molecular Biology that we provide have been trusted by professionals, gradually replacing products imported from abroad.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ABOUT US AREA END -->

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
                                <h4>{{ __('Genuine equipment') }}</h4>
                                <p>{{ __('From Phu Sa BIOCHEM and leading equipment manufacturers.') }}</p>
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
                                <h4>{{ __('Quality products') }}</h4>
                                <p>{{ __('Producing the right quantity and quality, meeting requirements.') }}</p>
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
                                <h4>{{ __('Fast production') }}</h4>
                                <p>{{ __('Key products are manufactured by the company according to approved technological processes invent.') }}</p>
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
                                <h4>{{ __('Professional support') }}</h4>
                                <p>{{ __('Product consultation and professional, quick support.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->

    <!-- FEATURE AREA START ( Feature - 6) -->
    <div class="ltn__feature-area pt-90 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h1 class="section-title">{{ __('Core Values') }}</h1>
                        <p>{{ __('With the desire to evaluate the price and restructuring structure of the Company`s operations, aiming to better meet the needs of the market and customers in the new development period. The Company`s Board of Directors decided to establish Phu Sa Biochem Joint Stock Company (PHUSA Biochem). We have') }}:
                        </p>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter justify-content-center">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-1-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Exclusive production and distribution of Oligo/Primers') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100 active">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-2-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Biological chemicals') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-3-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Sequencing Services') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-4-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Gene Synthesis Service') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-5-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Laboratory equipment') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-6-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Diagnostic kit') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="ltn__feature-item ltn__feature-item-6 text-center h-100">
                        <div class="ltn__feature-icon">
                            <span><i class="bi bi-7-circle"></i></span>
                        </div>
                        <div class="ltn__feature-info">
                            <h4>{{ __('Other Biochem services') }}</h4>
                            <p>{{ __('Lorem ipsum dolor sit ame it, consectetur adipisicing elit, sed do eiusmod te mp or
                                                                                                                incididunt ut labore.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <p>{{ __('With the orientation of diversifying products and focusing on quality, step by step improvement we will bring to our customers and partners high quality products and services at affordable prices and fast delivery. in the Vietnamese market and Southeast Asian countries, meeting the needs of customers in the field of Biology - Chemistry.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->

    <!-- COUNTER UP AREA START -->
    <div class="ltn__counterup-area section-bg-1 bg-image bg-overlay-theme-black-80--- pt-115 pb-70" data-bs-bg="{{ asset('img/bg/30.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="{{ asset('img/icons/icon-img/2.png') }}" alt="#">  -->
                            <i class="flaticon-add-user-1"></i>
                        </div>
                        <h1><span class="counter">733</span><span class="counterUp-icon">+</span> </h1>
                        <h6>{{ __('Active Clients') }}</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="{{ asset('img/icons/icon-img/3.png') }}" alt="#">  -->
                            <i class="flaticon-dining-table-with-chairs"></i>
                        </div>
                        <h1><span class="counter">33</span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span> </h1>
                        <h6>{{ __('Cup Of Coffee') }}</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="{{ asset('img/icons/icon-img/3.png') }}" alt="#">  -->
                            <i class="flaticon-package"></i>
                        </div>
                        <h1><span class="counter">100</span><span class="counterUp-icon">+</span> </h1>
                        <h6>{{ __('Get Rewards') }}</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 align-self-center">
                    <div class="ltn__counterup-item text-center">
                        <div class="counter-icon">
                            <!-- <img src="{{ asset('img/icons/icon-img/3.png') }}" alt="#">  -->
                            <i class="flaticon-maps-and-location"></i>
                        </div>
                        <h1><span class="counter">21</span><span class="counterUp-icon">+</span> </h1>
                        <h6>{{ __('Country Cover') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COUNTER UP AREA END -->

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

    <!-- VIDEO AREA START -->
    <div class="ltn__video-popup-area ltn__video-popup-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__video-bg-img ltn__video-popup-height-600 bg-overlay-black-10-- bg-image" data-bs-bg="{{ asset('img/bg/15.jpg') }}">
                        <a class="ltn__video-icon-2 ltn__video-icon-2-border border-radius-no" data-rel="lightcase:myCollection" href="https://www.youtube.com/embed/LpoxhxWnuQ0?autoplay=1&showinfo=0">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- VIDEO AREA END -->

    <!-- TESTIMONIAL AREA START (testimonial-4) -->
    <div class="ltn__testimonial-area section-bg-1 pt-290 pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">{{ __('Clients Feedbacks') }}<span>.</span></h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__testimonial-slider-3-active slick-arrow-1 slick-arrow-1-inner">
                <div class="col-lg-12">
                    <div class="ltn__testimonial-item ltn__testimonial-item-4">
                        <div class="ltn__testimoni-img">
                            <img src="{{ asset('img/testimonial/6.jpg') }}" alt="#">
                        </div>
                        <div class="ltn__testimoni-info">
                            <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. </p>
                            <h4>Rosalina D. William</h4>
                            <h6>Founder</h6>
                        </div>
                        <div class="ltn__testimoni-bg-icon">
                            <i class="far fa-comments"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__testimonial-item ltn__testimonial-item-4">
                        <div class="ltn__testimoni-img">
                            <img src="{{ asset('img/testimonial/7.jpg') }}" alt="#">
                        </div>
                        <div class="ltn__testimoni-info">
                            <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. </p>
                            <h4>Rosalina D. William</h4>
                            <h6>Founder</h6>
                        </div>
                        <div class="ltn__testimoni-bg-icon">
                            <i class="far fa-comments"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__testimonial-item ltn__testimonial-item-4">
                        <div class="ltn__testimoni-img">
                            <img src="{{ asset('img/testimonial/1.jpg') }}" alt="#">
                        </div>
                        <div class="ltn__testimoni-info">
                            <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. </p>
                            <h4>Rosalina D. William</h4>
                            <h6>Founder</h6>
                        </div>
                        <div class="ltn__testimoni-bg-icon">
                            <i class="far fa-comments"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__testimonial-item ltn__testimonial-item-4">
                        <div class="ltn__testimoni-img">
                            <img src="{{ asset('img/testimonial/2.jpg') }}" alt="#">
                        </div>
                        <div class="ltn__testimoni-info">
                            <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. </p>
                            <h4>Rosalina D. William</h4>
                            <h6>Founder</h6>
                        </div>
                        <div class="ltn__testimoni-bg-icon">
                            <i class="far fa-comments"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ltn__testimonial-item ltn__testimonial-item-4">
                        <div class="ltn__testimoni-img">
                            <img src="{{ asset('img/testimonial/5.jpg') }}" alt="#">
                        </div>
                        <div class="ltn__testimoni-info">
                            <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. </p>
                            <h4>Rosalina D. William</h4>
                            <h6>Founder</h6>
                        </div>
                        <div class="ltn__testimoni-bg-icon">
                            <i class="far fa-comments"></i>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <!-- TESTIMONIAL AREA END -->
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
                @foreach ($categories as $category)
                    @foreach ($category->posts->take(8) as $post)
                        <!-- Blog Item -->
                        <div class="col-lg-12">
                            <div class="ltn__blog-item ltn__blog-item-3">
                                <div class="ltn__blog-img">
                                    <a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}"><img src="{{ $post->getImageUrlAttribute() }}" alt="#"></a>
                                </div>
                                <div class="ltn__blog-brief">
                                    <h3 class="ltn__blog-title"><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></h3>
                                    <p>{!! $post->excerpt ? Illuminate\Support\Str::limit(strip_tags($post->excerpt), 60) : Illuminate\Support\Str::limit(strip_tags($post->content), 60) !!}</p>
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

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="{{ asset('img/1.jpg') }}--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>{{ __('Products, services and equipment') }} <br> {{ __('applied in the field of Molecular Biology') }}</h1>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="{{ route('shop.index') }}">{{ __('Explore Products') }} <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->
@endsection
