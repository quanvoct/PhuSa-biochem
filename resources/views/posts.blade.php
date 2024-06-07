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
                                <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>{{ $pageName }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-lg-2 mb-120">
                    @foreach ($categories as $category)
                    @if(count($category->posts))
                        <h1 class="section-title">{!! __($category->name) !!}</h1>
                        <hr>
                        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                            @foreach ($category->posts->take(8) as $post)
                            <!-- Blog Item -->
                            <div class="col-lg-12">
                                <div class="ltn__blog-item ltn__blog-item-3">
                                    <div class="ltn__blog-img">
                                        <a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}"><img src="{{ $post->getImageUrlAttribute() }}" alt="#"></a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <h3 class="ltn__blog-title"><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></h3>
                                        <p>{!! $post->excerpt ? Illuminate\Support\Str::limit($post->excerpt, 60) : Illuminate\Support\Str::limit($post->content, 60) !!}</p>
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
                        </div>
                        @endif
                    @endforeach
                </div>
                {{-- <div class="col-lg-3">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar sticky-top">
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{ __('Search Objects') }}</h4>
                            <form action="#">
                                <input name="search" type="text" placeholder="Search your keyword...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{ __('Posts categories') }}</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('home.index', ['page' => 'posts', 'category' => $category]) }}">{!! __($category->name) !!}<span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->
@endsection
