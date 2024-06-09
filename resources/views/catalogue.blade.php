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

    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-120">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="showing-product-number text-right">
                                    <span> <span>{{ __('Showing :first - :last of :total products', ['first' => $products->firstItem(), 'last' => $products->lastItem(), 'total' => $products->total()]) }}</span></span>
                                </div>
                            </li>
                            <li>
                                <div class="short-by text-center">
                                    <select class="nice-select">
                                        <option>{{ __('Default Sorting') }}</option>
                                        <option>{{ __('Sort by popularity') }}</option>
                                        <option>{{ __('Sort by new arrivals') }}</option>
                                        <option>{{ __('Sort by price: low to high') }}</option>
                                        <option>{{ __('Sort by price: high to low') }}</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    @if (Auth::check())
                                        <!-- ltn__product-item -->
                                        <div class="col-md-4 col-sm-6 col-6">
                                            <div class="ltn__product-item ltn__product-item-2 text-left">
                                                <div class="product-img">
                                                    <a href="{{ route('admin.product', ['key' => 'new']) }}">
                                                        <img src="{{ asset('admin/images/placeholder.webp') }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h2 class="product-title">
                                                        <a href="{{ route('admin.product', ['key' => 'new']) }}">
                                                            Thêm sản phẩm mới
                                                        </a>
                                                    </h2>
                                                    <div class="product-price">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ltn__product-item -->
                                    @endif
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                            <!-- ltn__product-item -->
                                            <div class="col-md-4 col-sm-6 col-6">
                                                <div class="ltn__product-item ltn__product-item-2 text-left">
                                                    <div class="product-img">
                                                        <a href="{{ route('shop.index', ['catalogue' => $catalogue->slug, 'product' => $product->slug]) }}">
                                                            <img src="{{ $product->getImageUrlAttribute() }}" alt="img">
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h2 class="product-title">
                                                            <a href="{{ route('shop.index', ['catalogue' => $catalogue->slug, 'product' => $product->slug]) }}">
                                                                {!! $product->name !!}
                                                            </a>
                                                        </h2>
                                                        <div class="product-price">
                                                            <span>{!! $product->displayPrice() !!}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ltn__product-item -->
                                        @endforeach
                                    @else
                                        <p>{{ __('No products in this catalog.') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                            <!-- ltn__product-item -->
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3">
                                                    <div class="product-img">
                                                        <a href="{{ route('shop.index', ['catalogue' => $catalogue->slug, 'product' => $product->slug]) }}"><img src="{{ $product->getImageUrlAttribute() }}" alt="img"></a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h2 class="product-title"><a href="{{ route('shop.index', ['catalogue' => $catalogue->slug, 'product' => $product->slug]) }}">{!! $product->name !!}</a></h2>
                                                        <div class="product-price">
                                                            <span>{!! $product->displayPrice() !!}</span>
                                                        </div>
                                                        <div class="product-brief">
                                                            <p>{{ $product->excerpt ? Illuminate\Support\Str::limit($product->excerpt, 120) : Illuminate\Support\Str::limit($product->description, 120) }}</p>
                                                        </div>
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a data-bs-toggle="modal" data-bs-target="#quick_view_modal" href="#" title="Quick View">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a data-bs-toggle="modal" data-bs-target="#add_to_cart_modal" href="#" title="Add to Cart">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal" href="#" title="Wishlist">
                                                                        <i class="far fa-heart"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>{{ __('No products in this catalog.') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hiển thị liên kết phân trang -->
                    @if ($products->count() > 0 && $products->lastPage() > 1)
                        <div class="ltn__pagination-area text-center">
                            <div class="ltn__pagination">
                                <ul>
                                    <!-- Trang trước -->
                                    @if ($products->onFirstPage())
                                        <li class="disabled"><span><i class="fas fa-angle-double-left"></i></span></li>
                                    @else
                                        <li><a href="{{ $products->previousPageUrl() }}"><i class="fas fa-angle-double-left"></i></a></li>
                                    @endif

                                    @php
                                        $totalPages = $products->lastPage();
                                        $currentPage = $products->currentPage();
                                        $startPage = max(1, $currentPage - 2);
                                        $endPage = min($totalPages, $currentPage + 2);
                                    @endphp

                                    <!-- Hiển thị trang đầu tiên và dấu "..." nếu cần -->
                                    @if ($startPage > 1)
                                        <li><a href="{{ $products->url(1) }}">1</a></li>
                                        @if ($startPage > 2)
                                            <li class="disabled"><span>...</span></li>
                                        @endif
                                    @endif

                                    <!-- Hiển thị các trang giữa -->
                                    @for ($page = $startPage; $page <= $endPage; $page++)
                                        @if ($page == $currentPage)
                                            <li class="active"><a href="{{ $products->url($page) }}">{{ $page }}</a></li>
                                        @else
                                            <li><a href="{{ $products->url($page) }}">{{ $page }}</a></li>
                                        @endif
                                    @endfor

                                    <!-- Hiển thị dấu "..." và trang cuối cùng nếu cần -->
                                    @if ($endPage < $totalPages)
                                        @if ($endPage < $totalPages - 1)
                                            <li class="disabled"><span>...</span></li>
                                        @endif
                                        <li><a href="{{ $products->url($totalPages) }}">{{ $totalPages }}</a></li>
                                    @endif

                                    <!-- Trang tiếp theo -->
                                    @if ($products->hasMorePages())
                                        <li><a href="{{ $products->nextPageUrl() }}"><i class="fas fa-angle-double-right"></i></a></li>
                                    @else
                                        <li class="disabled"><span><i class="fas fa-angle-double-right"></i></span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar sticky-top">
                        <!-- Search Widget -->
                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{ __('Search Objects') }}</h4>
                            <form action="#">
                                <input name="search" type="text" placeholder="{{ __('Search your keyword...') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">{{ __('Product Categories') }}</h4>
                            <ul>
                                <li><a href="{{ route('shop.index') }}">{{ __('All Products') }}<span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                @foreach (session('catalogues')->whereNull('parent_id') as $catalogue)
                                    <li><a href="{{ route('shop.index', ['catalogue' => $catalogue->slug]) }}">{!! __($catalogue->name) !!}<span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->

@endsection
