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
                            <h1 class="page-title">Contact Us</h1>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i
                                                    class="fas fa-home"></i></span> Home</a></li>
                                    <li>Contact</li>
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
                            <h3>Email Address</h3>
                            <p>example@example.com <br></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow h-100">
                            <div class="ltn__contact-address-icon">
                                <img src="{{ asset('img/icons/11.png') }}" alt="Icon Image">
                            </div>
                            <h3>Phone Number</h3>
                            <p><a href="tel:02926515678">02926515678</a> <br> <a href="tel:+02926533888">02926533888</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow h-100">
                            <div class="ltn__contact-address-icon">
                                <img src="{{ asset('img/icons/12.png') }}" alt="Icon Image">
                            </div>
                            <h3>Office Address</h3>
                            <p>K1.15-16, Vo Nguyen Giap, Phu Thu ward, Cai Rang district,
                                City. Can Tho. Viet Nam</p>
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
                            <h4 class="title-2">Get A Quote</h4>
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
                                <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Save my
                                        name, email, and website in this browser for the next time I comment.</label>
                                </p>
                                <div class="btn-wrapper mt-0">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">get a free
                                        service</button>
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

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62860.63928560409!2d105.71637045122911!3d10.034184408543815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0629f6de3edb7%3A0x527f09dbfb20b659!2zQ-G6p24gVGjGoSwgTmluaCBLaeG7gXUsIEPhuqduIFRoxqEsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1715045890777!5m2!1svi!2s"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
        <!-- GOOGLE MAP AREA END -->

        <!-- CALL TO ACTION START (call-to-action-6) -->
        <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="{{ asset('img/1.jpg') }}--">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                            <div class="coll-to-info text-color-white">
                                <h1>Products, services and equipment <br> applied in the field of Molecular Biology</h1>
                            </div>
                            <div class="btn-wrapper">
                                <a class="btn btn-effect-3 btn-white" href="{{ route('home.shop') }}">Explore Products <i
                                        class="icon-next"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CALL TO ACTION END -->

       
    @endsection