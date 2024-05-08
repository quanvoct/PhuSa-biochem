@extends('layouts.app')
@section('title')
{{ $pageName }}
@endsection
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Cart</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Cart</li>
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
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <!-- <thead>
                                    <th class="cart-product-remove">Remove</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Product</th>
                                    <th class="cart-product-price">Price</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Subtotal</th>
                                </thead> -->
                                <tbody>
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="{{ route('home.product') }}"><img src="{{ asset('img/product/product-demo-2.jpg') }}" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="{{ route('home.product') }}">Digital Stethoscope</a></h4>
                                        </td>
                                        <td class="cart-product-price">750,000<sup>đ</sup></td>
                                        <td class="cart-product-quantity">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                            </div>
                                        </td>
                                        <td class="cart-product-subtotal">1.500,000<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="{{ route('home.product') }}"><img src="{{ asset('img/product/product-demo-6.jpg') }}" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="{{ route('home.product') }}">Cosmetic Containers</a></h4>
                                        </td>
                                        <td class="cart-product-price">950,000<sup>đ</sup></td>
                                        <td class="cart-product-quantity">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                            </div>
                                        </td>
                                        <td class="cart-product-subtotal">1,900,000<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="cart-product-remove">x</td>
                                        <td class="cart-product-image">
                                            <a href="{{ route('home.product') }}"><img src="{{ asset('img/product/product-demo-10.jpg') }}" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="{{ route('home.product') }}">Antiseptic Spray</a></h4>
                                        </td>
                                        <td class="cart-product-price">650,000<sup>đ</sup></td>
                                        <td class="cart-product-quantity">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                                            </div>
                                        </td>
                                        <td class="cart-product-subtotal">650,000<sup>đ</sup></td>
                                    </tr>
                                    <tr class="cart-coupon-row">
                                        <td colspan="6">
                                            <div class="cart-coupon">
                                                <input type="text" name="cart-coupon" placeholder="Coupon code">
                                                <button type="submit" class="btn theme-btn-2 btn-effect-2">Apply Coupon</button>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn theme-btn-2 btn-effect-2-- disabled">Update Cart</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="shoping-cart-total mt-50">
                            <h4>Cart Totals</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Cart Subtotal</td>
                                        <td>750,000<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping and Handing</td>
                                        <td>750,000<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td>Vat</td>
                                        <td>0<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Order Total</strong></td>
                                        <td><strong>2.750,000<sup>đ</sup></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="btn-wrapper text-right">
                                <a href="{{ route('home.checkout') }}" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="{{ asset('img/1.jpg') }}--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Products, services and equipment <br>  applied in the field of Molecular Biology</h1>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="{{ route('home.shop') }}">Explore Products <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->

   
    @endsection