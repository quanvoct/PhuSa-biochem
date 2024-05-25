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

<!-- CONTACT ADDRESS AREA START -->
<div class="ltn__contact-address-area mb-90">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow h-100">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('img/icons/10.png') }}" alt="Icon Image">
                    </div>
                    <h3>{{ __('Email Address') }}</h3>
                    <p> {{ $settings['company_email'] }}<br></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow h-100">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('img/icons/11.png') }}" alt="Icon Image">
                    </div>
                    <h3>{{ __('Phone Number') }}</h3>
                    <p><a href="tel:{{ $settings['company_hotline'] }}">{{ $settings['company_hotline'] }}</a> <br> <a href="tel:{{ $settings['company_phone'] }}">{{ $settings['company_phone'] }}</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow h-100">
                    <div class="ltn__contact-address-icon">
                        <img src="{{ asset('img/icons/12.png') }}" alt="Icon Image">
                    </div>
                    <h3>{{ __('Office Address') }}</h3>
                    <p>{{ $settings['company_address'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT ADDRESS AREA END -->

<!-- CONTACT MESSAGE AREA START -->
<div class="ltn__contact-message-area mb-120 mb--100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__form-box contact-form-box box-shadow white-bg">
                    <h4 class="title-2">{{ __('Get A Quote') }}</h4>
                    <form id="contact-form" action="mail.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-item input-item-name ltn__custom-icon">
                                    <input type="text" name="name" placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-item-email ltn__custom-icon">
                                    <input type="email" name="email" placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-item-subject ltn__custom-icon">
                                    <input type="text" name="subject" placeholder="Enter the subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-item input-item-phone ltn__custom-icon">
                                    <input type="text" name="phone" placeholder="Enter phone number">
                                </div>
                            </div>
                        </div>
                        <div class="input-item input-item-textarea ltn__custom-icon">
                            <textarea name="message" placeholder="Enter message"></textarea>
                        </div>
                        <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> {{ __('Save my
                                        name, email, and website in this browser for the next time I comment.') }}</label>
                        </p>
                        <div class="btn-wrapper mt-0">
                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">{{ __('get a free
                                        service') }}</button>
                        </div>
                        <p class="form-messege mb-0 mt-20"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT MESSAGE AREA END -->

<!-- GOOGLE MAP AREA START -->
<div class="google-map mb-120">
    {!! $settings['contact_map'] !!}

</div>
<!-- GOOGLE MAP AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="{{ asset('img/1.jpg') }}--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>{{ __('Products, services and equipment') }} <br>{{ __(' applied in the field of Molecular Biology') }}</h1>
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