@extends('layouts.app')
@section('title')
{{ $pageName }}
@endsection
@section('content')
        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image" data-bs-bg="{{ asset('img/bg/14.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner">
                            <h1 class="page-title">{{ $pageName }}</h1>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i
                                                    class="fas fa-home"></i></span> Home</a></li>
                                    <li><a href="{{ route('shop.index') }}"><span class="ltn__secondary-color"></span> Shop</a></li>
                                    <li>{{ $pageName }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- SHOP DETAILS AREA START -->
        <div class="ltn__shop-details-area pb-85">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ltn__shop-details-inner mb-60">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="ltn__shop-details-img-gallery">
                                        <div class="ltn__shop-details-large-img">
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-1.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-3.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-3.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-4.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-4.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-7.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-7.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-8.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-8.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-9.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-9.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="single-large-img">
                                                <a href="{{ asset('img/product/product-demo-10.jpg') }}"
                                                    data-rel="lightcase:myCollection">
                                                    <img src="{{ asset('img/product/product-demo-10.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ltn__shop-details-small-img slick-arrow-2">
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="Image">
                                            </div>
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-3.jpg') }}" alt="Image">
                                            </div>
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-4.jpg') }}" alt="Image">
                                            </div>
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-7.jpg') }}" alt="Image">
                                            </div>
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-8.jpg') }}" alt="Image">
                                            </div>
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-9.jpg') }}" alt="Image">
                                            </div>
                                            <div class="single-small-img">
                                                <img src="{{ asset('img/product/product-demo-10.jpg') }}" alt="Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="modal-product-info shop-details-info pl-0">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                            </ul>
                                        </div>
                                        <h3>dNTPs Mix</h3>
                                        <div class="product-price">
                                            <span>1,500,000<sup>đ</sup></span>
                                        </div>
                                        <div class="modal-product-meta ltn__product-details-menu-1">
                                            <ul>
                                                <li>
                                                    <strong>Categories:</strong>
                                                    <span>
                                                        <a href="#">face-mask</a>
                                                        <a href="#">ppe-kit</a>
                                                        <a href="#">safety-suits</a>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-2">
                                            <ul>
                                                <li>
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="01" name="qtybutton"
                                                            class="cart-plus-minus-box">
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart"
                                                        data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                        <i class="fas fa-shopping-cart"></i>
                                                        <span>ADD TO CART</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-3">
                                            <ul>
                                                <li>
                                                    <a href="#" class="" title="Wishlist" data-bs-toggle="modal"
                                                        data-bs-target="#liton_wishlist_modal">
                                                        <i class="far fa-heart"></i>
                                                        <span>Add to Wishlist</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="" title="Compare" data-bs-toggle="modal"
                                                        data-bs-target="#quick_view_modal">
                                                        <i class="fas fa-exchange-alt"></i>
                                                        <span>Compare</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="ltn__social-media">
                                            <ul>
                                                <li>Share:</li>
                                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                                </li>
                                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a>
                                                </li>
                                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                                </li>

                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="ltn__safe-checkout">
                                            <h5>Guaranteed Safe Checkout</h5>
                                            <img src="{{ asset('img/icons/payment-2.png') }}" alt="Payment Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab Start -->
                        <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                            <div class="ltn__shop-details-tab-menu">
                                <div class="nav">
                                    <a class="active show" data-bs-toggle="tab"
                                        href="#liton_tab_details_1_1">Description</a>
                                    <a data-bs-toggle="tab" href="#liton_tab_details_1_2" class="">Ordering guide</a>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">Lorem ipsum dolor sit amet elit.</h4>
                                        <p>
                                            Mixture of free nucleotides, including: dATP, dCTP, dGTP and dTTP.
                                            Concentration: 10 mM/µL each.</p>
                                        <p><strong>Features:</strong>
                                        </p>
                                        <ul>
                                            <li>Clear, colorless solution</li>
                                            <li>Purity: &gt;99% (HPLC)</li>
                                            <li>Long-term use when stored at -20°C</li>
                                        </ul>
                                        <p></p>
                                        <p><strong>Application: </strong>
                                        </p>
                                        <ul>
                                            <li>The product can be used in most Molecular Biology applications,
                                                including PCR, real-time PCR, high fidelity and long PCR, LAMP-PCR, cDNA
                                                synthesis, RT-PCR, RDA, MDA , DNA labeling, and DNA sequencing.</li>
                                        </ul>
                                        <p><strong><em>Note:</em></strong> This product is delivered at room temperature
                                            (25-35°C) without affecting PCR reaction performance. After receiving the
                                            product, please preserve it as recommended in the instructions for use.</p>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="liton_tab_details_1_2">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">Policies</h4>
                                        <div class="">
                                            <p>This warranty policy is understood as a policy to ensure the quality of
                                                PHUSA Genomics products and products previously sold by PHUSA Biochem.
                                            </p>
                                            <header class="section-heading">
                                                <h3 class=" text-primary">1. Warranty policy</h3>
                                            </header>
                                            <p>Warranty policy for biochemical products and machinery equipment is based
                                                on general conditions and standards of Phu Sa. Our company ensures that
                                                products are manufactured using materials that comply with regulatory
                                                specifications. Phu Sa's obligations under this warranty are limited to
                                                the provision of products and services to customers and are specified in
                                                each product.</p>
                                            <p><strong>a) For biochemical products, Oligo: customers can exchange in
                                                    case</strong></p>
                                            <p>- The product is not as ordered (wrong size, quantity or problems related
                                                to product material). <br> - Defective product packaging, such as: Torn,
                                                watery packaging, punctured or leaking cans and drums, missing opening
                                                lid.</p>
                                            <p><strong>b) For equipment and machinery products: customers can exchange
                                                    in case</strong></p>
                                            <p>- There is a damage determined to be due to the manufacturer's error and
                                                the warranty period is still valid. <br> - The product has no signs of
                                                intervention by a third party (outside repair). <br> - The serial
                                                number, seal on the product and warranty card must be the same, intact,
                                                not torn or altered. <br> - Goods are not affected by the environment
                                                (water absorption, corrosive chemicals, heat effects causing
                                                deformation). <br> - For products purchased at PHUSA Genomics but have
                                                exceeded the warranty period, our company will provide repair services
                                                for a fee to you.</p>
                                            <header class="section-heading">
                                                <h3 class=" text-primary">2. Conditions for accepting returns</h3>
                                            </header>
                                            <p>Warranty policy is applied subject to the following conditions: <br> -
                                                The product is still within the return period. <br> - The product comes
                                                with complete documents, papers, and warranty labels. <br> - Return
                                                time: Depending on product attributes and condition, Phu Sa will notify
                                                customers of the time to return the product. <br> - The return period is
                                                valid from the date the customer receives the product to the date the
                                                item is returned. <br> If the above conditions are met, customers can
                                                exchange products of equal or greater value than the originally ordered
                                                product.</p>
                                            <header class="section-heading">
                                                <h3 class=" text-primary">3. Return method depends on each order status
                                                </h3>
                                            </header>
                                            <p>- If the goods are defective from the company's side, we will be fully
                                                responsible for returning the goods to you (the company will pay the
                                                costs incurred).<br> - If the goods are defective or cannot be used by
                                                the customer, arising after the customer has checked, received the goods
                                                and used them, the two parties will come up with the most appropriate
                                                solution.</p>
                                            <header class="section-heading">
                                                <h3 class=" text-primary">4. Cases where returns will not be accepted
                                                </h3>
                                            </header>
                                            <p>- The product has had its labels removed and has been peeled off for
                                                use.<br> - The product has passed the return period.<br> - Warranty
                                                card, or warranty stamp is torn, no longer has a warranty stamp .
                                                Warranty, warranty stamp overwritten or modified.<br> - Warranty card
                                                does not clearly state the Serial number and date of purchase.<br> -
                                                Serial number on the machine and Warranty card do not match or cannot be
                                                determined. for any reason.</p>
                                            <p>For further explanation of the warranty policy, please contact:</p>
                                            <h3 class="text-primary">PHUSA GENOMICS JOINT STOCK COMPANY (PHUSA Genomics)
                                            </h3>
                                            <p><strong>Address:</strong> 503 Street 30/4, Hung Loi Ward, Ninh Kieu
                                                District, Can Tho City<br> <strong>Hotline/Zalo:</strong> 0931 035
                                                935<br>
                                                < strong>Phone number:</strong> 0292 651 5678
                                            </p>
                                        </div>
                                        <!-- comment-area -->
                                        <!-- <div class="ltn__comment-area mb-30">
                                            <div class="ltn__comment-inner">
                                                <ul>
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                <img src="{{ asset('img/testimonial/1.jpg') }}" alt="Image">
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6><a href="#">Adam Smit</a></h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit. Doloribus, omnis fugit corporis iste magnam
                                                                    ratione.</p>
                                                                <span class="ltn__comment-reply-btn">September 3,
                                                                    2020</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                <img src="{{ asset('img/testimonial/3.jpg') }}" alt="Image">
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6><a href="#">Adam Smit</a></h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit. Doloribus, omnis fugit corporis iste magnam
                                                                    ratione.</p>
                                                                <span class="ltn__comment-reply-btn">September 2,
                                                                    2020</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="ltn__comment-item clearfix">
                                                            <div class="ltn__commenter-img">
                                                                <img src="{{ asset('img/testimonial/2.jpg') }}" alt="Image">
                                                            </div>
                                                            <div class="ltn__commenter-comment">
                                                                <h6><a href="#">Adam Smit</a></h6>
                                                                <div class="product-ratting">
                                                                    <ul>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="fas fa-star"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                        </li>
                                                                        <li><a href="#"><i class="far fa-star"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit. Doloribus, omnis fugit corporis iste magnam
                                                                    ratione.</p>
                                                                <span class="ltn__comment-reply-btn">September 2,
                                                                    2020</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> -->
                                        <!-- comment-reply -->
                                        <!-- <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                            <form action="#">
                                                <h4 class="title-2">Add a Review</h4>
                                                <div class="mb-30">
                                                    <div class="add-a-review">
                                                        <h6>Your Ratings:</h6>
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-item input-item-textarea ltn__custom-icon">
                                                    <textarea placeholder="Type your comments...."></textarea>
                                                </div>
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" placeholder="Type your name....">
                                                </div>
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input type="email" placeholder="Type your email....">
                                                </div>
                                                <div class="input-item input-item-website ltn__custom-icon">
                                                    <input type="text" name="website"
                                                        placeholder="Type your website....">
                                                </div>
                                                <label class="mb-0"><input type="checkbox" name="agree"> Save my name,
                                                    email, and website in this browser for the next time I
                                                    comment.</label>
                                                <div class="btn-wrapper">
                                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                                        type="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOP DETAILS AREA END -->

        <!-- PRODUCT SLIDER AREA START -->
        <div class="ltn__product-slider-area ltn__product-gutter pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area ltn__section-title-2">
                            <h4 class="title-2">Related Products<span>.</span></h1>
                        </div>
                    </div>
                </div>
                <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">Digital Stethoscope</a></h2>
                                <div class="product-price">
                                    <span>350,000<sup>đ</sup> - 825,000<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{ asset('img/product/product-demo-1.jpg') }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">Thermometer Gun</a></h2>
                                <div class="product-price">
                                    <span>350,000<sup>đ</sup> - 825,000<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{ asset('img/product/product-demo-2.jpg') }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">Cosmetic Containers</a></h2>
                                <div class="product-price">
                                    <span>350,000<sup>đ</sup> - 825,000<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{ asset('img/product/product-demo-3.jpg') }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">Cosmetic Containers</a></h2>
                                <div class="product-price">
                                    <span>350,000<sup>đ</sup> - 825,000<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{ asset('img/product/product-demo-4.jpg') }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">Blue Hand Gloves</a></h2>
                                <div class="product-price">
                                    <span>350,000<sup>đ</sup> - 825,000<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="product-details.html"><img src="{{ asset('img/product/product-demo-5.jpg') }}" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#quick_view_modal">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Add to Cart" data-bs-toggle="modal"
                                                data-bs-target="#add_to_cart_modal">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">Thermometer Gun</a></h2>
                                <div class="product-price">
                                    <span>350,000<sup>đ</sup> - 825,000<sup>đ</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
        <!-- PRODUCT SLIDER AREA END -->


        @endsection