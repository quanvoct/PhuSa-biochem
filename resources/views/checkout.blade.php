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

    <!-- WISHLIST AREA START -->
    <div class="ltn__checkout-area mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ltn__checkout-inner">
                        <div class="ltn__checkout-single-content">
                            <h4 class="title-2">{{ __('Billing Details') }}</h4>
                            <div class="ltn__checkout-single-content-info">
                                <form action="#">
                                    <h6>{{ __('Personal Information') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input name="ltn__name" type="text" placeholder="{{ __('Full name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input name="ltn__email" type="email" placeholder="{{ __('Email address') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-phone ltn__custom-icon">
                                                <input name="ltn__phone" type="text" placeholder="{{ __('Phone number') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <input name="ltn__company" type="text" placeholder="{{ __('Company name (optional)') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <h6>{{ __('Country') }}</h6>
                                            <div class="input-item">
                                                <select class="nice-select">
                                                    <option>Select Country</option>
                                                    <option>Australia</option>
                                                    <option>Canada</option>
                                                    <option>China</option>
                                                    <option>Morocco</option>
                                                    <option>Saudi Arabia</option>
                                                    <option>United Kingdom (UK)</option>
                                                    <option>United States (US)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <h6>{{ __('Town / City') }}</h6>
                                            <div class="input-item">
                                                <input type="text" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <h6>{{ __('Address') }}</h6>
                                            <div class="input-item">
                                                <input type="text" placeholder="{{ __('House number and street name') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <h6>{{ __('Zip') }}</h6>
                                            <div class="input-item">
                                                <input type="text" placeholder="Zip">
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <label class="input-info-save mb-0">
                                            <input id="agree-checkbox" name="agree" type="checkbox"> {{ __('Delivery to another address') }}
                                        </label>
                                    </p>
                                    <div class="delivery_address d-none" id="delivery_address">
                                        <h6>{{ __('Shipment Details') }}</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="consignee_name" type="text" placeholder="{{ __('Full name') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="consignee_email" type="email" placeholder="{{ __('Email address') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="consignee_phone" type="text" placeholder="{{ __('Phone number') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="consignee_company" type="text" placeholder="{{ __('Company name (optional)') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <h6>{{ __('Country') }}</h6>
                                                <div class="input-item">
                                                    <select class="nice-select">
                                                        <option>Select Country</option>
                                                        <option>Australia</option>
                                                        <option>Canada</option>
                                                        <option>China</option>
                                                        <option>Morocco</option>
                                                        <option>Saudi Arabia</option>
                                                        <option>United Kingdom (UK)</option>
                                                        <option>United States (US)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <h6>{{ __('Town / City') }}</h6>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <h6>{{ __('Address') }}</h6>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" placeholder="{{ __('House number and street name') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <h6>{{ __('Zip') }}</h6>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" placeholder="Zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p><label class="input-info-save mb-0"><input name="vat" type="checkbox"> {{ __('Issue VAT invoice') }}</label></p>
                                    <h6>{{ __('Order Notes (optional)') }}</h6>
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <textarea name="ltn__message" placeholder="{{ __('Notes about your order, e.g. special notes for delivery.') }}"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="ltn__checkout-payment-method mt-50">
                        <h4 class="title-2">{{ __('Payment Method') }}</h4>
                        <div id="checkout_accordion_1">
                            <!-- card -->
                            <div class="card">
                                <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-1" aria-expanded="false">
                                    {{ __('Check payments') }}
                                </h5>
                                <div class="collapse" id="faq-item-2-1" data-bs-parent="#checkout_accordion_1">
                                    <div class="card-body">
                                        <p>{{ __('Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- card -->
                            <div class="card">
                                <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2" aria-expanded="true">
                                    {{ __('Cash on delivery') }}
                                </h5>
                                <div class="collapse show" id="faq-item-2-2" data-bs-parent="#checkout_accordion_1">
                                    <div class="card-body">
                                        <p>{{ __('Pay with cash upon delivery.') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- card -->
                            <div class="card">
                                <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-3" aria-expanded="false">
                                    {{ __('PayPal') }} <img src="img/icons/payment-3.png" alt="#">
                                </h5>
                                <div class="collapse" id="faq-item-2-3" data-bs-parent="#checkout_accordion_1">
                                    <div class="card-body">
                                        <p>{{ __('Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ltn__payment-note mt-30 mb-30">
                            <p>{{ __('Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.') }}</p>
                        </div>
                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">{{ __('Place order') }}</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shoping-cart-total sticky-top">
                        <div class="mt-100"></div>
                        <h4 class="title-2">{{ __('Cart Totals') }}</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Digital Stethoscope <strong>× 2</strong></td>
                                    <td>750,000<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>Cosmetic Containers <strong>× 2</strong></td>
                                    <td>750,000<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>Antiseptic Spray <strong>× 2</strong></td>
                                    <td>750,000<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Shipping and Handing') }}</td>
                                    <td>750,000<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td>{{ __('VAT') }}</td>
                                    <td>0<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td><strong>{{ __('Order Total') }}</strong></td>
                                    <td><strong>3,000,000<sup>đ</sup></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->
@endsection
