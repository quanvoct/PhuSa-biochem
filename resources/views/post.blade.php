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

<!-- PAGE DETAILS AREA START (blog-details) -->
<div class="ltn__page-details-area ltn__blog-details-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ltn__blog-details-wrap">
                    <div class="ltn__page-details-inner ltn__blog-details-inner">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-category">
                                    <a href="#">{{ $pageName }}</a>
                                </li>
                            </ul>
                        </div>
                        <h2 class="ltn__blog-title">{{ $pageName }}
                        </h2>
                        <div class="ltn__blog-meta">
                            <ul>
                                <!-- <li class="ltn__blog-author">
                                    <a href="#"><img src="{{ asset('img/blog/author.jpg') }}" alt="#">By: Admin</a>
                                </li> -->
                                <li class="ltn__blog-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}
                                </li>
                            </ul>
                        </div>

                        {!! $post->content !!}
                    </div>
                    <!-- blog-tags-social-media -->
                    <div class="ltn__blog-tags-social-media mt-80 row">
                        <!-- <div class="ltn__tagcloud-widget col-lg-8">
                            <h4>Releted Tags</h4>
                            <ul>
                                <li>
                                    <a href="#">Popular</a>
                                </li>
                                <li>
                                    <a href="#">Business</a>
                                </li>
                                <li>
                                    <a href="#">ux</a>
                                </li>
                            </ul>
                        </div> -->
                        <div class="ltn__social-media col-lg-4">
                            <h4>{{ __('Social Share') }}</h4>
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>

                                <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- related-post -->
                    @php
                    $relatedPosts = $post->category->posts->where('id', '!=', $post->id);
                    @endphp
                    @if($relatedPosts->isNotEmpty())
                    <div class="related-post-area mb-50">
                        <h4 class="title-2">{{ __('Related Post') }}</h4>
                        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                            @foreach($relatedPosts as $relate)
                            <!-- Blog Item -->
                            <div class="col-lg-12">
                                <div class="ltn__blog-item ltn__blog-item-3">
                                    <div class="ltn__blog-img">
                                        <a href="{{ route('home.index', ['page' => 'posts', 'category' => $relate->category->code, 'post' => $relate->code]) }}"><img src="{{ $relate->imageUrl() }}" alt="#"></a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <h3 class="ltn__blog-title"><a href="{{ route('home.index', ['page' => 'posts', 'category' => $relate->category->code, 'post' => $relate->code]) }}">{!! $relate->title !!}</a></h3>
                                        <p>{!! ($relate->excerpt) ? Illuminate\Support\Str::limit($relate->excerpt, 60) : Illuminate\Support\Str::limit($relate->content, 60) !!}</p>
                                        <div class="ltn__blog-meta-btn">
                                            <div class="ltn__blog-meta">
                                                <ul>
                                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($relate->created_at)->format('d/m/Y') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ltn__blog-btn">
                                                <a href="{{ route('home.index', ['page' => 'posts', 'category' => $relate->category->code, 'post' => $relate->code]) }}">{{ __('Read more') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGE DETAILS AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="{{ asset('img/1.jpg') }}--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>{{ __('Products, services and equipment ') }}<br> {{ __('applied in the field of Molecular Biology') }}</h1>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn btn-effect-3 btn-white" href="{{ route('shop.index') }}">{{ __('Explore Products') }} <i class="icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection