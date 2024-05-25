@extends('web.layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <div class="master-wrapper">
        <div class="container-fluid px-0">
            <div class="home-banner-wrapper">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="home-banner-slide">
                                <img class="img-fluid" src="{{ asset('images/banner/banner-hero.jpg') }}" alt="Trang chủ" loading="lazy">
                            </div>
                            <div class="text-box-banner top text-center">
                                <h2> Dịch vụ TruongDung Pet cung cấp </h2>
                                <p> TruongDung Pet đặt tình yêu và sự chân thành đến với sức khỏe của Pet cưng của bạn. </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="home-banner-slide">
                                <img class="img-fluid" src="{{ asset('images/banner/spa-banner.jpg') }}" alt="Trang chủ" loading="lazy">
                            </div>
                            <div class="text-box-banner text-center">
                                <h3>TruongDung Pet - Dịch Vụ Thú Y Cần Thơ</h3>
                                <p>Chuyên: Khám & Điều trị bệnh, Spa, Cắt tỉa lông, Nhuộm, Pet hotel.
                                </p>
                            </div>
                        </div>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- <div class="key-section key-bg-section" style="background-image: url({{ asset('images/bg-dvtc.jpg') }});">
                    <div class="container">
                        <div class="row align-items-center mb-4">
                            <div class="col-12 col-md-6 p-2 p-md-5">
                                <h2 class="text-dark fw-semibold fs-1 mb-3">Dịch vụ thú y</h2>

                                <p class="justify">Hãy kiểm tra sức khỏe định kỳ và dẫn thú cưng đi khám bệnh tại thú y
                                    TruongDung
                                    Pet nếu thấy bé có bất kỳ triệu chứng nào khác thường. Hơn nữa việc kiểm tra sức
                                    khỏe định kỳ cho bé còn giúp bạn tiết kiệm chi phí khám chữa bệnh và thời gian
                                    điều trị cho vật nuôi. Thay vì phải bỏ ra hàng triệu để chữa bệnh cho chó mèo
                                    thì việc kiểm tra sức khỏe định kỳ sẽ giúp bạn phát hiện sớm bệnh và tiết kiệm
                                    được rất nhiều chi phí, giúp vật nuôi khỏe mạnh hơn.</p>
                                <p class="mt-4">
                                    <a class="key-btn-dark" href="#" title="Đặt lịch ngay">
                                        Đặt lịch ngay <img class="img-fluid" src="images/img/arrow-right.png" alt="">
                                    </a>
                                </p>
                            </div>
                            <div class="col-12 col-md-6 p-2 p-md-5">
                                <div class="img my-4 img-style">
                                    <div class="img-inner">
                                        <img class="img-fluid" src="images/dvty-img-1.jpg" alt="dịch vụ thú cưng" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-12 col-md-6 p-2 p-md-5">
                                <div class="img my-4 img-style">
                                    <div class="img-inner">
                                        <img class="img-fluid" src="images/dvty-img-2.jpg" alt="dịch vụ thú cưng" loading="lazy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 p-2 p-md-5">
                                <h2 class="text-dark fw-semibold fs-1 mb-3">Khám và điều trị</h2>

                                <p class="justify">Chuẩn đoán và điều trị hiệu quả các bệnh về hệ hô hấp, hệ tiêu hóa,
                                    hệ tuần hoàn, tiết niệu, sinh dục, lông da, xương khớp, các bệnh về mắt và tai</p>
                                <p class="mt-4">
                                    <a class="key-btn-dark" href="#" title="Đặt lịch ngay">
                                        Đặt lịch ngay <img class="img-fluid" src="images/img/arrow-right.png" alt="">
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row align-items-center mb-4">
                            <div class="col-12 col-md-6 p-2 p-md-5">
                                <h2 class="text-dark fw-semibold fs-1 mb-3">Xét nghiệm<br />
                                    Chẩn đoán hình ảnh</h2>

                                <p class="justify">Các phương pháp chẩn đoán hình ảnh hoặc làm xét nghiệm: Siêu âm,
                                    X-Quang, Xét nghiệm máu, virus, nước tiểu, da, kháng sinh đồ...</p>
                                <p class="mt-4">
                                    <a class="key-btn-dark" href="#" title="Đặt lịch ngay">
                                        Đặt lịch ngay <img class="img-fluid" src="images/img/arrow-right.png" alt="">
                                    </a>
                                </p>
                            </div>
                            <div class="col-12 col-md-6 p-2 p-md-5">
                                <div class="img my-4 img-style">
                                    <div class="img-inner">
                                        <img class="img-fluid" src="images/dvty-img-3.jpg" alt="dịch vụ thú cưng" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center mb-4">
                            <div class="col-12 col-md-8 p-2 p-md-5 text-center">
                                <h2 class="text-dark fw-semibold fs-1 mb-3">Dịch vụ cấp cứu 24/7</h2>

                                <p class="justify">TruongDung Pet cung cấp dịch vụ cấp cứu 24/7, kể cả ngày lễ. Trường
                                    hợp cấp cứu sau 19h xin vui lòng liên hệ trước và mang thú cưng tới thú y TruongDung
                                    Pet cơ sở 1 KDC 586.</p>
                                <p class="mt-4">
                                    <a class="key-btn-dark" href="#" title="Đặt lịch ngay">
                                        Đặt lịch ngay <img class="img-fluid" src="images/img/arrow-right.png" alt="">
                                    </a>
                                </p>
                            </div>
                            <div class="col-12 col-md-12 p-2">
                                <div class="img my-4 img-style">
                                    <div class="img-inner">
                                        <img class="img-fluid" src="images/dvty-img-4.jpg" alt="dịch vụ thú cưng" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
        <div class="product-list-wrapper key-section">
            <div class="container">
                <div class="row product-list mb-5">
                    <div class="col-12 col-md-12 text-center mb-4">
                        <h2 class="text-dark fw-semibold fs-1 mb-3">Sản phẩm của nhà TruongDung Pet</h2>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="" title="Gói Pate Meowcat">
                                    <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                </a>
                            </div>
                            <div class="product-content text-start">
                                <a class="product-name" href="" title="">
                                    Gói Pate Meowcat
                                </a>
                                <p>
                                    <span class="short">Khối lượng: 70g</span><br>
                                    <span class="price">Giá: </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="daesang-paginate d-flex align-items-center justify-content-center">
                    <a class="active" href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>

                    <a class="nav-svg" href="#" title="">
                        <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.762882 0.571476C1.20714 0.127216 1.92743 0.127216 2.37169 0.571476L9.19727 7.39706C9.64153 7.84132 9.64153 8.5616 9.19727 9.00586L2.37169 15.8314C1.92743 16.2757 1.20714 16.2757 0.762882 15.8314C0.318623 15.3872 0.318623 14.6669 0.762882 14.2226L6.78406 8.20146L0.762882 2.18028C0.318623 1.73602 0.318623 1.01573 0.762882 0.571476Z"
                                fill="#3F3E3F"></path>
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
        <div class="product-showcase-wrapper home-product key-bg-section" style="background-image: url({{ asset('images/bg-contact-1.jpg') }});">
            <div class="container">
                <div class="p-4 text-center">
                    <h2 class="text-dark fw-semibold fs-1 mb-3">Các sản phẩm của TruongDung Pet</h2>
                </div>
            </div>
            <div class="product-showcase--inner">
                <div class="product-slide-wrapper">
                    <div class="container">
                        <div class="product-slide--inner">
                            <div class="product-sapo">
                                <p class="product-cate text-uppercase">
                                </p>
                                <h5 id="cate-name">
                                    Pate gói
                                </h5>
                                <p class="product-des" id="cate-des">
                                    Các phương pháp chẩn đoán hình ảnh hoặc làm xét nghiệm: Siêu âm, X-Quang,
                                    Xét nghiệm máu, virus, nước tiểu, da, kháng sinh đồ...
                                </p>
                                <div class="custom-slide-nav">
                                    <div class="swiper-button-prev">
                                        <svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="15" cy="15" r="14.5" transform="rotate(180 15 15)" stroke="#333333"></circle>
                                            <path d="M48 15.5L12.5 15.5M12.5 15.5L15.5 19M12.5 15.5L15.5 12" stroke="#333333"></path>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-next">
                                        <svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="33" cy="15" r="14.5" stroke="#333333"></circle>
                                            <path d="M0 15.5H35.5M35.5 15.5L32.5 12M35.5 15.5L32.5 19" stroke="#333333"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="product-slider">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="product-item">
                                                <div class="product-slide-image">
                                                    <a href="" title="Gói Pate Nekko">
                                                        <img class="img-fluid" src="{{ asset('images/product/pr-1.jpg') }}" alt="Gói Pate Nekko">
                                                    </a>
                                                </div>
                                                <div class="product-slide-content text-start">
                                                    <a class="product-name" href="" title="">
                                                        Gói Pate Nekko
                                                    </a>
                                                    <p>
                                                        <span class="short">Khối lượng: 70g</span><br>
                                                        <span class="price">Giá: </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-item">
                                                <div class="product-slide-image">
                                                    <a href="" title="Gói Pate Meowcat">
                                                        <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                                    </a>
                                                </div>
                                                <div class="product-slide-content text-start">
                                                    <a class="product-name" href="" title="">
                                                        Gói Pate Meowcat
                                                    </a>
                                                    <p>
                                                        <span class="short">Khối lượng: 70g</span><br>
                                                        <span class="price">Giá: </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-item">
                                                <div class="product-slide-image">
                                                    <a href="" title="Gói Pate Petsimo">
                                                        <img class="img-fluid" src="{{ asset('images/product/pr-3.jpg') }}" alt="Gói Pate Petsimo">
                                                    </a>
                                                </div>
                                                <div class="product-slide-content text-start">
                                                    <a class="product-name" href="" title="">
                                                        Gói Pate Petsimo
                                                    </a>
                                                    <p>
                                                        <span class="short">Khối lượng: 70g</span><br>
                                                        <span class="price">Giá: </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-item">
                                                <div class="product-slide-image">
                                                    <a href="" title="Gói Pate Nekko">
                                                        <img class="img-fluid" src="{{ asset('images/product/pr-1.jpg') }}" alt="Gói Pate Nekko">
                                                    </a>
                                                </div>
                                                <div class="product-slide-content text-start">
                                                    <a class="product-name" href="" title="">
                                                        Gói Pate Nekko
                                                    </a>
                                                    <p>
                                                        <span class="short">Khối lượng: 70g</span><br>
                                                        <span class="price">Giá: </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-item">
                                                <div class="product-slide-image">
                                                    <a href="" title="Gói Pate Meowcat">
                                                        <img class="img-fluid" src="{{ asset('images/product/pr-2.jpg') }}" alt="Gói Pate Meowcat">
                                                    </a>
                                                </div>
                                                <div class="product-slide-content text-start">
                                                    <a class="product-name" href="" title="">
                                                        Gói Pate Meowcat
                                                    </a>
                                                    <p>
                                                        <span class="short">Khối lượng: 70g</span><br>
                                                        <span class="price">Giá: </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="product-item">
                                                <div class="product-slide-image">
                                                    <a href="" title="Gói Pate Petsimo">
                                                        <img class="img-fluid" src="{{ asset('images/product/pr-3.jpg') }}" alt="Gói Pate Petsimo">
                                                    </a>
                                                </div>
                                                <div class="product-slide-content text-start">
                                                    <a class="product-name" href="" title="">
                                                        Gói Pate Petsimo
                                                    </a>
                                                    <p>
                                                        <span class="short">Khối lượng: 70g</span><br>
                                                        <span class="price">Giá: </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="custom-slide-nav">
                                    <div class="swiper-button-prev">
                                        <svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="15" cy="15" r="14.5" transform="rotate(180 15 15)" stroke="#333333"></circle>
                                            <path d="M48 15.5L12.5 15.5M12.5 15.5L15.5 19M12.5 15.5L15.5 12" stroke="#333333"></path>
                                        </svg>
                                    </div>
                                    <div class="swiper-button-next">
                                        <svg width="48" height="30" viewBox="0 0 48 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="33" cy="15" r="14.5" stroke="#333333"></circle>
                                            <path d="M0 15.5H35.5M35.5 15.5L32.5 12M35.5 15.5L32.5 19" stroke="#333333"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
