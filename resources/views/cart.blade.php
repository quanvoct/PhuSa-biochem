@extends('layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
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

    <!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('response'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-xmark"></i>
                            {!! session('response') !!}
                            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                {{-- <thead>
                                    <th class="cart-product-remove" style="width:1%">Remove</th>
                                    <th class="cart-product-image" style="width:7%">Image</th>
                                    <th class="cart-product-info" style="width: 50%">Product</th>
                                    <th class="cart-product-price" style="width: 15%">Price</th>
                                    <th class="cart-product-quantity" style="width: 15%">Quantity</th>
                                    <th class="cart-product-subtotal" style="width: 5%">Subtotal</th>
                                </thead> --}}
                                @if (session('cart'))
                                    @if (session('cart')->count)
                                        @foreach (session('cart')->items as $item)
                                            <tr class="cart-item">
                                                <td class="cart-product-remove px-0">
                                                    <form action="{{ route('cart.remove') }}" method="post">
                                                        @csrf
                                                        <input name="variable_id" type="hidden" value="{{ $item->variable_id }}">
                                                        <button class="btn btn-close btn-link text-decoration-none px-4" type="submit"></button>
                                                    </form>
                                                </td>
                                                <td class="cart-product-image px-0">
                                                    <a href="{{ $item->variable->product->url }}"><img src="{{ $item->variable->product->imageUrl }}"
                                                            alt="{{ $item->variable->product->sku . ($item->variable->sub_sku != null ? $item->variable->sub_sku : '') }} - {{ $item->variable->product->name . ($item->variable->name != null ? ' - ' . $item->variable->name : '') }}"></a>
                                                </td>
                                                <td class="cart-product-info text-start w-50">
                                                    <h4 class="mb-0 p-0"><a href="{{ $item->variable->product->url }}">{{ $item->variable->product->sku . ' - ' . $item->variable->product->name }}</a></h4>
                                                    <p class="text-secondary mb-0 p-0">{{ ($item->variable->sub_sku != null ? $item->variable->sub_sku : '') . ($item->variable->name != null ? ' - ' . $item->variable->name : '') }}</p>
                                                </td>
                                                <td class="cart-product-price text-end px-3" style="width: 15% !important">{{ number_format($item->price) }}đ &nbsp;&nbsp;&times;</td>
                                                <td class="cart-product-quantity px-0">
                                                    <form action="{{ route('cart.update') }}" method="post">
                                                        @csrf
                                                        <input name="variable_id" type="hidden" value="{{ $item->variable_id }}">
                                                        <div class="cart-plus-minus">
                                                            <input class="cart-plus-minus-box" name="quantity" type="text" value="{{ $item->quantity }}">
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="cart-product-subtotal text-end" style="width: 15% !important">{{ number_format($item->quantity * $item->price) }}đ</td>
                                            </tr>
                                        @endforeach
                                        <tr class="cart-coupon-row">
                                            <td colspan="6">
                                                <div class="cart-coupon d-flex">
                                                    <input name="cart-coupon" type="text" placeholder="{{ __('Coupon code') }}">
                                                    <button class="btn theme-btn-2 btn-effect-2" type="submit">{{ __('Apply Coupon') }}</button>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn theme-btn-2 btn-effect-2-- btn-update-cart" type="button">{{ __('Update Cart') }}</button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6">{{ __('Cart empty') }}</td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </div>
                        @if (session('cart') && session('cart')->count)
                            <div class="shoping-cart-total mt-50">
                                <h4>{{ __('Cart Totals') }}</h4>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Cart Subtotal') }}
                                                <sup>
                                                    @if (session('cart'))
                                                        {{ number_format(session('cart')->count) }}
                                                    @endif
                                                </sup>
                                            </td>
                                            <td>
                                                @if (session('cart'))
                                                    {{ number_format(session('cart')->total) }}đ
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                        <td>{{ __('Shipping and Handing') }}</td>
                                        <td>750,000<sup>đ</sup></td>
                                    </tr> --}}
                                        {{-- <tr>
                                        <td>{{ __('Discount') }}</td>
                                        <td>0<sup>đ</sup></td>
                                    </tr> --}}
                                        {{-- <tr>
                                        <td>{{ __('VAT') }}</td>
                                        <td>0<sup>đ</sup></td>
                                    </tr> --}}
                                        {{-- <tr>
                                        <td><strong>{{ __('Order Total') }}</strong></td>
                                        <td><strong>2.750,000<sup>đ</sup></strong></td>
                                    </tr> --}}
                                    </tbody>
                                </table>
                                <div class="btn-wrapper text-right">
                                    <a class="theme-btn-1 btn btn-effect-1" href="{{ route('cart.checkout') }}">{{ __('Proceed to checkout') }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.qtybutton', function(e) {
                e.preventDefault();
                const btn = $(this),
                    table = $(this).parents('table')
                submitForm($(this).closest('form')).done(function(response) {
                    table.find('tr.cart-item').remove()
                    $('.shoping-cart-total table tr td sup').text(response.cart.count).parent().next().text(number_format(response.cart.total) + 'đ')
                    $.each(response.cart.items, function(i, item) {
                        table.prepend(`
                            <tr class="cart-item">
                                <td class="cart-product-remove px-0">
                                    <form action="{{ route('cart.remove') }}" method="post">
                                        @csrf
                                        <input name="variable_id" type="hidden" value="${item.variable.id}">
                                        <button class="btn btn-close btn-link text-decoration-none px-4" type="submit"></button>
                                    </form>
                                </td>
                                <td class="cart-product-image px-0">
                                    <a href="${item.variable.product.url}"><img src="${item.variable.product.imageUrl}"
                                            alt="${ item.variable.product.sku + (item.variable.sub_sku != null ? item.variable.sub_sku : '') } - ${ item.variable.product.name + (item.variable.name != null ? ' - ' + item.variable.name : '') }"></a>
                                </td>
                                <td class="cart-product-info text-start w-50">
                                    <h4 class="mb-0 p-0"><a href="${response}">${ item.variable.product.sku + ' - ' + item.variable.product.name }</a></h4>
                                    <p class="text-secondary mb-0 p-0">${ (item.variable.sub_sku != null ? item.variable.sub_sku : '') + (item.variable.name != null ? ' - ' + item.variable.name : '') }</p>
                                </td>
                                <td class="cart-product-price text-end px-3" style="width: 15% !important">${ number_format(item.price) }đ &nbsp;&nbsp;&times;</td>
                                <td class="cart-product-quantity px-0">
                                    <form action="{{ route('cart.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="variable_id" value="${item.variable.id}">
                                        <div class="cart-plus-minus">
                                            <div class="dec cursor-pointer qtybutton">
                                                <i class="fas fa-minus"></i>
                                            </div>
                                            <input class="cart-plus-minus-box" name="quantity" type="text" value="${ item.quantity }">
                                            <div class="inc cursor-pointer qtybutton">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="cart-product-subtotal text-end" style="width: 15% !important">${ number_format(item.quantity * item.price) }đ</td>
                            </tr>`)
                    })
                })
            })
        })
    </script>
@endpush
