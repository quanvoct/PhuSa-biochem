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
                            <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> {{ __('Home') }}</a></li>
                            <li>{{ $pageName }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- BLOG AREA START -->
<div class="ltn__blog-area ltn__blog-item-3-normal mb-100">
    <div class="container">
        <div class="row">
            @if(count($category->posts))
            <!-- Blog Item -->
            @foreach($category->posts as $post)
            <div class="col-lg-4 col-sm-6 col-12">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}"><img src="{{ $post->getImageUrlAttribute() }}" alt="#"></a>
                    </div>
                    <div class="ltn__blog-brief">
                        <!-- <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                </li>
                                <li class="ltn__blog-tags">
                                    <a href="#"><i class="fas fa-tags"></i>Services</a>
                                </li>
                            </ul>
                        </div> -->
                        <h3 class="ltn__blog-title"><a href="{{ route('home.index', ['page' => 'posts', 'category' => $post->category->code, 'post' => $post->code]) }}">{!! $post->title !!}</a></h3>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</li>
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
            @else
            <div class="col-12">
                <p> {{ __('There are no posts yet') }}</p>
            </div>
            @endif
        </div>
        <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            <ul>
                                <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
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