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
                                <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> {{ __('Home') }}</a></li>
                                <li><a href="{{ route('shop.index') }}"><span class="ltn__secondary-color"></span> {{ __('Shop') }}</a></li>
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
                                <div class="ltn__shop-details-img-gallery sticky-top">
                                    <div class="ltn__shop-details-large-img">
                                        @foreach ($product->imagesUrl as $index => $imageUrl)
                                            <div class="single-large-img">
                                                <a data-rel="lightcase:myCollection" href="{{ $imageUrl }}">
                                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if (count($product->imagesUrl) > 1)
                                        <div class="ltn__shop-details-small-img slick-arrow-2">
                                            @foreach ($product->imagesUrl as $index => $imageUrl)
                                                <div class="single-small-img">
                                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <!-- <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                            <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                        </ul>
                                    </div> -->
                                    <h4 class="ltn__secondary-color section-subtitle section-subtitle-2---">{{ $product->sku }} @if(Auth::check()) <a href="{{ route('admin.product', ['key' => $product->id]) }}" class="btn btn-link text-decoration-none p-2"><i class="far fa-edit"></i> Sửa</a> @endif</h4>
                                    <!-- <div class="product-price">
                                        <span>1,500,000<sup>đ</sup></span>
                                    </div> -->
                                    <h2 class="fs-2">{{ $product->name }}</h2>
                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        <ul>
                                            <li>
                                                <strong>{{ __('Catalogues') }}:</strong>
                                                <span>
                                                    @foreach ($product->catalogues as $catalogue)
                                                        <a href="{{ route('shop.index', ['catalogue' => $catalogue->slug]) }}">
                                                            {{ __($catalogue->name) }}
                                                        </a>
                                                    @endforeach
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>{!! $product->excerpt !!}</div>
                                    <div class="ltn__shop-details-tab-inner-2 mt-4">
                                        @if ($product->variables->first()->name)
                                            <h4 class="mb-0">{{ __('Select properties') }}</h4>
                                            <div class="ltn__shop-details-tab-menu">
                                                <div class="nav">
                                                    @foreach ($product->variables as $index => $variable)
                                                        <a class="{{ $index === 0 ? 'active show' : '' }} me-2 p-2" data-bs-toggle="tab" href="#variable{{ $variable->id }}">
                                                            {!! $variable->name !!}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <div class="tab-content">
                                            @foreach ($product->variables as $index => $variable)
                                                <div class="tab-pane fade {{ $index === 0 ? 'active show' : '' }}" id="variable{{ $variable->id }}">
                                                    <form class="cart-form" action="{{ route('cart.add') }}" method="post">
                                                        @csrf
                                                        <div class="ltn__shop-details-tab-content-inner">
                                                            @if ($product->variables->first()->name)
                                                                <div>{!! $variable->description !!}</div>
                                                            @endif
                                                            <div class="ltn__secondary-color section-subtitle section-subtitle-2---" data-variable-id="{{ $variable->id }}">
                                                                <span> {!! number_format($variable->price) !!}₫</span> @if(Auth::check()) <a href="{{ route('admin.product', ['key' => $product->id]) }}" class="btn btn-link text-decoration-none p-2"><i class="far fa-edit"></i> Sửa</a> @endif
                                                            </div>
                                                        </div>
                                                        <div class="ltn__product-details-menu-2">
                                                            <ul class="d-flex">
                                                                <li>
                                                                    <div class="cart-plus-minus">
                                                                        <input class="cart-plus-minus-box" name="quantity" type="text" value="1">
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <input name="price" type="hidden" value="{{ $variable->price }}">
                                                                    <input name="variable_id" type="hidden" value="{{ $variable->id }}">
                                                                    <button class="theme-btn-1 btn btn-effect-1 btn-add-to-cart" type="submit" title="Add to Cart">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                        <span>{{ __('ADD TO CART') }}</span>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="row">
                            <div class="col-12 col-lg-8 card">
                                <div class="ltn__shop-details-tab-menu">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_description">{{ __('Description') }}</a>
                                        @if (!empty($specs))
                                            <a class="" data-bs-toggle="tab" href="#liton_tab_details_specifications">{{ __('Specifications') }}</a>
                                        @endif
                                        <a class="" data-bs-toggle="tab" href="#liton_tab_details_guide">{{ __('Ordering guide') }}</a>
                                        @if (isset($product) && $product->allow_review)
                                            <a class="" data-bs-toggle="tab" href="#liton_tab_details_review">{{ __('Review') }}</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="liton_tab_details_description">
                                        <div class="product-description-container">
                                            <div class="ltn__shop-details-tab-content-inner">
                                                {!! $product->description !!}
                                            </div>
                                        </div>
                                        <button class="btn btn-effect-1 text-uppercase theme-btn-1 expand-description-btn m-3">{{ __('Read more') }}</button>
                                    </div>
                                    @if (!empty($specs))
                                        <div class="tab-pane fade" id="liton_tab_details_specifications">
                                            <div class="ltn__shop-details-tab-content-inner">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">{{ __('Parameter') }}</th>
                                                            <th scope="col">{{ __('Value') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($specs as $key => $value)
                                                            <tr>
                                                                <td>{{ $key }}</td>
                                                                <td>{{ $value }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="tab-pane fade" id="liton_tab_details_guide">
                                        <div class="ltn__shop-details-tab-content-inner">
                                            <h4 class="title-2">{{ __('Policies') }}</h4>
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
                                                    <strong>Phone number:</strong> 0292 651 5678
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_details_review">
                                        <div class="ltn__shop-details-tab-content-inner">
                                            <!-- comment-area -->
                                            <div class="ltn__comment-area mb-30">
                                                <div class="ltn__comment-inner">
                                                    <ul>
                                                        <li>
                                                            <div class="ltn__comment-item clearfix">
                                                                <div class="ltn__commenter-img">
                                                                    <img src="{{ asset('img/testimonial/1.jpg') }}" alt="Image">
                                                                </div>
                                                                <div class="ltn__commenter-comment">
                                                                    <h6><a href="#">{{ __('Adam Smit') }}</a></h6>
                                                                    <div class="product-ratting">
                                                                        <ul>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a>
                                                                            </li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a>
                                                                            </li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a>
                                                                            </li>
                                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
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
                                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
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
                                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
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
                                            </div>
                                            <!-- comment-reply -->
                                            <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                                <form action="#">
                                                    <h4 class="title-2">{{ __('Add a Review') }}</h4>
                                                    <div class="mb-30">
                                                        <div class="add-a-review">
                                                            <h6>{{ __('Your Ratings:') }}</h6>
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
                                                        <textarea placeholder="{{ __('Type your comments....') }}"></textarea>
                                                    </div>
                                                    <div class="input-item input-item-name ltn__custom-icon">
                                                        <input type="text" placeholder="{{ __('Type your name....') }}">
                                                    </div>
                                                    <div class="input-item input-item-email ltn__custom-icon">
                                                        <input type="email" placeholder="{{ __('Type your email....') }}">
                                                    </div>
                                                    {{-- <div class="input-item input-item-website ltn__custom-icon">
                                                        <input name="website" type="text" placeholder="{{ __('Type your website....') }}">
                                                    </div> --}}
                                                    <label class="mb-0"><input name="agree" type="checkbox"> {{ __('Save my name, email, and website in this browser for the next time I comment.') }}</label>
                                                    <div class="btn-wrapper">
                                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">{{ __('Submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 ltn__product-tab-content-inner ltn__product-list-view">
                                @if (count($product->relatedProducts()))
                                    <div class="card sticky-top">
                                        <div class="card-body">
                                            <h4 class="title-2 p-2">{{ __('Related Products') }}<span>.</span></h4>
                                            <div class="row">
                                                @foreach ($product->relatedProducts() as $relatedProduct)
                                                    <!-- ltn__product-item -->
                                                    <div class="col-lg-12">
                                                        <div class="ltn__product-item ltn__product-item-3">
                                                            <div class="product-img">
                                                                <a href="{{ route('shop.index', ['catalogue' => $catalogue->slug, 'product' => $relatedProduct->slug]) }}"><img src="{{ $relatedProduct->getImageUrlAttribute() }}" alt="img"></a>
                                                            </div>
                                                            <div class="product-info p-3">
                                                                <h2 class="fs-6"><a href="{{ route('shop.index', ['catalogue' => $catalogue->slug, 'product' => $relatedProduct->slug]) }}">{!! $relatedProduct->name !!}</a></h2>
                                                                <div class="product-price">
                                                                    <span>{!! $relatedProduct->displayPrice() !!}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab End -->
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP DETAILS AREA END -->
@endsection
